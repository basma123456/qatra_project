<?php

namespace App\Http\Livewire\Client\Payments;

use App\Helpers\TapPayment;
use App\Models\Bank;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class Visa extends Component
{
    public $payment_method_id = 1;
    public $taxes, $note;

    public $card_number = "", $card_name = "", $expired_year = "", $expired_month = "", $cvv = "";
    public $selected_card = "", $selected_cvv = "", $savecard = "";
    public $myCards = [], $showNewCard = true, $error_message = "";

    protected $listeners = ['updateAuth'];


    public function mount($taxes, $note)
    {

        $this->taxes = $taxes;
        $this->note = $note;
    }
    public function updateAuth()
    {
        if (@auth()->user() != null) {
            $this->render();
        }
    }

    protected function rules()
    {
        if ($this->selected_card) {
            return [
                'selected_card' => 'required',
                'selected_cvv'  => 'required|min:3|max:3',
            ];
        } else {
            return [
                'card_number'   => 'required|min:16|max:16',
                'card_name'     => 'required|min:3',
                'expired_year'  => 'required|min:2|max:2',
                'expired_month' => 'required|min:2|max:2',
                'cvv'           => 'required|min:3|max:3',
                'savecard'      => 'nullable',
            ];
        }
    }

    public function getSanitized()
    {
        $data = $this->validate();
        $data['payment_method_id'] = $this->payment_method_id;
        return $data;
    }

    public function UpdatedSelectedCard()
    {
        $this->showNewCard = 0;
        $this->selected_cvv = "";
    }
    public function addNewCardBlock()
    {
        $this->showNewCard = $this->showNewCard ?  0 : 1;
        $this->selected_card = "";
    }

    public function checkout()
    {
        $this->getSanitized();

        $order = $this->savingOrder();
        $tap = new TapPayment();
        $customer = [
            "first_name" => Auth::user()->mobile, //Auth::user()->name,
            "email" => Auth::user()->mobile . "@qatra.sa", //Auth::user()->email,
            "phone" => [
                'country_code' => substr(Auth::user()->mobile, 0, 3),
                'number' => substr(Auth::user()->mobile, 3),
            ],
        ];

        $payment = $tap->charge(request()->tapToken,  $order->total, "Order #" . $order->id, $customer, route("front.payment.result", $order->id));
        if ($payment && isset($tap->data_return->transaction->url)) {
            return redirect($tap->data_return->transaction->url);
        } else {
            return redirect()->back()->withErrors($tap->last_error);
        }

        // $tap = new TapPayment();
        // $user = Auth::user();
    }
    /**
     * Summary of savingOrder
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    private function savingOrder()
    {

        $shoppingCart = Cart::name('shopping');
        $cart = $shoppingCart->getDetails();
        DB::beginTransaction();
        try {
            $this->taxes = $this->taxes * 0.15;

            $order = Order::create([
                'marketer_id' => Cookie::get("marketer_id"),
                'amount' => $cart['items_subtotal'],
                'tax' => $this->taxes,
                'total' => $cart['items_subtotal'] + $this->taxes,
                'user_id' => Auth::user()->id,
                'order_status_id' => 201,
                'payment_type_id' => $this->payment_method_id,
                'note' => $shoppingCart->getExtraInfo('note'),
            ]);

            foreach ($cart['items'] as $item) {
                $product_detail_row = [
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'title' => $item->title,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'city_id' => $item->options['city_id'],
                    'district_id' => $item->options['district_id'],
                    'mosque_id' => $item->options['mosque_id'],

                    'is_gift_card' => optional($item->options)['sender_name'] != "" ? 1 : 0,
                    'gift_sender' => optional($item->options)['sender_name'],
                    'gift_recipient_name' => optional($item->options)['recipient_name'],
                    'gift_recipient_mobile' => optional($item->options)['recipient_mobile'],
                    'delivery_name' => optional($item->options)['delivery_name'],
                    'delivery_mobile' => optional($item->options)['delivery_mobile'],
                    'delivery_type_id' => optional($item->options)['delivery_type_id'],
                ];
                OrderDetail::create($product_detail_row);

                // store favorite mosque
                if (@$item->options['favoriteMosque'] != null) {
                    auth()->user()->favoriteMosques()->syncWithoutDetaching([$item->options['mosque_id']]);
                }

                // store all  favorite mosque
                if ($shoppingCart->getExtraInfo('favoriteMosque')) {
                    auth()->user()->favoriteMosques()->syncWithoutDetaching([$item->options['mosque_id']]);
                }
            }

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

            DB::commit();
            return $order;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function visaInit()
    {
        $order= $this->savingOrder();
        $tap = new TapPayment();
        $customer = [
            "first_name" => Auth::user()->mobile, //Auth::user()->name,
            "email" => Auth::user()->mobile . "@qatra.sa", //Auth::user()->email,
            "phone" => [
                'country_code' => substr(Auth::user()->mobile, 0, 3),
                'number' => substr(Auth::user()->mobile, 3),
            ],
        ];

        $payment = $tap->charge(request()->tapToken,  $order->total, "Order #" . $order->id, $customer, route("front.payment.result", $order->id));
        if ($payment && isset($tap->data_return->transaction->url)) {
            return redirect($tap->data_return->transaction->url);
        } else {
            $this->error_message = @$payment->errors[0]?->description;
            // return redirect()->back()->withErrors($tap->last_error);
        }

    }
    public function render()
    {
        $cart = Cart::name('shopping')->getDetails();
        return view('livewire.client.payments.visa', ['cart' => $cart]);
    }
}
