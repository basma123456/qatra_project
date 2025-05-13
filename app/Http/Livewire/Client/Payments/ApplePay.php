<?php

namespace App\Http\Livewire\Client\Payments;

use App\Helpers\TapPayment;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class ApplePay extends Component
{
    public $payment_method_id = 3;
    public $taxes, $note;

    protected $listeners = ['updateAuth'];

    public function updateAuth()
    {
        if (@auth()->user() != null) {
            $this->render();
        }
    }


    public function checkout()
    {

        DB::beginTransaction();
        try {
            $this->taxes = $this->taxes * 0.15;
            $shoppingCart = Cart::name('shopping');
            $cart = $shoppingCart->getDetails();

            $order = Order::create([
                'marketer_id' => Cookie::get("marketer_id"),
                'amount' => $cart->items_subtotal,
                'tax' => $this->taxes,
                'total' => $cart->items_subtotal + $this->taxes,
                'user_id' => Auth::user()->id,
                'order_status_id' => 201,
                'payment_type_id' => $this->payment_method_id,
                'note' => $shoppingCart->getExtraInfo('note'),
            ]);

            foreach ($cart->items as $item) {
                $product_detail_row = [
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'title' => $item->title,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'city_id' => $item->options['city_id'],
                    'district_id' => $item->options['district_id'],
                    'mosque_id' => $item->options['mosque_id'],

                    'is_gift_card' => @$item->options['sender_name'] != "" ? 1 : 0,
                    'gift_sender' => @$item->options['sender_name'],
                    'gift_recipient_name' => @$item->options['recipient_name'],
                    'gift_recipient_mobile' => @$item->options['recipient_mobile'],
                    'delivery_name' => @$item->options['delivery_name'],
                    'delivery_mobile' => @$item->options['delivery_mobile'],
                    'delivery_type_id' => @$item->options['delivery_type_id'],
                ];
                OrderDetail::create($product_detail_row);

                if (@$item->options['favoriteMosque'] != null) {
                    auth()->user()->favoriteMosques()->syncWithoutDetaching([$item->options['mosque_id']]);
                }

                // store favorite mosque 
                if ($shoppingCart->getExtraInfo('favoriteMosque')) {
                    auth()->user()->favoriteMosques()->syncWithoutDetaching([$item->options['mosque_id']]);
                }
            }


            // coupon (add coupon gift to order)
            $shoppingCart = Cart::name('shopping');
            if (isset($shoppingCart->getExtraInfo()['coupon']) && $shoppingCart->getExtraInfo()['coupon'] != null) {
                $giftItem = $shoppingCart->getExtraInfo()['coupon'];
                $product_detail_row = [
                    'order_id' => $order->id,
                    'product_id' => $giftItem['product_id'],
                    'title' => $giftItem['product_name'],
                    'price' => $item['price'],
                    'quantity' => $giftItem['quantity'],
                    'coupon' => 1,
                ];
                OrderDetail::create($product_detail_row);
                $shoppingCart->removeExtraInfo();
            }

            $user = Auth::user();
            $customer = [
                "first_name" => $user->mobile, //$user->name,
                "email" => $user->mobile . "@qatra.sa", //$user->email,
                "phone" => [
                    'country_code' => substr($user->mobile, 0, 3),
                    'number' => substr($user->mobile, 3),
                ],
            ];
            DB::commit();

            $tap = new TapPayment();
            $amount = $order->total;
            $payment = $tap->applepay($amount, "Order #" . $order->id, $customer, route("front.payment.result", $order->id));
            if ($payment !== false) {
                return redirect($payment->transaction->url);
            } else {
                return redirect()->back()->withErrors("عذراً .. لا يمكن استخدام Apple Pay في الوقت الحالي");
            }
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function mount($taxes, $note)
    {
        $this->taxes = $taxes;
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.client.payments.apple-pay');
    }
}
