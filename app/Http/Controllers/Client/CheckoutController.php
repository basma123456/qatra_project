<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Jackiedo\Cart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {

        $allFilled = true;

        foreach (\Jackiedo\Cart\Facades\Cart::getDetails()->items as $key => $item) {

            if ($item->options->city_id == '0' || $item->options->district_id == '-2' || $item->options->mosque_id == '0' || !$item->options->city_id) {
                $allFilled = false;
                break;
            }
        }

        if (!$allFilled) {
            toastr()->error('هناك بعض الحقول الفارغة تاكد من ملء جميع الحقول اولا ........');
            return redirect()->back();
        }


        if (Cart::getDetails()->items_count == 0) {
            toastr()->warning('لا يوجد منتجات في السلة');
            return redirect()->route('client.home');
        }
        return view('client.checkout');
    }


    public function success()
    {
        return view('client.success');
    }

}
