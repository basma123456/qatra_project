<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyProductsIncomeReportsController extends Controller
{
    public function index(Request $request)
    {
//        $items = OrderDetail::with('product')
//            ->whereBetween('created_at' , [now()->startOfMonth() , now()])
//            ->where('coupon' , 0)
//            ->select(['created_at' , 'product_id' , DB::raw('sum(price * quantity) as total') , DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')  as date') ])
//            ->groupBy(['created_at' , 'product_id'])
//            ->get()
//            ->groupBy('product_id');
        $items = OrderDetail::with('product');
        if($request->get('product_name') != ''){
            $items = $items->where('product_id' , $request->get('product_name'));
        }

       if ($request->get('from_date') != '' && $request->get('to_date') =='' ){
              $items = $items  ->whereDate('created_at', '>' ,Carbon::make($request->get('from_date')))
                ->where('coupon', 0)
                ->select(['created_at', 'product_id', DB::raw('sum(price * quantity) as total'), DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')  as date')])
                ->groupBy(['created_at', 'product_id'])
                ->get()
                ->groupBy('product_id');


            $dateRange = CarbonPeriod::create(Carbon::make($request->get('from_date')), now());

        }elseif ( $request->get('from_date') == '' && $request->get('to_date') != '' ){
           $items = $items
                ->whereDate('created_at', '<' , Carbon::make($request->get('to_date')))
                ->where('coupon', 0)
                ->select(['created_at', 'product_id', DB::raw('sum(price * quantity) as total'), DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')  as date')])
                ->groupBy(['created_at', 'product_id'])
                ->get()
                ->groupBy('product_id');


            $dateRange = CarbonPeriod::create(now()->subDays(6), Carbon::make($request->get('to_date')));

        }elseif ($request->get('to_date') != '' && $request->get('from_date') !=''){
           $items = $items
                ->whereBetween('created_at', [Carbon::make($request->get('from_date')), Carbon::make($request->get('to_date'))])
                ->where('coupon', 0)
                ->select(['created_at', 'product_id', DB::raw('sum(price * quantity) as total'), DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')  as date')])
                ->groupBy(['created_at', 'product_id'])
                ->get()
                ->groupBy('product_id');


            $dateRange = CarbonPeriod::create(Carbon::make($request->get('from_date')), Carbon::make($request->get('to_date')));
        }else{
           $items = $items
               ->whereBetween('created_at', [now()->subDays(6), now()])
               ->where('coupon', 0)
               ->select(['created_at', 'product_id', DB::raw('sum(price * quantity) as total'), DB::raw('DATE_FORMAT(created_at, \'%Y-%m-%d\')  as date')])
               ->groupBy(['created_at', 'product_id'])
               ->get()
               ->groupBy('product_id');


           $dateRange = CarbonPeriod::create(now()->subDays(6), now());

       }
        return view('admin.reports.products_daily_income' , compact('items' , 'dateRange'));
    }
}
