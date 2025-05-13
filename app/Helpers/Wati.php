<?php

namespace App\Helpers;

use App\Models\Driver;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use stdClass;

class Wati
{
    public $access_token;
    protected $url;
    protected $error = null;

    public function __construct()
    {
        $this->access_token = config("wati.access_token");
        $this->url = config("wati.url");
    }

    function sendotp($mobile, $otp)
    {
        $template = "otp";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "1";
        $parameter->value = $otp; // rand(1000,9999);
        $parameters[] = $parameter;
        $this->SendMessage($mobile, $template, $parameters);
    }
    function sendOrderFinish(Order $order)
    {
        $template = "order_finish";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "shop_name";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "total_price";
        $parameter->value = "$order->total";
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderComplate(Order $order)
    {
        $template = "order_complate";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "product_details";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderInvoice(Order $order, $pdf_file)
    {
        $template = "order_invoice2";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "pdf_file";
        $parameter->value = $pdf_file;
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendGiftCard(Order $order,$mobile, $img_url)
    {
        $template = "giftcard";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "img_url";
        $parameter->value = $img_url;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "gift_recipient_name";
        $parameter->value = $order->gift_recipient_name;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "gift_sender";
        $parameter->value = $order->gift_sender;
        $parameters[] = $parameter;
        // $mobile = $order->user->mobile;
       return $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderImage(Order $order, $img_link, $title)
    {
        $template = "order_image";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "img_title";
        $parameter->value = $title;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "img_link";
        $parameter->value = $img_link;
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderDelivery(Order $order)
    {
        $template = "order_delivery";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "product_details";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendAbandon(Order $order)
    {
        $template = "abandon2";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "abandon_id";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $mobile = $order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendDriverAssign(Driver $user, $total)
    {
        $template = "driver_assigned";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "name";
        $parameter->value = $user->name;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $total;
        $parameters[] = $parameter;
        $mobile = $user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function SendMessage($mobile, $template, $parameters)
    {

        $curl = curl_init();
        $body = new stdClass();
        $body->template_name = $template;
        $body->broadcast_name = $template;
        $body->parameters = $parameters;
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $this->url . '/api/v1/sendTemplateMessage?whatsappNumber=' . $mobile,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->access_token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        return $response;

        curl_close($curl);
        // echo "result:";
        // echo $response;
    }


    function sendOrderDetailsFinish(OrderDetail $order)
    {
        $template = "order_finish";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "shop_name";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "total_price";
        if(!$order->product->taxable== 1){
            $parameter->value = ($order->price * $order->quantity) +  (($order->price * $order->quantity) * 0.15);
        }else{
            $parameter->value = $order->price * $order->quantity;
        }
        $parameters[] = $parameter;
        $mobile = $order->order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderDetailsDelivery(OrderDetail $order)
    {
        $template = "order_delivery";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "product_details";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $mobile = $order->order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }
    function sendOrderDetailsComplate(OrderDetail $order)
    {
        $template = "order_complate";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "product_details";
        $parameter->value = $order->mosque->name;
        $parameters[] = $parameter;
        $mobile = $order->order->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

    function sendOrderDetailsImage(OrderDetail $order, $img_link, $title)
    {
        $template = "order_image";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "img_title";
        $parameter->value = $title;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "img_link";
        $parameter->value = $img_link;
        $parameters[] = $parameter;
        $mobile = @$order->order?->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }
    
    function sendOrderDetailsInvoice(OrderDetail $order, $pdf_file)
    {
        $template = "order_invoice2";
        $parameters = [];
        $parameter = new stdClass();
        $parameter->name = "order_number";
        $parameter->value = $order->id;
        $parameters[] = $parameter;
        $parameter = new stdClass();
        $parameter->name = "pdf_file";
        $parameter->value = $pdf_file;
        $parameters[] = $parameter;
        $mobile = @$order->order?->user->mobile;
        $this->SendMessage($mobile, $template, $parameters);
    }

}
