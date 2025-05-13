<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GiftCard;
use App\Helpers\Sender;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{


    function index(Request $request)
    {
        return view("admin.transfers.index");


        $where = [
            // ['order_status_id', '!=', '201']
            // 'status' => 0
        ];
        $transfers = Transfer::where($where)->orderByDesc("id")->get();
        $statistics['all'] = Transfer::count();
        $statistics['waiting'] = Transfer::where(['status' => 0])->count();
        $statistics['finished'] = Transfer::where(['status' => 1])->count();
        return view("admin.transfers.index", compact("transfers", "statistics"));
    }

    function item(Transfer $transfer)
    {
        // return $transfer;
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime =  $finfo->file("storage/" . $transfer->transfer_img);
        $is_file_pdf = ($mime == "application/pdf") ? true : false;
        return view("admin.orders.item", compact("transfer", "is_file_pdf"));
    }
    function get_file(Transfer $transfer)
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime =  $finfo->file("storage/" . $transfer->transfer_img);
        $is_file_pdf = ($mime == "application/pdf") ? true : false;
        if ($is_file_pdf) {
            $html = '<iframe src="' . url("storage/" . $transfer->transfer_img) . '" class="w-100" style="min-height: 500px;"></iframe>';
        } else {
            $html = '<img src="' . url("storage/" . $transfer->transfer_img) . '" class="w-100 border p-1 rounded" />';
        }
        return $html;
    }

    function confirm(Transfer $transfer)
    {
        $transfer->status = 1;
        $transfer->save();
        $order = Order::find($transfer->order_id);
        $order->order_status_id = 301;
        $order->save();
        $sender = new Sender();
        $sender->process($order->id, 101);
        GiftCard::send($order);
        return "تم تأكيد الدفع";
    }
}
