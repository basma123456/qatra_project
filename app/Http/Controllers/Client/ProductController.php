<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use App\Models\Mosque;
use App\Models\Product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $products = Product::select("id", 'name_ar', 'description_ar', 'status', 'feature', 'sort', 'img', 'price', 'slug')->active()->feature()->orderBy('sort', 'ASC')->get();

        if ($request->get('category') && is_string($request->get('category'))) {
            $cat_id = Category::where('slug', $request->category)->value('id');
            $products = Product::select("id", 'name_ar', 'description_ar', 'status', 'feature', 'sort', 'img', 'price', 'slug')->active()->feature()->where('category_id', $cat_id)->orderBy('sort', 'ASC')->get();
        }

        $cart = Cart::getDetails()->items; //in add to cart page
        $mosques = Mosque::get();
        $districts = District::get();
        $firstProduct = Product::select("id", 'name_ar', 'description_ar', 'status', 'feature', 'sort', 'img', 'price', 'slug')->active()->feature()->orderBy('sort', 'ASC')->first();
        return view('client.products.index', compact('products', 'firstProduct', 'cart', 'mosques', 'districts'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->active()->firstOrFail();
        $districts = District::get();
        $mosques = Mosque::where('status', 1)->get();
        $cities = City::all();
        $cat = Category::with('activeProducts')->find($product->category_id);
        return view('client.products.show', compact('product', 'districts', 'mosques' , 'cities' , 'cat'));
    }
}
