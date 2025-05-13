<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Helpers\Sender;
use App\Helpers\UploadFile;
use App\Helpers\Wati;
use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Helpers\ZATCA;
use App\Mail\SendFile;
use App\Models\OrderImage;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

class OrderController extends Controller
{
    function index(Request $request)
    {
        // return $request->all();
        $query = Order::query();
        // $order_status_array = OrderStatus::pluck('id')->toArray();
        // $where = [
        //     ['order_status_id', '!=', '201']
        // ];
        $request->session()->forget(['order_id', 'total', 'from_date', 'to_date', 'order_status_id']);
        $flag = false;
        if ($request->order_id) {
            // $where['id'] = $request->order_id;
            $request->session()->put('order_id', $request->order_id);
            $query->where('id', $request->order_id);
            $flag = true;
        }
        if ($request->total) {
            // $where[] = ['total', '=', $request->total];
            $request->session()->put('total', $request->total);
            $query->where('total', $request->total);
            $flag = true;
        }
        if ($request->from_date) {
            // $where[] = ['created_at', '>=', date("Y-m-d", strtotime($request->from_date)) . " 00:00:00"];
            $request->session()->put('from_date', $request->from_date);
            $query->where('created_at', '>=', date("Y-m-d", strtotime($request->from_date)) . " 00:00:00");
            $flag = true;
        }
        if ($request->to_date) {
            // $where[] = ['created_at', '<=', date("Y-m-d", strtotime($request->to_date)) . " 23:59:59"];
            $request->session()->put('to_date', $request->to_date);
            $query->where('created_at', '<=', date("Y-m-d", strtotime($request->to_date)) . " 23:59:59");
            $flag = true;
        }
        if (is_array($request->order_status_id)) {
            // $where[] = ['order_status_id', '<=', date("Y-m-d", strtotime($request->to_date)) . " 23:59:59"];
            $request->session()->put('order_status_id', $request->order_status_id);
            // $order_status_array = $request->order_status_id;
            $query->WhereIn('order_status_id', $request->order_status_id);
            $flag = true;
        }
        // whereRaw
        $export = $flag;
        // $where[] = ['user.mobile', '=', $request->total];

        // return $where;

        $query->WhereNotIn('order_status_id', [201]);
        $rows_per_page = ($flag) ? 1000 : 20;
        if ($request->mobile) {
            $orders = $query->whereHas('user', function ($subquery) {
                global $request;
                return $subquery->where('mobile', '=', $request->mobile);
            })->orderByDesc('id')->paginate($rows_per_page);
        } else {
            // dd($query->getBindings() );
            // return $query->toSql();
            $orders = $query->orderByDesc('id')->paginate($rows_per_page);
            // dd($orders);
        }


        $order_statuses = OrderStatus::all();
        return view("admin.orders.index", compact("orders", "statistics", "request", "export", 'order_statuses'));
    }

    public function send_message(Request $request)
    {
        $wati = new Wati();
        $otp = rand(1000, 9999);
        $wati->sendotp("962776501263", $otp);
        return 1;
    }

    function item(Order $order)
    {
        return view("admin.orders.item", compact("order"));
    }

    function assign()
    {
        $where = [
            ['order_status_id', '=', '301']
        ];
        $orders = Order::where($where)->whereNull("assigned_at")->get();
        $drivers = User::role('Driver')->get();
        return view("admin.orders.assign", compact("orders", "drivers"));
    }

    function assign_report()
    {
        $orders = Order::whereNotNull('assigned_at')->where('order_status_id', 301)->get();
        return view("admin.orders.assign_report", compact("orders"));
    }

    function set_assign(Request $request)
    {
        $orders = $request->orders;
        $driver_id = $request->driver_id;
        $total_no_carton = 0;
        // $order_ids = [];
        foreach ($orders as $order_id) {
            $where = [
                ['id', "=", $order_id],
                ['assigned_at', "=", null],
            ];
            $order = Order::where($where)->first();
            if ($order) {
                try {
                    DriverOrder::create([
                        'order_id' => $order_id,
                        'user_id' => $driver_id,
                        'assign_by' => Auth::user()->id,
                    ]);
                    $order->assigned_at = now();
                    $order->save();
                    $sender = new Sender();
                    $sender->process($order->id, 301);
                    foreach ($order->details as $detail) {
                        $total_no_carton += intval($detail->product->no_carton * $detail->quantity);
                    }

                } catch (Exception $e) {
                    $order->assigned_at = now();
                    $order->save();
                    Log::alert($e->getMessage());
                }
                // $order_ids[] = $order->id;
            }
        }
        $sender = new Sender();
        $sender->snedAssign($driver_id, $total_no_carton);
        $this->sendEmail($orders, $driver_id);

        return redirect()->route("admin.order.assign");
    }

    function sendEmail($order_ids = [], $user = 2633)
    {
        $driver = User::find($user);

        $email_to = "warehouse@fvc-sa.com";
        $orders = Order::whereIn('id', $order_ids)->get();

        $pdf = PDF::loadView("emails.SendFile", compact("orders", "driver"));
        $filename = "pdf/assign_" . rand(1000000, 10000000) . ".pdf";

        Storage::disk('public')->put($filename, $pdf->output());

        return Mail::to($email_to)->send(new SendFile($filename));
    }

    function pdf(Order $order)
    {
        $where = [
            'id' => $order->id,
        ];

        $order = Order::where($where)->firstOrFail();
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
        $qrcode = QrCode::size(200)->style('round')->format('png')->eye('circle')->generate($url);
        $data = ['order' => $order, 'sheet_h' => $sheet_h, 'qrcode' => $qrcode];
        // return view("front.orders.pdf",$data);
        $pdf = PDF::loadView("front.orders.pdf", $data);
        return $pdf->stream("Order_" . $order->id . ".pdf");
        // return view("front.orders.pdf", compact("order"));
    }

    function images(Order $order)
    {
        $where = [
            'id' => $order->id,
        ];
        $order = Order::where($where)->firstOrFail();

        return view("admin.orders.images", compact("order"));
    }

    function export(Request $request)
    {
        $where = [
            ['order_status_id', '!=', '201']
        ];
        $query = Order::select("*");
        // $value = $request->session()->get('order_id');
        if ($request->session()->get('order_id')) {
            $where['id'] = $request->session()->get('order_id'); //$request->order_id;
            $query->where('id', $request->session()->get('order_id'));
        }
        if ($request->session()->get('total')) {
            $where[] = ['total', '=', $request->session()->get('total')];
            $query->where('total', '=', $request->session()->get('order_id'));
        }
        if ($request->session()->get('from_date')) {
            $where[] = ['created_at', '>=', date("Y-m-d", strtotime($request->session()->get('from_date'))) . " 00:00:00"];
            $query->where('created_at', '>=', strtotime($request->session()->get('from_date')) . " 00:00:00");
        }
        if ($request->session()->get('to_date')) {
            $where[] = ['created_at', '<=', date("Y-m-d", strtotime($request->session()->get('to_date'))) . " 23:59:59"];
            $query->where('created_at', '<=', date("Y-m-d", strtotime($request->session()->get('to_date'))) . " 23:59:59");
        }
        if (is_array($request->session()->get('order_status_id'))) {
            // return $request->session()->get('order_status_id');
            // $orders = Order::WhereIn('order_status_id', $request->session()->get('order_status_id'))->where($where)->orderByDesc('id')->get();
            $query->WhereIn('order_status_id', $request->session()->get('order_status_id'));
            // return $orders;
        } else {
            $orders = Order::where($where)->orderByDesc('id')->get();
        }

        $row[] = [
            'رقم الطلب',
            'التاريخ',
            'اسم المسجد',
            'اسم العميل',
            'جوال العميل',
            'المبلغ',
            'طريقة الدفع',
            'الحالة',
        ];
        foreach ($orders as $order) {
            $row[] = [
                $order->id,
                date('Y-m-d h:i A', strtotime($order->created_at)),
                $order->mosque->name ?? '',
                $order->user->name ?? '',
                $order->user->mobile ?? '',
                $order->total,
                $order->payment_type->name_ar,
                $order->order_status->name
            ];
        }
        $export = new OrdersExport($row);
        return Excel::download($export, 'orders' . time() . '.xlsx');
    }

    function addImage(Request $request, Order $order)
    {
        $request->validate([
            'img' => "required|image"
        ]);
        $UploadFile = new UploadFile;
        $img = $UploadFile->store($request->file('img'));
        OrderImage::create([
            'user_id' => Auth::user()->id,
            'order_id' => $order->id,
            'img' => $img,
        ]);
        return redirect()->route("admin.order.images", $order->id);
    }

    function deleteImage(OrderImage $order_image)
    {
        $order_id = $order_image->order_id;
        if (File::exists(storage_path("app/public/" . $order_image->img))) {
            unlink(storage_path("app/public/" . $order_image->img));
        }

        $order_image->delete();
        return redirect()->route("admin.order.images", $order_id);
    }

    function reducingSize($id = null)
    {
        $id = intval($id);
        if ($id > 500) {
            echo "eee";
            exit();
        }


        try {
            $image = OrderImage::find($id);
            if ($image) {
                $fileName = $image->img;
                if (File::exists(storage_path("app/public/" . $fileName))) {
                    $img = Image::make(storage_path("app/public/" . $fileName))->orientate();
                    $img->resize(900, null, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    });
                    $img->save(storage_path("app/public/" . $fileName), 75);
                }
            }
        } //catch exception
        catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        $url = route("admin.order.reducingSize", $id + 1);
        return '<meta http-equiv="refresh" content="1; url=\'' . $url . '\'" /><h2>' . $id . '</h2>';
    }
}
