<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Marketer;
use App\Models\Mosque;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Mosque $mosque)
    {
        $code = null;
        if ($request->aff) {
            $code = $request->aff;
            $marketer = Marketer::where('affiliate_code', $code)->first();
            if ($marketer) {
                Cookie::queue('marketer_id', $marketer->id, 21600);
            }
        }
        $where = [
            'status' => 1
        ];
        $products = Product::where($where)->orderby("ordering","asc")->get();
        return view("front.products.index",compact("mosque","products","code"));
    }

    function anymosque(){
        // return "00";
        return redirect()->route("front.products",1595);
    }
}
