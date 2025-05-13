<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientReportController extends Controller
{
    public function index(Request $request)
    {
        $orderTotals = DB::table('orders')
            ->select('user_id', DB::raw('COUNT(*) as all_count'), DB::raw('SUM(total) as all_total'))
            ->groupBy('user_id');

        // Date filters on the subquery (order totals)
        if ($request->to_date && $request->from_date) {
            $orderTotals->whereBetween('created_at', [$request->from_date, $request->to_date]);
        } elseif ($request->to_date) {
            $orderTotals->where('created_at', '<', $request->to_date);
        } elseif ($request->from_date) {
            $orderTotals->where('created_at', '>', $request->from_date);
        }

        $items = DB::table('users as u')
            ->select('u.name', 'u.mobile', 'u.email', 'ot.user_id', 'ot.all_count', 'ot.all_total')
            ->joinSub($orderTotals, 'ot', 'u.id', '=', 'ot.user_id');

        // User filters on the main query
        if ($request->name) {
            $items->where('u.name', 'like', '%' . $request->name . '%');
        }
        if ($request->mobile) {
            $items->where('u.mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->email) {
            $items->where('u.email', 'like', '%' . $request->email . '%');
        }

        $items = $items->get();

        return view('admin.reports.clients', compact('items'));
    }
//    public function index(Request $request)
//    {
////        $items = User::with('orders')->withCount('orders')->withSum('orders' , 'total')->get();
//        $items = DB::table('orders')->join('users', 'orders.user_id', '=', 'users.id')
//            ->select('users.name',  'users.mobile', 'users.email' , 'user_id', DB::raw('COUNT(*) as all_count'), DB::raw('SUM(total) as all_total'));
//
//        /*********************filters****************************************/
//        if ($request->to_date != '' && $request->from_date != '') {
//            $items = $items->whereBetween('orders.created_at', [$request->from_date , $request->to_date] );
//        }
//        if ($request->to_date != '' && $request->from_date == '') {
//             $items = $items->where('orders.created_at', '<',$request->to_date);
//        }
//        if ($request->from_date != ''&& $request->to_date == '') {
//            $items = $items->where('orders.created_at', '>', $request->from_date);
//        }
//        if ($request->name != '' ) {
//            $items = $items->where('name' , 'like' , '%' . $request->name . '%' );
//        }
//        if ($request->mobile != '' ) {
//            $items = $items->where('mobile' , 'like' , '%' . $request->mobile . '%' );
//        }
//        if ($request->email != '' ) {
//            $items = $items->where('email' , 'like' , '%' . $request->email . '%' );
//        }
//        /*********************filters****************************************/
//
////        $items->groupBy('user_id')
////            ->get();
//        $items = $items->groupBy('orders.user_id')->get(); // Move get() *after* groupBy()
////        assigned_at
////        delivered_at
//        //delivering_at
//        //marketer_id
//        return view('admin.reports.clients', compact('items'));
//    }
}
