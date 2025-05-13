<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\VisitorPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReportController extends Controller
{
    public function cities()
    {
        $reportData = City::with(['mosques.orders' => function ($query) {
            $query->where('order_status_id', 100);
        }])->get()->map(function ($city) {
            return [
                'city_name' => $city->name_ar,
                'total_orders' => $city->mosques->sum(function ($mosque) {
                    return $mosque->orders->sum('total');
                }),
                'orders_count' => $city->mosques->sum(function ($mosque) {
                    return $mosque->orders->count();
                }),
            ];
        });

        return view("admin.reports.cities", compact("reportData"));
    }

    public function products(Request $request)
    {
        $dateFrom = $request->input('date_from', null);
        $dateTo = $request->input('date_to', null);

        $reportData = Product::with(['orderDetails' => function ($query) use ($dateFrom, $dateTo) {
            $query->whereHas('order', function ($query) use ($dateFrom, $dateTo) {
                $query->where('order_status_id', 100)->when($dateFrom, function ($q) use ($dateFrom) {
                    $q->whereDate('created_at', '>=', $dateFrom);
                })->when($dateTo, function ($q) use ($dateTo) {
                    $q->whereDate('created_at', '<=', $dateTo);
                });
            });
        }])->get()
            ->map(function ($product) {
                $totalOrders = $product->orderDetails->groupBy('order_id')->count();
                $totalQuantity = $product->orderDetails->sum('quantity');
                $totalRevenue = $product->orderDetails->sum(function ($detail) {
                    return $detail->quantity * $detail->price;
                });
                return [
                    'product_name' => $product->name,
                    'total_orders' => $totalOrders,
                    'total_quantity_sold' => $totalQuantity,
                    'total_revenue' => $totalRevenue,
                ];
            })->sortByDesc('total_revenue')->values();

        return view('admin.reports.products', compact('reportData'));
    }

    public function visitors()
    {
        $reportData = VisitorPage::select('page')
            ->selectRaw('COUNT(*) as total_visits')
            ->groupBy('page')
            ->get();

        return view('admin.reports.visitors', compact('reportData'));
    }

}
