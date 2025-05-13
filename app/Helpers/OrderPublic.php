<?php
namespace App\Helpers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderPublic
{


    public static function getCode(Order $order)
    {
        $verify = $order->id * $order->mosque_id * $order->user_id * 314 + $order->user_id;
        $code = str_replace('=', '', base64_encode($order->id . '|' . $order->mosque_id . '|' . $order->user_id . '|' . $verify));
        return $code;
    }

    public static function getCodeDetails(OrderDetail $order)
    {
        $verify = $order->id * @$order->mosque_id * @$order->order->user_id * 314 +@ $order->order->user_id;
        $code = str_replace('=', '', base64_encode($order->id . '|' . $order->mosque_id . '|' . @$order->order->user_id . '|' . $verify));
        return $code;
    }
    

    
    public static function checkCode($code)
    {
        $code2 = base64_decode($code);
        $data = explode("|",$code2);
        $where = [
            'id'=>$data[0],
            'mosque_id'=>$data[1],
            'user_id'=>$data[2],
        ];
        $verify = $data[0] * $data[1] * $data[2] * 314 + $data[2];
        if($verify != $data[3]){
            return false;
        }
        return $data[0];
    }


    
}
