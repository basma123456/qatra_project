<?php

namespace App\Helpers;

use App\Models\Card;
use App\Models\Order;
use Intervention\Image\Facades\Image;
use ArPHP\I18N\Arabic;
use Illuminate\Support\Facades\Log;

class GiftCard
{
    // RECIPIENT
    // SENDER

    public static function send(Order $order)
    {

        if ($order->is_gift_card == 1) {
            $where = [
                'is_gift' => 1,
                'status' => 1,
            ];
            $card = Card::where($where)->first();
            /* if ($order->order_status_id == 301) {*/
            $img = Image::make(public_path("default_card.jpg"));

            foreach ($card->details as $item) {
                $arabic = new Arabic();
                $text = str_replace("RECIPIENT", $order->gift_recipient_name, $item->text);
                $text = str_replace("SENDER", $order->gift_sender, $text);
                $text = $arabic->utf8Glyphs(trim($text));
                $size = $item->size;
                $color = $item->color;
                $img->text($text, $item->x, $item->y, function ($font) use ($size, $color) {
                    $font->file(public_path('fonts/Bahij_TheSansArabic-Bold.ttf'));
                    $font->size($size);
                    $font->color($color);
                    $font->align('center');
                });
            }
            $file = "card_order_" . $order->id . '.jpg';

            $img->save(public_path('cards/' . $file));

            $img_url = url('cards/' . $file);

            /*$pos = strpos(url(''), "public");
            if ($pos !== false) {
                $img_url = url('cards/' . $file);
            } else {
                $img_url = url('public/cards/' . $file);
            }*/


            //$sender = new Sender();
            //$mobile = $order->user->mobile;
            $mobile = $order->gift_recipient_mobile;
            $mobile = str_replace("+", "", $mobile);
            // $mobile = '966501201906';
            //$message = "مرحباً " . $order->gift_recipient_name . "\n";
            //$message .= "وصلتك بطاقة إهداء من : " . $order->gift_sender . "\n";
            // $message .= "\n منصة قطرة\n https://qatra.sa/";
            $wati = new Wati();
            return $wati->sendGiftCard($order, $mobile, $img_url);

            /*  $message = [
                  'whats' => $message,
                  'sms' => 'وصلتك بطاقة إهداء عبر \n' . "\n منصة قطرة\n https://qatra.sa/\n" . $img_url
              ];*/
            // $f = $sender->send($mobile, $message, $img_url);
            // if ($f) {
            //     $order->gift_sent_at = date("Y-m-d H:i:s");
            //     $order->save();
            // }
            /*}*/
        }
    }
}
