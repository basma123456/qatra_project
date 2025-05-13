<?php

namespace App\Helpers;

use App\Models\MessageTemplate;
use App\Models\Order;
use App\Models\OrderImage;
use App\Models\User;
use App\Models\WhatsMessage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Helpers\Wati;
use App\Models\Driver;
use App\Models\OrderDetail;

class Sender
{
    public $wati;

    function __construct()
    {
        $this->wati = new Wati();
    }

    function send($mobile, $message, $file = null)
    {

        // $what = new Whats();
        $flag = false;
        if (App::environment('production')) {
            if (!is_null($file)) {
                    $sms = new Taqnyat();
                    $sms->SendSMS($mobile, $message['sms']);
                    $flag = true;
            } else {
                    $sms = new Taqnyat();
                    $sms->SendSMS($mobile, $message['sms']);
                    $flag = true;
            }
        } else {
            $flag = true;
        }

        return $flag;
    }

    function process($order_id, $message_template_id)
    {
        $order = Order::find($order_id);
        $MessageTemplate = MessageTemplate::where('message_type_id', $message_template_id)->first();
        $CUST_NAME = $order->user->name;
        $MOSQ_NAME = $order->mosque->name_ar;
        $ORDER_ID = $order->id;
        $ORDER_AMOUNT = $order->total;
        switch ($message_template_id) {
            case 201:
                $this->wati->sendOrderFinish($order);
                break;
            case 301:
                $this->wati->sendOrderDelivery($order);
                break;
            case 401:
                $this->wati->sendOrderComplate($order);
                break;
        }
    }

    function processDetails($order_id, $message_template_id)
    {
        $orderDeatils = OrderDetail::find($order_id);
        $MessageTemplate = MessageTemplate::where('message_type_id', $message_template_id)->first();
        $CUST_NAME = $orderDeatils->order?->user->name;
        $MOSQ_NAME = $orderDeatils->mosque->name_ar;
        $ORDER_ID = $orderDeatils->id;
        $ORDER_AMOUNT = $orderDeatils->price * $orderDeatils->quantity;
        switch ($message_template_id) {
            case 201:
                $this->wati->sendOrderDetailsFinish($orderDeatils);
                break;
            case 301:
                $this->wati->sendOrderDetailsDelivery($orderDeatils);
                break;
            case 401:
                $this->wati->sendOrderDetailsComplate($orderDeatils);
                break;
        }
    }

    function sendPhoto($order_id)
    {
        $order = Order::find($order_id);
        $imgs = OrderImage::where('order_id', $order_id)->whereNotNull("approved_at")->get();
        $i = 0;
        foreach ($imgs as $item) {
            $i++;
            $text['whats'] = "صورة " . $i;
            $text['sms'] = "صورة " . $i;
            $title = "صورة " . $i;
            $file = url("storage/" . $item->img);
            // Log::info($file);
            // $this->send($order->user->mobile, $text, $file);
            $this->wati->sendOrderImage($order, $file ,$title);
        }
    }

    function sendInvoice($order_id)
    {
        $order = Order::find($order_id);
        $code = OrderPublic::getCode($order);
        $file = route("front.orders.public.pdf", $code);
        $message = [];
        $message['whats'] = 'الفاتورة';
        $message['sms'] = 'الفاتورة';
        $this->wati->sendOrderInvoice($order, $file);
    }

    function sendOTP($mobile, $otp)
    {

        if (strlen($mobile) == 12 && substr($mobile, 0, 3) == "966") {
            $sms = new Taqnyat();
            $sms->SendOTP($mobile, $otp);
        } else {
            $this->wati->sendotp($mobile, $otp);
            // $message = "رمز التحقق : " . $otp . "\n منصة قطرة\n https://qatra.sa/";
            // $what = new Whats();
            // $what->sendMessage($mobile, $message);
            // WhatsMessage::create([
            //     'mobile' => $mobile,
            //     'message' => $message,
            // ]);
        }
        // } else {
        //     $message .= "\n منصة قطرة\n https://qatra.sa/";
        //     $what = new Whats();
        //     $what->sendMessage($mobile, $message);
        // WhatsMessage::create([
        //     'mobile' => $mobile,
        //     'message' => $message,
        // ]);
        // }
    }

    function snedAssign($driver_id, $total)
    {
        $driver = Driver::find($driver_id);
        $mobile = $driver->mobile;
        $message = $driver->name . "\n";
        $message .= "تم إسناد طلبات توصيل لديك بإجمالي : " . "\n";
        $message .= $total . " كرتون " . "\n";
        $message .= "-------------------------" . "\n";
        $message .= "https://qatra.sa" . "\n";

        $this->wati->sendDriverAssign($driver, $total);
        // $what = new Whats();
        // $what->sendMessage($mobile, $message);
        // WhatsMessage::create([
        //     'mobile' => $mobile,
        //     'message' => $message,
        // ]);
    }

    function sendDetailsPhoto($order_id)
    {
        $order = OrderDetail::find($order_id);
        $imgs = OrderImage::where('order_details_id', $order_id)->whereNotNull("approved_at")->get();
        $i = 0;
        foreach ($imgs as $item) {
            $i++;
            $text['whats'] = "صورة " . $i;
            $text['sms'] = "صورة " . $i;
            $title = "صورة " . $i;
            $file = url("storage/" . $item->img);
            // Log::info($file);
            // $this->send($order->user->mobile, $text, $file);
            $this->wati->sendOrderDetailsImage($order, $file ,$title);
        }
    }

    function sendDetailsInvoice($order_id)
    {
        $order = OrderDetail::find($order_id);
        $code = OrderPublic::getCodeDetails($order);
        $file = route("orders.public.pdf", $code);
        $message = [];
        $message['whats'] = 'الفاتورة';
        $message['sms'] = 'الفاتورة';
        $this->wati->sendOrderDetailsInvoice($order, $file);
    }
}
