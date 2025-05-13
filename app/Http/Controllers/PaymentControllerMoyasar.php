<?php

namespace App\Http\Controllers;

use App\Helpers\Moyasar;
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

// use Jackiedo\Cart\Cart;

class PaymentControllerMoyasar extends Controller
{
    // protected $cart;
    // public function __construct(Cart $cart)
    // {
    //     $this->cart = $cart;
    // }
    function index(Request $request)
    {
        $delivery_types = DeliveryType::all();
        $shoppingCart   = Cart::name('shopping');
        $shoppingCart->clearItems();
        $shoppingCart->clearTaxes();
        $products = $request->products;
        $where = [
            'status' => 1,
            'id' => $request->mosque_id
        ];
        $mosque = Mosque::where($where)->firstorfail();
        if ($mosque) {
            $total_quantity = 0;
            $total_amount = 0;
            foreach ($products as  $product_id => $quantity) {
                if ($quantity > 0) {
                    $product = Product::find($product_id);
                    $total_quantity += $quantity;
                    $total_amount += $product->price * $quantity;
                }
            }
            if ($total_quantity > 0) {
                $order_row = [];
                $order = Order::create([
                    'order_status_id' => 201,
                    'mosque_id' => $mosque->id,
                    'total' => $total_amount * 1.15,
                    'tax' => $total_amount * 0.15,
                    'user_id' => Auth::user()->id,
                ]);
                foreach ($products as $product_id => $quantity) {
                    if ($quantity > 0) {
                        $product = Product::find($product_id);
                        $shoppingCart->addItem([
                            'id'       => rand(100000, 1000000),
                            'title'    => $product->name,
                            'quantity' => $quantity,
                            'price'    => $product->price,
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
                $shoppingCart->applyTax([
                    'id'       => rand(100000, 1000000),
                    'title'    => "ضريبة المبيعات 15%",
                    'rate' => 15,
                ]);


                $tax = $shoppingCart->getTaxes();
                $cart = $shoppingCart->getItems();
                foreach ($cart as $hash => $item) {
                    // return $item->getDetails();
                }
                // return $shoppingCart->getTaxes();
                // return $items ;//$shoppingCart->getItems();
                return view("front.payments.index", compact("cart", "mosque", "shoppingCart", "delivery_types", "tax", "order"));
            } else {
                return redirect()->back()->withErrors("لم يتم تحديد منتجات ");
            }
        } else {
            return redirect()->back()->withErrors("لم يتم تحديد مسجد ");
        }

        return $request;
    }

    function do(Request $request)
    {
        // $payment_status = false;

        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $order->delivery_type_id = $request->delivery_type_id;
        $order->delivery_name = $request->delivery_name;
        $order->delivery_mobile = $request->delivery_mobile;
        $order->save();
        $add_mosque_favorite = isset($request->add_mosque_favorite) ? $request->add_mosque_favorite : 0;
        if ($add_mosque_favorite == 1) {
            Favorite::create([
                'user_id'=>Auth::user()->id,
                'mosque_id'=>$order->mosque_id,
            ]);
        }
        $payment_form = Moyasar::get_from($order, route("front.payment.result", $order->id));;
        $banks = Bank::where("status", 1)->get();
        return view("front.payments.do", compact("payment_form", "order", "banks"));
    }

    function transfer(Request $request, $order_id)
    {
        $request->validate([
            'transfer_img' => 'required|mimes:jpeg,jpg,png,pdf',
            'bank_id' => 'required|numeric',
        ]);
        $order = Order::find($order_id);
        $order->order_status_id = 202;
        $order->save();
        $UploadFile = new UploadFile;
        $row['transfer_img'] = $UploadFile->store($request->file('transfer_img'));
        $row['order_id'] = $order_id;
        $row['bank_id'] = $request->bank_id;
        $row['amount'] = $order->total;
        Transfer::create($row);

        return view("front.payments.resultbank", compact("order"));
    }
    function result(Request $request)
    {
        $payment_status = false;

        $order = Order::where(['id' => $request->order_id, 'order_status_id' => 201])->firstOrFail();
        $data = \Moyasar\Facades\Payment::fetch($request->id);

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
            'amount' => $data->amount / 100,
            'transaction_id' => $data->id,
            'status' => $data->status,
            'last4' => substr($data->source->number, -4),
            'brand' => $data->source->company,
            'ip' => $data->ip,
            'device_family' => $device_family,
            'device_model' => $agent->device(),
            'browser_family' => $browser,
            'browser_version' => $agent->version($browser),
            'platform_family' => $platform,
            'platform_version' => $agent->version($platform),
        ];
        $payment = Payment::create($row);
        if ($data->status == "paid") {
            $row = [
                'order_status_id' => 301,
                'payment_id' => $payment->id,
                'payment_type_id' => 1,
                'status' => 2,
            ];
            $order->update($row);
            // return redirect()->route("front.orders");
            return view("front.payments.result", compact("order"));
        } else {
            return redirect()->back()
                ->withErrors(" عفواً عملية الدفع باستخدام البطاقة لم تتم بنجاح يمكنك إعادة المحاولة مرة أخرى ، رمز الخطأ : " . $data->source->message);
        }
    }
}
