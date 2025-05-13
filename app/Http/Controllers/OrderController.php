<?php

namespace App\Http\Controllers;

use App\Helpers\OrderPublic;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use PDF ;
use App\Helpers\ZATCA;
use App\Policies\OrderPolicy;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [
            ['id', '!=', '201']
        ];
        $orders = [];
        $order_statuses = OrderStatus::where($where)->get();

        foreach ($order_statuses as $order_status) {
            $where = [
                'order_status_id'=> $order_status->id,
                'user_id'=> Auth::user()->id
            ];
            $temp =  Order::where($where)->get();
            if ($temp->count() > 0) {
                $orders[$order_status->name] = $temp;
            }
        }
        return view("front.orders.index", compact("orders"));
    }

    function item(Order $order){
        // return $order;
        $where = [
            'id'=> $order->id,
            'user_id'=> Auth::user()->id
        ];
        $order = Order::where($where)->firstOrFail();
        return view("front.orders.item", compact("order"));
    }

    function pdf(Order $order,$user_check = true){

        if($user_check){
            $where = [
                'id'=> $order->id,
                'user_id'=> Auth::user()->id
            ];
        }else{
            $where = [
                'id'=> $order->id,
            ];
        }

        $sheet_h = 200 + ($order->details->count() * 9);
        $order = Order::where($where)->firstOrFail();



        $dataToEncode = [
            [1, 'شركة رؤية للتجارة'],
            [2, '311215850700003'],
            [3, Carbon::parse($order->created_at)->format("Y-m-d") . 'T' . Carbon::parse($order->created_at)->format("H:i:s") . ':00Z'],
            [4, $order->total],
            [5, $order->tax]
        ];

        $url = ZATCA::getCode($dataToEncode);
        $qrcode = "";
        $qrcode = QrCode::size(200)->style('round')->format('png')->eye('circle')->generate($url);
        $data = ['order'=>$order,'sheet_h'=>$sheet_h,'qrcode'=>$qrcode];
        // return view("front.orders.pdf",$data);
        $pdf = PDF::loadView("front.orders.pdf",$data);
        return $pdf->stream("Order_".$order->id.".pdf");
        // return view("front.orders.pdf", compact("order"));
    }

    function pdf2($code){
        $order_id = OrderPublic::checkCode($code);
        if($order_id != false){
            $order = Order::findOrFail($order_id);
            return $this->pdf($order,false);
        }
        return abort(403);
    }

    function track(Order $order){
        $where = [
            'id'=> $order->id,
            'user_id'=> Auth::user()->id
        ];
        $order = Order::where($where)->firstOrFail();
        return view("front.orders.track", compact("order"));
    }
}
