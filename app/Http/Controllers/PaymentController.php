<?php

namespace App\Http\Controllers;

use App\Helpers\GiftCard;
use App\Helpers\Moyasar;
use App\Helpers\Sender;
use App\Models\Bank;
use App\Models\DeliveryType;
use App\Models\Mosque;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jackiedo\Cart\Facades\Cart;
use Jenssegers\Agent\Agent;
use App\Helpers\UploadFile;
use App\Models\Favorite;
use App\Models\Transfer;
use App\Helpers\TapPayment;
use App\Models\Coupon;
use App\Models\Marketer;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Jackiedo\Cart\Cart;

class PaymentController extends Controller
{
    // protected $cart;
    // public function __construct(Cart $cart)
    // {
    //     $this->cart = $cart;
    // }

    function order(Request $request, Order $order)
    {
        // if
        $request->session->set('order_id', $order->id);
        return view("front.payments.order", $order);
    }

    function index(Request $request)
    {
        $delivery_types = DeliveryType::all();
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->clearItems();
        // $shoppingCart->clearTaxes();
        $products = $request->products;
        if ($request->mosque_id == 1595) {
            $where = [
                'id' => $request->mosque_id
            ];
        } else {
            $where = [
                'status' => 1,
                'id' => $request->mosque_id
            ];
        }

        $mosque = Mosque::where($where)->firstorfail();
        if ($mosque) {
            $total_quantity = 0;
            $total_amount = 0;
            foreach ($products as $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);
                    $total_quantity += $quantity;
                    $total_amount += $product->price * $quantity;
                }
            }
            if ($total_quantity > 0) {
                $order_row = [];
                $tax = $total_amount * (env("SAUDI_TAX") / 100);
                $order = Order::create([
                    'marketer_id' => Cookie::get("marketer_id"),
                    'order_status_id' => 201,
                    'mosque_id' => $mosque->id,
                    'total' => $total_amount + $tax ,
                    'tax' => $tax,
                    // 'user_id' => Auth::user()->id,
                ]);
                foreach ($products as $product_id => $quantity) {
                    if ($quantity > 0) {
                        $product = Product::find($product_id);
                        $shoppingCart->addItem([
                            'id' => rand(100000, 1000000),
                            'title' => $product->name,
                            'quantity' => $quantity,
                            'price' => $product->price,
                        ]);

                        $product_detail_row = [
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'title' => $product->name,
                            'price' => $product->price,
                            'quantity' => $quantity,
                        ];
                        OrderDetail::create($product_detail_row);
                    }
                }

                $cart = $shoppingCart->getItems();

                return view("front.payments.index", compact("cart", "mosque", "shoppingCart", "delivery_types", "order"));
            } else {
                return redirect()->back()->withErrors("لم يتم تحديد منتجات ");
            }
        } else {
            return redirect()->back()->withErrors("لم يتم تحديد مسجد ");
        }

        return $request;
    }

    function check(Request $request)
    {
        // $order_id = $request->order_id;
        // $payment_status = false;


        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $order->delivery_type_id = $request->delivery_type_id;
        $order->delivery_name = $request->delivery_name;
        $order->delivery_mobile = $request->delivery_mobile;
        $order->is_gift_card = (isset($request->is_gift_card)) ? $request->is_gift_card : 0;
        if ($request->is_gift_card == 1) {
            $order->gift_sender = $request->gift_sender;
            $order->gift_recipient_name = $request->gift_recipient_name;
            $order->gift_recipient_mobile = $request->gift_recipient_mobile;
            $order->gift_sent_at = $request->gift_sent_at;
        }
        $order->save();
        $add_mosque_favorite = isset($request->add_mosque_favorite) ? $request->add_mosque_favorite : 0;
        if (Auth::check()) {
            if ($add_mosque_favorite == 1) {
                $where = [
                    'user_id' => Auth::user()->id,
                    'mosque_id' => $order->mosque_id,
                ];
                $rows = Favorite::where($where)->get();
                if ($rows->count() < 1) {
                    Favorite::create([
                        'user_id' => Auth::user()->id,
                        'mosque_id' => $order->mosque_id,
                    ]);
                }
            }
            return redirect()->route("front.payment.do", $request->order_id);
        } else {
            session(['link' => route("front.payment.do", $request->order_id)]);
            return redirect()->route("login");
        }
    }

    function do(Request $request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();
        $iphone = false;
        $safari = false;
        if ($device == "iPhone") {
            $iphone = true;
        }
        if ($browser == "Safari") {
            $safari = true;
        }
        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $order->user_id = Auth::user()->id;
        $order->save();
        $this->deleteOldOrders($order);
        $Publishable_API_Key = config("tap.Publishable_API_Key");
        $banks = Bank::where("status", 1)->get();
        return view("front.payments.do", compact("order", "banks", "Publishable_API_Key", "iphone", "safari", "device", "browser"));
    }

    function abandon(Order $order)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();
        $iphone = false;
        $safari = false;
        if ($device == "iPhone") {
            $iphone = true;
        }
        if ($browser == "Safari") {
            $safari = true;
        }
        $where = [
            'id' => $order->id,
            'order_status_id' => 201,
            'user_id' => Auth::user()->id
        ];
        $order = Order::where($where)->firstOrFail();
        if ($order) {
            $Publishable_API_Key = config("tap.Publishable_API_Key");
            $banks = Bank::where("status", 1)->get();
            return view("front.payments.abandon", compact("order", "banks", "Publishable_API_Key", "iphone", "safari", "device", "browser"));
        }
        return redirect()->route("front.mosques");
    }

    function coupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:2',
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => false,
                'message' => 'رقم كوبون الهدايا غير صحيح',
            ];
            return response()->json($data);
        }

        $coupon = Coupon::where(['code' => $request->code, 'status' => 1])->first();
        if (!$coupon) {
            $data = [
                'status' => false,
                'message' => 'رقم كوبون الهدايا غير موجود أو تم إيقافه',
            ];
            return response()->json($data);
        }
        $order = Order::where(['id' => $request->order_id])->first();
        $where = [
            'order_id' => $request->order_id,
            'product_id' => $coupon->product_id,
        ];
        $orderDetails = OrderDetail::where($where)->get();
        Log::info(print_r($orderDetails->toArray(), true));
        if ($orderDetails->count() > 0) {
            $data = [
                'status' => false,
                'message' => 'تم استخدام الكوبون مسبقاً',
            ];
            return response()->json($data);
        }
        $product = Product::find($coupon->product_id);
        $quantity = floor($order->total / 100 * $coupon->quantity);
        OrderDetail::create([
            'title' => $product->name_ar,
            'price' => 0,
            'quantity' => $quantity,
            'product_id' => $product->id,
            'order_id' => $request->order_id
        ]);
        $order->marketer_id = $coupon->marketer_id;
        $order->save();
        // $marketer = Marketer::find($coupon->marketer_id)

        $data = [
            'status' => true,
            'message' => 'تم إضافة عدد ' . $quantity . ' كرتون هدية لطلبكم بنجاح',
        ];

        return response()->json($data);
    }


    function applepay(Request $request)
    {
        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $user = Auth::user();
        $customer = [
            "first_name" => $user->mobile, //$user->name,
            "email" => $user->mobile . "@qatra.sa", //$user->email,
            "phone" => [
                'country_code' => substr($user->mobile, 0, 3),
                'number' => substr($user->mobile, 3),
            ],
        ];
        $tap = new TapPayment();
        $amount = $order->total;
        $payment = $tap->applepay($amount, "Order #" . $order->id, $customer, route("front.payment.result", $order->id));
        if ($payment !== false) {
            return redirect($payment->transaction->url);
        } else {
            return redirect()->back()->withErrors("عذراً .. لا يمكن استخدام Apple Pay في الوقت الحالي");
        }
        // Log::info($payment);

    }

    function transfer(Request $request, $order_id)
    {
        $request->validate([
            'transfer_img' => 'required|mimes:jpeg,jpg,png,pdf',
            'bank_id' => 'required|numeric',
        ]);
        $order = Order::find($order_id);
        $order->order_status_id = 202;
        $order->payment_type_id = 2;
        $order->save();
        $UploadFile = new UploadFile;
        $row['transfer_img'] = $UploadFile->store($request->file('transfer_img'));
        $row['order_id'] = $order_id;
        $row['bank_id'] = $request->bank_id;
        $row['amount'] = $order->total;
        Transfer::create($row);

        return view("front.payments.resultbank", compact("order"));
    }


    function charge(Request $request)
    {
        $tap = new TapPayment();
        $user = Auth::user();
        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $customer = [
            "first_name" => $user->mobile, //$user->name,
            "email" => $user->mobile . "@qatra.sa", //$user->email,
            "phone" => [
                'country_code' => substr($user->mobile, 0, 3),
                'number' => substr($user->mobile, 3),
            ],
        ];
        $amount = $order->total;
        $payment = $tap->charge($request->tapToken, $amount, "Order #" . $order->id, $customer, route("front.payment.result", $order->id));
        if ($payment && isset($tap->data_return->transaction->url)) {
            return redirect($tap->data_return->transaction->url);
        } else {
            return redirect()->back()->withErrors($tap->last_error);
        }
    }


    function result(Request $request, $order_id)
    {
        $payment_status = false;
        $tap = new TapPayment();
        $order = Order::where(['id' => $order_id, 'order_status_id' => 301, 'user_id' => Auth::user()->id])->first();
        if ($order) {
            return redirect()->route("front.orders.item", $order->id);
        }
        $order = Order::where(['id' => $order_id, 'order_status_id' => 201, 'user_id' => Auth::user()->id])->first();
        if ($tap->check($request->tap_id) && isset($tap->data_return->id)) {
            $data_return = $tap->data_return;
        } else {
            return redirect()->route("front.home");
        }

        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device = $agent->device();
        $device_family = "Unknown";
        if ($agent->isDesktop()) $device_family = "Desktop";
        if ($agent->isMobile()) $device_family = "Mobile";
        if ($agent->isTablet()) $device_family = "Tablet";
        if ($agent->isRobot()) $device_family = "Robot";

        $row = [
            'order_id' => $order->id,
            'user_id' => Auth::user()->id,
            'amount' => $order->amount,
            'transaction_id' => $data_return->id,
            'status' => $data_return->response->code,
            'ip' => $request->ip(),
            'device_family' => $device_family,
            'device_model' => $agent->device(),
            'browser_family' => $browser,
            'browser_version' => $agent->version($browser),
            'platform_family' => $platform,
            'platform_version' => $agent->version($platform),
        ];
        if (isset($data_return->card)) {
            if (isset($data_return->card->last_four))
                $row['last4'] = $data_return->card->last_four;
            else
                $row['last4'] = "0000";
            if (isset($data_return->source->payment_method) && isset($data_return->card->brand))
                $row['brand'] = $data_return->source->payment_method . " - " . $data_return->card->brand;
        } else {
            $row['last4'] = "0000";
            // $row['brand'] = "ApplePay";
            if (isset($data_return->source->payment_method))
                $row['brand'] = $data_return->source->payment_method;
        }
        Log::info(var_export($data_return));
        Log::info(var_export($row));

        $payment = Payment::create($row);

        if ($data_return->response->code == "000") {
            $row = [
                'order_status_id' => 301,
                'payment_id' => $payment->id,
                'payment_type_id' => 1,
                // 'status' => 2,
            ];
            $order->update($row);
            $sender = new Sender();
            $sender->process($order->id, 201);
            GiftCard::send($order);
            return redirect()->route("front.payment.show", $order->id);
        } else {
            return redirect()->route("front.payment.do", $order_id)
                ->withErrors(" عفواً عملية الدفع  لم تتم بشكل صحيح يمكنك إعادة المحاولة مرة أخرى " . "<br>" . " رمز الخطأ : " . $data_return->response->message . '<br>' . 'يمكنك مراسلة الدعم الفني بصورة من هذه الرسالة  لإفادتك عن المشكلة');
        }
    }


    function show(Order $order)
    {
        if ($order->user_id == Auth::user()->id && in_array($order->order_status_id, [100, 301, 501])) {
            return view("front.payments.result", compact("order"));
        } else {
            abort(403);
        }
    }

    function deleteOldOrders(Order $order)
    {
        $where = [
            'user_id' => Auth::user()->id,
            'order_status_id' => 201,
            ['id', '<', $order->id],
        ];
        Order::where($where)->delete();
    }
}
