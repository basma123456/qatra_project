<?php

namespace App\Http\Livewire\Client\Payments;

use App\Models\Bank;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\FileHandler;
use App\Helpers\UploadFile;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transfer;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Jackiedo\Cart\Facades\Cart;

class BankTransfer extends Component
{
    use WithFileUploads, FileHandler;

    protected $listeners = ['updateAuth'];

    public $payment_method_id = 2, $payment_method_key = 'Bank Transfer';
    public $taxes, $note, $cart;
    public $bank_accounts;
    public $bank_id = "", $transfer_img;
    public $account_no = "", $iban = "", $bank_name = "";

    protected function rules()
    {
        return [
            'bank_id' => 'required',
            'transfer_img'   => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function updateAuth()
    {
        if (@auth()->user() != null) {
            $this->render();
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function getSanitized()
    {
        $data = $this->validate();
        if ($data['transfer_img'] != null) {
            $data['transfer_img'] = $this->saveFile($data['transfer_img'], 'bank');
        }
        $data['bank_id'] = $this->payment_method_id;
        return $data;
    }

    public function updatedbankID($val)
    {
        $selectAccount =  $this->bank_accounts->find($val);
        $this->account_no = $selectAccount->account_no;
        $this->bank_name = $selectAccount->account_name;
        $this->iban = $selectAccount->iban;
    }

    public function checkout()
    {

        DB::beginTransaction();
        try {

            $data = $this->getSanitized();
            $this->taxes = $this->taxes * 0.15;

            $shoppingCart = Cart::name('shopping');
            $cart = $shoppingCart->getDetails();

            // Orders
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
            // store Details
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

            // store transfer
            $transfer = Transfer::create([
                'order_id' => $order->id,
                'transfer_img' => $data['transfer_img'],
                'bank_id' => $data['bank_id'],
                'amount' => $data['bank_id'],
            ]);

            // coupon (add coupon gift to order)
            if ($shoppingCart->getExtraInfo('coupon') != []) {
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


            $shoppingCart->clearItems();

            DB::commit();
            session()->flash('success', trans('Your request has been successfully received and is being reviewed'));
            return redirect()->route('client.checkout.success');
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function mount($taxes, $note, $cart)
    {
        $this->bank_accounts = Bank::where('status', 1)->get();
        $this->taxes = $taxes;
        $this->note = $note;
        $this->cart = $cart;
    }

    public function render()
    {
        return view('livewire.client.payments.bank-transfer');
    }
}
