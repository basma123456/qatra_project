<?php

namespace App\Helpers;

use App\Models\WhatsMessage;
use Illuminate\Support\Facades\Log;

class Msegat
{

    function SendSMS($mobiles, $msg)
    {
        WhatsMessage::create([
            'mobile'=>$mobiles,
            'message'=>"SMS: ".$msg,
        ]);
        $curl = curl_init();
        $userName = config("msegat.username");
        $apiKey = config("msegat.apiKey");
        $userSender = config("msegat.userSender");
        $mobiles = $this->checkMobile($mobiles);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.msegat.com/gw/sendsms.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "userName":"' . $userName . '",
                "apiKey":"' . $apiKey . '",
                "numbers":"' . $mobiles . '",
                "userSender":"' . $userSender . '",
                "msg":"' . $msg . '",
                "msgEncoding":"UTF8"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = "";
        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response);
        // Log::info($mobiles);
        Log::info(print_r($data,true));
        if (isset($data->code) && $data->code == 1) {
            return true;
        }
        // Log::error(print_r($data,true));
        return false;
    }

    function SendOTP($mobile, $otp)
    {
        $message = "رمز التحقق: " . $otp;
        return $this->SendSMS($mobile, $message);
    }

    function utf2no($string)
    {
        $string = str_replace(" ", "", $string);
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = [9, 8, 7, 6, 5, 4, 3, 2, 1, 0];
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    function checkMobile($mobile)
    {
        $mobile = $this->utf2no($mobile);
        if (strlen($mobile) == 10) {
            $mobile = "966" . substr($mobile, 1);
        }
        return $mobile;
    }
}
