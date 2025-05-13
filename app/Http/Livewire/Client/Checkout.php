<?php

namespace App\Http\Livewire\Client;

use App\Models\Bank;
use App\Models\Coupon;
use App\Models\Product;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
;

class Checkout extends Component
{


    public $cart, $items, $banks, $items_subtotal, $taxes = 0;

    public $note = "", $favoriteMosque;
    public $coupon = "", $couponError = "",  $couponMessage = "", $couponGiftProduct = "", $couponGiftQuantity;



    public function addCoupon(){
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->setExtraInfo([ 'coupon' => [] ]);
        $this->couponMessage = "";

        if(strlen($this->coupon) < 4 && gettype($this->coupon) != "string"){
            $this->couponError = "يجب ان يكون عدد الحروف اكثر من 3";
            return ;
        }
        $coupon = Coupon::where(['code' => $this->coupon])->first();
        if($coupon == NULL){
            $this->couponError = "رقم الكوبون غير موجود";
            return ;
        }
        if($coupon->status != 1){
            $this->couponError =  "رقم الكوبون  تم إيقافه";
            return ;
        }
        if($coupon->status != 1){
            $this->couponError =  "رقم الكوبون  تم إيقافه";
            return ;
        }
        $couponProducts = $coupon->products->pluck("id")->toArray();
        if($couponProducts == null){
            $this->couponError = "رقم الكوبون غير صالح";
            return ;
        }
        $validAmount = 0;
        foreach($this->items as $item){
            if(in_array($item['id'], $couponProducts)){
                $validAmount += $item['total_price'];
            }
        }
        $this->couponGiftQuantity = floor($validAmount / 100 * $coupon->quantity);
        $giftProduct = Product::find($coupon->product_id);
        $this->couponGiftProduct = $giftProduct->id;
        $this->couponMessage =  'لديكم  عدد ' . $this->couponGiftQuantity  . ' من '. $giftProduct->name_ar .' لطلبكم ';

        $shoppingCart->setExtraInfo([ 
            'coupon' => [
                    'product_id'=> $this->couponGiftProduct,
                    'product_name'=> $giftProduct->name_ar,
                    'quantity'=> $this->couponGiftQuantity,
                    'price'=> $giftProduct->price
            ],
        ]);

    }

    public function updatedNote()
    {
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->setExtraInfo([ 
            'note' => $this->note,
        ]);
    }
    public function updatedFavoriteMosque()
    {
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->setExtraInfo([ 
            'favoriteMosque' => $this->favoriteMosque,
        ]);
    }

    public function mount(){
      
        $this->cart = Cart::getDetails();
        $this->items = $this->cart->items; 
        $this->banks = Bank::where("status", 1)->get();
        $this->items_subtotal = $this->cart->items_subtotal;
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->removeExtraInfo();
    }

    
    public function render()
    {
        return view('livewire.client.checkout');
    }

}