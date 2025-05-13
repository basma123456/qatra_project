<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Mosque;
use App\Models\Product;
//use Gloudemans\Shoppingcart\Facades\Cart;
use  Jackiedo\Cart\Facades\Cart;
use Illuminate\Http\Request;

class CartControler extends Controller
{

    public function index(Request $request)
    {
        $districts = District::get();
        $mosques = Mosque::get();
        $cities = City::get();
        $cart = Cart::getDetails();

        return view('client.add_to_cart' , compact('districts' , 'mosques' , 'cities', 'cart'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = Cart::name('shopping')->useForCommercial()->addItem([
            'id' => $product->id,
            'title' => $product->name_ar,
            'quantity' => (int)$request->qty,
            'price' => $product->price,
        ]);

        return redirect()->back();
    }


    public function minusFromCart($unique , Request $request)
    {

        $product = Product::findOrFail($request->product_id);
        $myCart = Cart::getDetails()->items;
        dd($myCart);
        $cart = Cart::name('shopping')->useForCommercial()->updateItem([
            'id' => $product->id,
            'title' => $product->name_ar,
            'quantity' =>   $this->qty[$product->id] - 1,
            'price' => $product->price,
            'total_price' =>  $this->priceQty[$product->id] - $product->price,
        ]);
    }

}
