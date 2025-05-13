<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Category;
use App\Models\District;
use App\Models\Mosque;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class HomeController extends Controller
{


    public function index(Request $request)
    {

        $cats = Category::with('activeProducts')->active()->feature()->orderBy('sort', 'ASC')->get();
        if ($request->get('category') && is_string($request->get('category'))) {
            $cat_id = Category::where('slug', $request->category)->value('id');
            $cats = Category::with('activeProducts')->where('id', $cat_id)->active()->feature()->orderBy('sort', 'ASC')->get();

        }

        $cart = Cart::getDetails()->items; //in add to cart page
        $sliders = Slider::get();
        $ads = Ads::active()->feature()->take(2)->get();
        return view('client.index', compact('cats', 'cart' , 'sliders' , 'ads'));
    }

}
