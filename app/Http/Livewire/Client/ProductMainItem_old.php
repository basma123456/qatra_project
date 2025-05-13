<?php

namespace App\Http\Livewire\Client;

use App\Models\Mosque;
use App\Models\Product;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class ProductMainItem_old extends Component
{


    public $qty;
    public $priceQty;
    public array $allCarts = [];
    public $cart;
    public $product;
    public $hash;
//    public $mosques;
//    public $districts;

    public $selectedOptionMosque;

    public function mount($product)
    {
        $this->product = $product;

        $this->qty = 0;
        $this->priceQty = $product->price;
    }


    public function render()
    {
        $this->cart = Cart::getDetails()->items;
        foreach (Cart::getDetails()->items as $key => $val) {
            if ($val->id === $this->product->id) {
                $this->hash = $val;
            }
        }
        return view('livewire.client.product-main-item');
    }


    public function redirectToMosquesProducts($selectedOptionMosque)
    {
        $this->selectedOptionMosque = $selectedOptionMosque;
        if (!is_numeric($this->selectedOptionMosque) || !Mosque::find($this->selectedOptionMosque)) {
//            $this->emit('redirect', ['url' => '/']);
            $this->emit('redirect', ['url' => '/#ProductSwiper']);

//            $this->dispatchBrowserEvent('redirect',  ['url' => url('/?mosque=' . $this->selectedOptionMosque )]);
            return;
        }
          $this->emit('redirect', ['url' => url('/?mosque=' . $this->selectedOptionMosque . "#ProductSwiper")]);

//            $this->dispatchBrowserEvent('redirect', ['url' => url('/?mosque=' . $this->selectedOptionMosque )]);
    }


    public function addToCart()
    {
        $product = $this->product;
        if ($this->qty == 0 && !isset($this->hash['quantity'])) {
            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => 1,
                'price' => $product->price,
                'total_price' => $product->price,
                'taxable' => $product->taxable,
            ]);
            $this->qty = 1;
            $this->priceQty = $product->price;
        } elseif (isset($this->hash['quantity']) && $this->qty !== 0) {
            $product = $this->product;
            $product_id = $this->product->id;
            $newQty = $this->hash['quantity'] + 1;
            $newTotal = $this->hash['total_price'] + $product->price;
            $cartItem = Cart::updateItem($this->hash['hash'], [
                'quantity' => $newQty,
                'total_price' => $newTotal,
            ]);
            $this->qty = $newQty;
            $this->priceQty = $newTotal;
        } else {
            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => 1,
                'price' => $product->price,
                'total_price' => $product->price,
            ]);
            $this->qty = 1;
            $this->priceQty = $product->price;

        }

        $this->emit('cart_updated');
        toastr()->success('تم الاضافة الي السلة بنجاح!');


    }


    public function minusFromCart()
    {
        $product = $this->product;
        $product_id = $this->product->id;
        if (isset($this->hash['hash']) && isset($this->hash['quantity']) && $this->hash['quantity'] == 1) {

            $this->qty = 0;
            $this->priceQty = $product->price;
            if (Cart::hasItem($this->hash['hash'])) {
                Cart::removeItem($this->hash['hash'], true);
            }
            $this->emit('cart_updated');
            $this->render();
        } elseif (isset($this->hash['hash']) && isset($this->hash['quantity']) && $this->qty > 0) {

            $newQty = $this->hash['quantity'] - 1;
            $newTotal = $this->hash['total_price'] - $product->price;
            $cartItem = Cart::updateItem($this->hash['hash'], [
                'quantity' => $newQty,
                'total_price' => $newTotal,
            ]);
            $this->qty = $newQty;
            $this->priceQty = $newTotal;


            toastr()->warning('تم الازالة من السلة بنجاح!');
            $this->emit('cart_updated');

        } elseif ($this->qty < 1) {
            $this->emit('cart_updated');


        }


    }


}
