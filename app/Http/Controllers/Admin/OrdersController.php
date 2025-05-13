<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\OrderPublic;
use App\Helpers\Sender;
use App\Helpers\ZATCA;
use App\Http\Controllers\Controller;
use App\Mail\SendFile;
use App\Models\Driver;
use App\Models\DriverOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderImage;
use App\Traits\FileHandler;
use Carbon\Carbon;
use Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class OrdersController extends Controller
{
    use FileHandler;

    public function index()
    {
        return view('admin.order.index');
    }

    public function invoices($id)
    {
        $order = Order::find($id);
        $sheet_h = 200 + ($order->details->count() * 9);
        $dataToEncode = [
            [1, 'شركة رؤية للتجارة'],
            [2, '311215850700003'],
            [3, Carbon::parse($order->created_at)->format("Y-m-d") . 'T' . Carbon::parse($order->created_at)->format("H:i:s") . ':00Z'],
            [4, $order->total],
            [5, $order->tax]
        ];

        $url = ZATCA::getCode($dataToEncode);
        $qrcode = "";
        $qrcode = ""; //QrCode::size(200)->style('round')->format('png')->eye('circle')->generate($url);
        $data = ['order' => $order, 'sheet_h' => $sheet_h, 'qrcode' => $qrcode];
        return view('admin.order.invoices', $data);
    }

    public function downloadPdf($id)
    {
        $order = Order::find($id);
        $sheet_h = 200 + ($order->details->count() * 9);
        $dataToEncode = [
            [1, 'شركة رؤية للتجارة'],
            [2, '311215850700003'],
            [3, Carbon::parse($order->created_at)->format("Y-m-d") . 'T' . Carbon::parse($order->created_at)->format("H:i:s") . ':00Z'],
            [4, $order->total],
            [5, $order->tax]
        ];

        $url = ZATCA::getCode($dataToEncode);
        $qrcode = "";
        $qrcode = ""; //QrCode::size(200)->style('round')->format('png')->eye('circle')->generate($url);
        $data = ['order' => $order, 'sheet_h' => $sheet_h, 'qrcode' => $qrcode];
        $pdf = Pdf::loadView("front.order.pdf", $data);
        return $pdf->stream("Order_" . $order->id . ".pdf");
    }

    function addImage(Request $request, Order $order)
    {
        $request->validate([
            'img' => "required|image"
        ]);
        $img = $this->saveFile($request->file('img'), 'orderImages');
        OrderImage::create([
            'user_id' => Auth::guard('admin')->user()->id,
            'order_id' => $order->id,
            'img' => $img,
        ]);
        return redirect()->back()->with('success', 'تم اضافة الصورة بنجاح');
    }


    function deleteImage(OrderImage $order_image)
    {
        $order_id = $order_image->order_id;
        if ((asset('storage/' . $order_image->img))) {
            unlink(storage_path("app/public/" . $order_image->img));
        }

        $order_image->delete();
        return redirect()->back()->with('success', 'تم حذف الصورة بنجاح');
    }


    function assign()
    {
        $where = [
            ['order_status_id', '=', '301']
        ];
        $orders = Order::where($where)->whereNull("assigned_at")->get();
        $drivers = Driver::get();
        return view("admin.order.assign", compact("orders", "drivers"));
    }


    function assign_report()
    {
        $orders = Order::whereNotNull('assigned_at')->where('order_status_id', 301)->get();
        return view("admin.order.assign_report", compact("orders"));
    }

    function set_assign(Request $request)
    {
        DB::beginTransaction();
        try {
            $orders = $request->orders;
            $driver_id = $request->driver_id;
            $total_no_carton = 0;
            // $order_ids = [];
            foreach ($orders as $details_id) {
                $where = [
                    ['id', "=", $details_id],
                    ['assigned_at', "=", null],
                ];
                $orderDetails = OrderDetail::where($where)->first();
                if ($orderDetails) {
                    DriverOrder::create([
                        'order_id' =>  $orderDetails->order->id,
                        'order_details_id' =>$orderDetails->id,
                        'user_id' => $driver_id,
                        'assign_by' => Auth::guard('admin')->user()->id,
                    ]);
                    $orderDetails->assigned_at = now();
                    $orderDetails->save();
                    $sender = new Sender();
                    $sender->processDetails($orderDetails->id, 301);
                    $total_no_carton += intval(@$orderDetails->product->no_carton * $orderDetails->quantity);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
        $sender = new Sender();
        $sender->snedAssign($driver_id, $total_no_carton);
        $this->sendEmail($orders, $driver_id);

        return redirect()->route("admin.orders.assign");
    }

    function sendEmail($order_ids = [], $driver = 2633)
    {
        $driver = Driver::find($driver);
        $email_to = "almarwa.wagdy@gmail.com";
        $email_to1 = "warehouse@fvc-sa.com";
        $email_to2 = "khaled36502@gmail.com";
        
        $orders = OrderDetail::whereIn('id', $order_ids)->get();
        $pdf = PDF::loadView("emails.SendFile", compact("orders", "driver"));

        $filename = "pdf/assign_" . rand(1000000, 10000000) . ".pdf";
        Storage::disk('public')->put($filename, $pdf->output());
        
        Mail::to($email_to)->send(new SendFile($filename));
        Mail::to($email_to1)->send(new SendFile($filename));
        Mail::to($email_to2)->send(new SendFile($filename));
        return 1;
    }


    function pdf2($code){
        $order_id = OrderPublic::checkCode($code);
        if($order_id != false){
            $order = OrderDetail::findOrFail($order_id);
            return $this->pdf($order,false);
        }
        return abort(403);
    }

    function pdf(OrderDetail $order, $user_check = true){

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

        $sheet_h = 200 + (1 * 9);
        $order = OrderDetail::where($where)->firstOrFail();



        $dataToEncode = [
            [1, 'شركة رؤية للتجارة'],
            [2, '311215850700003'],
            [3, Carbon::parse($order->created_at)->format("Y-m-d") . 'T' . Carbon::parse($order->created_at)->format("H:i:s") . ':00Z'],
            [4, $order->order->total],
            [5, $order->order->tax]
        ];

        $url = ZATCA::getCode($dataToEncode);
        $qrcode = "";
        $qrcode = QrCode::size(200)->style('round')->format('png')->eye('circle')->generate($url);
        $data = ['order'=>$order,'sheet_h'=>$sheet_h,'qrcode'=>$qrcode];
        $pdf = PDF::loadView("front.orders.pdf",$data);
        return $pdf->stream("Order_".$order->id.".pdf");
    }
}
