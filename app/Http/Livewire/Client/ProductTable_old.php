<?php

namespace App\Http\Livewire\Client;

use App\Models\Product;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class ProductTable_old extends Component
{
    public array $qty = [];
    public array $priceQty = [];
    public array $allCarts = [];

    public $cart;


    public $products;

    public function mount()
    {
        $this->products = Product::active()->feature()->get();
        foreach ($this->products as $product) {
            $this->qty[$product->id] = 0;
            $this->priceQty[$product->id] = $product->price;
        }

    }


    public function render()
    {
        $this->cart = Cart::getDetails()->items;
        return view('livewire.client.product-table');
    }

    public function addToCart($hash, $product_id)
    {

        $product = Product::findOrFail($product_id);


        if ($this->qty[$product_id] == 0 && (!isset($hash['quantity']) || $hash['quantity'] < 1)) {
            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => 1,
                'price' => $product->price,
                'total_price' => $product->price,
                'taxable' => $product->taxable,
            ]);

            $this->qty[$product_id] = 1;
            $this->priceQty[$product_id] = $product->price;

        } else {



            $newQty = +($hash['quantity']) + 1;
            $newTotal = +($hash['total_price']) + $product->price;
            $cart = Cart::updateItem($hash['hash'], [
                'quantity' => $newQty,
                'total_price' => $newTotal,

            ]);

            $this->qty[$product->id] = $newQty;
            $this->priceQty[$product->id] = $newTotal;

        }


    }


    public function minusFromCart($hash, $product_id)
    {


        $product = Product::findOrFail($product_id);
        if( $hash['quantity'] == 1 && isset($hash['hash'])){
       return     Cart::removeItem($hash['hash'] , true);
        }


        $newQty = $hash['quantity'] - 1;
        $newTotal = $hash['total_price'] - $product->price;
        $cartItem = Cart::updateItem($hash['hash'], [
            'quantity' => $newQty,
            'total_price' => $newTotal,

        ]);

        $this->qty[$product->id] = $newQty;
        $this->priceQty[$product->id] = $newTotal;


    }


//    public   $qty;
//    public $product;
//    public $cart;
//
//    public function mount($product , $cart)
//    {
//        $this->product = $product;
//        $this->qty = 1; // Initialize qty with default value of 1
//        $this->cart = $cart;
//    }
//
//    public function render()
//    {
//        return view('livewire.client.product-table');
//    }
//
//    public function addToCart()
//    {
//        $cart = Cart::name('shopping')->useForCommercial()->addItem([
//            'id' => $this->product->id,
//            'title' => $this->product->name_ar,
//            'quantity' => $this->qty,
//            'price' => $this->product->price,
//        ]);
//
//
//    }
//
//    public function updateQty($productId, $quantity)
//    {
//        $this->qty[$productId] = $quantity;
//    }
}
