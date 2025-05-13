<?php

namespace App\Http\Controllers\Driver;

use App\Helpers\Sender;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Driver;
use App\Models\DriverOrder;
use App\Models\Mosque;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderImage;
use App\Models\OrderMessage;
use App\Traits\FileHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class DriverHomeController extends Controller
{
    use FileHandler;

    
    function index()
    {
        return view("driver.home");
    }

    public function mosque(Request $request)
    {
        // return Auth::user();
        $cities = City::all();
        $districts = District::all();
        $query = Mosque::select("*");
        $row_per_page = 20;
        if (isset($request->district_id) && intval($request->district_id) > 0) {
            $query->where('district_id', $request->district_id);
            $row_per_page = 2000;
        }
        if (isset($request->city_id) && intval($request->city_id) > 0) {
            $query->where('city_id', $request->city_id);
            $row_per_page = 2000;
        }

        if ($request->name) {
            $query->where('name_ar', 'LIKE', '%' . $request->name . '%');
            $row_per_page = 2000;
        }

        if (isset($request->status) && $request->status > -1) {
            $query->where('status', $request->status);
            $row_per_page = 2000;
        }


        $mosques = $query->paginate($row_per_page);


        $mosques_count = Mosque::count();
        // $mosques->withPath('/admin/users');
        $capacity = Mosque::sum("capacity");
        return view("driver.mosque", compact("cities", "districts", "mosques", "capacity", "mosques_count", 'request'));
    }

    function delivery(Request $request)
    {

        $where1 = [
            'user_id' => Auth::guard('driver')->user()->id
        ];
        $where2 = [
            ['delivered_at', '=', null]
        ];

        $orderDeatilIDs = OrderDetail::WhereNULL('order_status_id')->pluck("id")->toArray();
        $myorders = DriverOrder::where('user_id', auth::guard('driver')->user()->id)
        ->whereHas('order', function($q){
            $q->where('order_status_id', 301);
        })->whereIn('order_details_id', $orderDeatilIDs)->orderBy("distance")->get();

        $lat = $request->session()->get('lat', null);
        $long = $request->session()->get('long', null);
        // return $myorders;
        return view("driver.delivery", compact("myorders", "lat", "long"));
    }


    function update(Request $request)
    {
        $i = 0;
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $img) {
                if ($img) {
                    $img_uploaded = $this->saveFile($img, 'orderImages');
                    OrderImage::create([
                        'user_id' => Auth::guard('driver')->user()->id,
                        'order_id' => $request->order_id,
                        'order_details_id' => $request->order_details_id,
                        'img' => $img_uploaded,
                    ]);
                }
            }
        }
        if ($request->message) {
            OrderMessage::create([
                'user_id' => Auth::guard('driver')->user()->id,
                'order_id' => $request->order_id,
                'order_details_id' => $request->order_details_id,
                'message' => $request->message,
            ]);
        } else {
            OrderMessage::create([
                'user_id' => Auth::guard('driver')->user()->id,
                'order_id' => $request->order_id,
                'order_details_id' => $request->order_details_id,
                'message' => "تم التوصيل",
            ]);
        }
        // update order Details ID
        if ($request->status == 1) {
            $orderDetails = OrderDetail::find($request->order_details_id);
            $orderDetails->order_status_id = 100;
            $orderDetails->delivered_at = now();
            $orderDetails->save();
        // update order delivery ID
        if($request->order_delivery_id){
            $drivary = DriverOrder::find($request->order_delivery_id);
            $drivary->driver_status_id = 100;
            $drivary->save();
        }
            
         // update order delivery ID
            if( OrderDetail::where('order_id', $orderDetails->order->id)->where('order_status_id', 100)->count() == OrderDetail::where('order_id', $orderDetails->order->id)->count()){
                $order = Order::find($request->order_id);
                $order->order_status_id = 100;
                $order->delivered_at = now();
                $order->save();
            }
            $result = [
                'status' => 1
            ];
            $sender = new Sender();
            $sender->processDetails($orderDetails->id, 401);
        } else {
            $result = [
                'status' => 1
            ];
        }
        return json_encode($result);
    }


    function position(Request $request, $lat, $long)
    {
        $request->session()->put('lat', $lat);
        $request->session()->put('long', $long);
        $where = [
            'user_id' => Auth::user()->id
        ];
        $myorders = DriverOrder::where($where)->get();
      
        foreach ($myorders as $item) {
            // $item->order->mosque;
            try {
                $order = Order::find($item->order_id);
                $mosque = Mosque::find($order->mosque_id);
                $item->distance =  $this->Distance($lat, $long, $mosque->latitude, $mosque->longitude);
                $item->save();
            } catch (Exception $e) {
                Log::error($e->getMessage() . "<br>" . print_r($item->toArray(), true));
            }
        }
        return redirect()->route("drivers.delivery.index");
    }
}
