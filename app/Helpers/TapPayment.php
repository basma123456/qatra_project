<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class TapPayment
{
    protected $secret_Key;
    protected $public_key = '';
    public $last_error = "";
    public $data_return;


    public function __construct()
    {
        $this->secret_Key = config("tap.secret_Key");
        $this->public_key = config("tap.public_key");
    }

    function charge($token_id, $amount, $description, $customer, $redirect_url)
    {
        $currency = "SAR";
        $data_fields = [
            'amount' => $amount,
            'currency' => $currency,
            'threeDSecure' => true,
            'save_card' => false,
            'description' => $description,
            'receipt' => [
                "email" => false,
                "sms" => false,
            ],
            'customer' => $customer,
            'source' => [
                'id' => $token_id
            ],
            'post' => [
                'url' => $redirect_url
            ],
            'redirect' => [
                'url' => $redirect_url
            ]
        ];
        $url = "https://api.tap.company/v2/charges";
        if ($this->SendData($url, data: $data_fields)) {
            return $this->data_return;
        } else {
            return false;
        }
    }

    function applepay($amount, $description, $customer, $redirect_url)
    {

        $currency = "SAR";
        $data_fields = [
            'amount' => $amount,
            'currency' => $currency,
            'threeDSecure' => true,
            'save_card' => false,
            'description' => $description,
            'receipt' => [
                "email" => false,
                "sms" => false,
            ],
            'customer' => $customer,
            'source' => [
                'id' => "src_apple_pay"
            ],
            'redirect' => [
                'url' => $redirect_url
            ]
        ];
        $url = "https://api.tap.company/v2/charges";
        if ($this->SendData($url, $data_fields)) {
            return $this->data_return;
        } else {
            return false;
        }
    }

    function check($charge_id)
    {
        $url = "https://api.tap.company/v2/charges/" . $charge_id;
        if ($this->SendData($url, [], "GET")) {
            return $this->data_return;
        } else {
            return false;
        }
    }

    function SendData($url, $data, $method = "POST")
    {
        //dd($url, $data,$this->secret_Key);
        // print_r($data);exit();
        // Log::info("data");
        // Log::info(print_r($data));
        $curl = curl_init();
        $headers = [
            "authorization: Bearer " . $this->secret_Key,
            "content-type: application/json"
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers,
        ));
        $response = curl_exec($curl);
        // Log::info("response");
        Log::info("response:" . print_r($response, true));
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $this->last_error = $err;
            return false;
        } else {
            $this->data_return = json_decode($response);
            return true;
        }
    }
}



// Mastercard
// 5123450000000008 (3D:Yes)
// 5111111111111118 (3D:No)

// Visa
// 4508750015741019 (3D:Yes)
// 4012000033330026 (3D:No)

// Amex
// 345678901234564  (3D:Yes)
// 371449635398431  (3D:No)

// Mada
// 5588480000000003 (3D:Yes)
// 4464040000000007 (3D:No)
