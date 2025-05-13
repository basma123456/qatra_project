<?php

namespace App\Http\Controllers\Marketing\MarketerAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:marketer_admin');
    }
    public function index(Request $request)
    {
        return view('marketer_admin/orders/index');
    }

}
