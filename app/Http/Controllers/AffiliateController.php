<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AffiliateController extends Controller
{
    function index($code)
    {
        $marketer = Marketer::where('affiliate_code', $code)->first();
        if ($marketer) {
            return redirect()->route("client.home", ['aff' => $code])->withCookie(cookie()->forever('marketer_id', $marketer->id));
        } else {
            return redirect()->route("client.home");
        }
    }

    function browse($code)
    {

        $marketer = Marketer::where('browse_code', $code)->first();
        if ($marketer) {
            $where = [
                'marketer_id' => $marketer->id,
                // 'order_status_id'=>100,
                // 'order_status_id'=>301,
                // ['order_status_id','in',[301,100]]
            ];




            /**************************************/
            $date_day = Carbon::today()->subDays(1);
            $date_week = Carbon::today()->subDays(7);
            $date_month = Carbon::today()->subMonth();
            /*********************************************/

            $total_day = Order::where($where)->where('created_at', '>=', $date_day->translatedFormat("Y-m-d H:i:s"))->sum("total");
            $total_week = Order::where($where)->where('created_at', '>=', $date_week->translatedFormat("Y-m-d H:i:s"))->sum("total");
            $total_month = Order::where($where)->where('created_at', '>=', $date_month->translatedFormat("Y-m-d H:i:s"))->sum("total");
            $total_all = Order::where($where)->sum("total");
            $orders = Order::where($where)->orderby("id", "DESC")->paginate(20);

            return view("front.affiliate.index", compact("marketer", "orders", "total_day", "total_week", "total_month", "total_all"));
        } else {
            return redirect()->route("client.home");
        }
    }
}
