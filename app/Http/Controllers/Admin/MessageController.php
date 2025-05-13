<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Sender;
use App\Http\Controllers\Controller;
use App\Models\OrderImage;
use App\Models\OrderMessage;
use App\Models\WhatsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [
            ['approved_at',null]
        ];
        $images = [];
        $messages = OrderMessage::where($where)->get();
        return view("admin.messages.index",compact("messages","images"));
    }
    public function sent(Request $request)
    {
        
        $images = [];
        $where = [];
        if($request->mobile){
            $where['mobile']=$request->mobile;
        }
        $messages = WhatsMessage::where($where)->orderby('id','DESC')->paginate(30);
        return view("admin.messages.sent",compact("messages"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item(OrderMessage $message)
    {
        $where = [
            'order_details_id'=>$message->order_details_id,
            ['approved_at',null],
        ];
        $imgs = OrderImage::where($where)->get();
        return view("admin.messages.carousel",compact("imgs","message"));
    }


    public function confirm(OrderMessage $message){
        $message->approved_at = now();
        $message->approved_by = Auth::guard("admin")->user()->id;
        $message->save();
        $rows = OrderImage::where(['order_details_id'=>$message->order_details_id])->get();
        foreach($rows as $row){
            $row->approved_at = now();
            $row->approved_by = Auth::guard("admin")->user()->id;
            $row->save();
        }
        $sender = new Sender();
        $sender->processDetails($message->order_details_id, 401);
        $sender->sendDetailsPhoto($message->order_details_id);
        $sender->sendDetailsInvoice($message->order_details_id);
        return "تم تفعيل الرسالة";
    }

}
