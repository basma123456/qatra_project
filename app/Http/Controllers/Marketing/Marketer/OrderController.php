<?php

namespace App\Http\Controllers\Marketing\Marketer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:marketer');
    }
    public function index(Request $request)
    {

        return view('marketer/orders/index');
    }

    /**************************start test****************************/
//    public function index_old(Request $request)
//    {
//        $orderStatus = OrderStatus::get();
//        $paymentMethods = PaymentType::get();
//
//        $query = Order::query();
//
//
//        if ($request->mosque_name_ar != null) {
//            $query->whereRelation('mosque', 'name_ar', 'like', '%' . $request->mosque_name_ar . '%');
//        }
//        if ($request->delivery_type_name != '') {
//            $query->whereRelation('delivery_type', 'name_ar', 'like', '%' . $request->delivery_type_name . '%');
//        }
//        if ($request->payment_type_id != '') { //here
//            $query->where('payment_type_id',  $request->payment_type_id  );
//        }
//        if ($request->order_status_id != '') {
//            $query->where('order_status_id',  $request->order_status_id );
//        }
//
//        /**************************/
//        if ($request->assigned_at_from != '' && $request->assigned_at_to != '') {
//            $query->whereBetween('assigned_at', [$request->assigned_at_from, $request->assigned_at_to]);
//        }
//        if ($request->assigned_at_from != '') {
//            $query->whereDate('assigned_at', '>=', $request->assigned_at_from);
//        }
//        if ($request->assigned_at_to != '') {
//            $query->whereDate('assigned_at', '<=', $request->assigned_at_to);
//        }
//
//        /*********************/
//
//        /*********************/
//        if ($request->total_from != '' && $request->total_to != '') {
//            $query->whereBetween('total', [(float)$request->total_from, (float)$request->total_to]);
//        }
//
//
//        if ($request->total_from != '' && is_numeric($request->total_from)) {
//            $query->where('total', '>=', (float)$request->total_from);
//        }
//        if ($request->total_to != '' && is_numeric($request->total_to)) {
//            $query->where('total', '<=', $request->total_to);
//        }
//        /*****************/
//        /****************/
//        if ($request->tax_from != '' && $request->tax_to != '') {
//            $query->whereBetween('tax', [$request->tax_from, $request->tax_to]);
//        }
//        if ($request->tax_from != '' && is_numeric($request->tax_from)) {
//            $query->where('tax', '>=', $request->tax_from);
//        }
//        if ($request->tax_to != '' && is_numeric($request->tax_to)) {
//            $query->where('tax', '<=', $request->tax_to);
//        }
//        /*****************/
//
//
//        if ($request->gift_sender != '') {
//            $query->where('gift_sender', 'like', '%' . $request->gift_sender . '%');
//        }
//        if ($request->gift_sender_name != '') {
//            $query->where('gift_sender_name', 'like', '%' . $request->gift_sender_name . '%');
//        }
//        if ($request->gift_recipient_name != '') {
//            $query->where('gift_recipient_name', 'like', '%' . $request->gift_recipient_name . '%');
//        }
//        if ($request->gift_recipient_mobile != '') {
//            $query->where('gift_recipient_mobile', 'like', '%' . $request->gift_recipient_mobile . '%');
//        }
//
//
//        if ($request->delivery_mobile != '') {
//
//            $query = $query->where('delivery_mobile', 'like', '%' . request()->input('delivery_mobile') . '%');
//        }
//        if ($request->delivery_name != '') {
//
//            $query = $query->where('delivery_name', 'like', '%' . request()->input('delivery_name') . '%');
//        }
//
////        $items = $query->where('marketer_id', auth()->guard('marketer')->id())->latest()->paginate($this->pagination_count);
//        $items = $query->latest()->paginate($this->pagination_count);
//
//
//        return view('marketer/orders/index_old', compact('items' , 'orderStatus' , 'paymentMethods'));
//    }
    /**************************end test****************************/

    public function show($id)
    {
//        $order = Order::where(['marketer_id' => auth()->guard('marketer')->id(), 'id' => $id])->first();
        $order = Order::findOrFail($id);
        return view('marketer/orders/show', compact('order'));
    }

    public function test()
    {
        return view('marketer/orders/test');
    }
}
