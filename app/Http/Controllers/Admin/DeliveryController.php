<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Sender;
use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use App\Models\Mosque;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use App\Helpers\UploadFile;
use App\Models\OrderImage;
use App\Models\OrderMessage;
use Exception;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    function index(Request $request)
    {
        $where1 = [
            'user_id' => Auth::user()->id
        ];
        $where2 = [
            ['delivered_at', '=', null]
        ];
        $myorders = DriverOrder::where($where1)->whereIn('order_id', Order::where($where2)->pluck('id'))->orderBy("distance")->get();
        $lat = $request->session()->get('lat', null);
        $long = $request->session()->get('long', null);
        // return $myorders;
        return view("admin.delivery.index", compact("myorders", "lat", "long"));
    }

    function update(Request $request)
    {
        // abort(403);
        $UploadFile = new UploadFile;
        $i = 0;
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $img) {
                if ($img) {
                    $img_uploaded = $UploadFile->store($img);
                    OrderImage::create([
                        'user_id' => Auth::user()->id,
                        'order_id' => $request->order_id,
                        'img' => $img_uploaded,
                    ]);
                }
            }
        }
        if ($request->message) {
            OrderMessage::create([
                'user_id' => Auth::user()->id,
                'order_id' => $request->order_id,
                'message' => $request->message,
            ]);
        } else {
            OrderMessage::create([
                'user_id' => Auth::user()->id,
                'order_id' => $request->order_id,
                'message' => "تم التوصيل",
            ]);
        }

        if ($request->status == 1) {
            $order = Order::find($request->order_id);
            $order->order_status_id = 100;
            $order->delivered_at = now();
            $order->save();
            $result = [
                'status' => 1
            ];
            $sender = new Sender();
            $sender->process($order->id, 401);
        } else {
            $result = [
                'status' => 1
            ];
        }
        // $result = [
        //     'status' => 0
        // ];
        return json_encode($result);
    }

    function position(Request $request, $lat, $long)
    {
        // $request->session->set();
        $request->session()->put('lat', $lat);
        $request->session()->put('long', $long);
        $where = [
            'user_id' => Auth::user()->id
        ];
        $myorders = DriverOrder::where($where)->get();
        // $where = [
        //     ['delivered_at', '=', null]
        // ];
        // $orders = Order::where($where)->whereIn('id', $myorders)->get();
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
        return redirect()->route("admin.delivery.index");
    }

    function Distance($latFrom, $longFrom, $latTo, $longTo)
    {
        $latFrom = deg2rad($latFrom);
        $longFrom = deg2rad($longFrom);
        $latTo = deg2rad($latTo);
        $longTo = deg2rad($longTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $longTo - $longFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * 6371000 / 1000; //Earth Radius
    }
}
