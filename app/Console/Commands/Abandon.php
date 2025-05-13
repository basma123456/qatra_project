<?php

namespace App\Console\Commands;

use App\Helpers\Sender;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\Wati;

class Abandon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abandon:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Start Abandon Command: ");
        $where = [
            'order_status_id' => 201,
            // 'user_id' => 90,
            // 'is_abandoned' => 0,
            // ['is_abandoned', "!=", 1],
            ['created_at', '<', date("Y-m-d H:i:s", time() - (3600 * 48))]
        ];
        // DB::enableQueryLog();
        // Log::info(Order::where($where)->orderby('id', 'DESC')->limit(2)->toSql());
        $orders = Order::where($where)->whereNull('is_abandoned')->whereNotNull("user_id")->orderby('id', 'DESC')->limit(3)->get();
        // dd(DB::getQueryLog());
        // Log::info("getQueryLog: ".print_r(DB::getQueryLog(),true));
        // Log::info("Abandon Count: " . $orders->count());
        foreach ($orders as $order) {
            $url = route("front.payment.abandon", $order->id);
            $message = [];
            $message['whats'] = "عزيزي العميل
اسقي ضيوف الرحمن في مساجد مكة .
بضغطة زر ، نوصل طلبك وانت مرتاح ، ونوثق لك بالصور .
ولك كرتون مجانا عند استخدام كود ( خير )  
قربنالك الخير .. في شهر الخير
" . $url . "

منصة قطرة خير";
            $message['sms'] = "عزيزي العميل
اسقي ضيوف الرحمن في مساجد مكة .
بضغطة زر ، نوصل طلبك وانت مرتاح ، ونوثق لك بالصور .
ولك كرتون مجانا عند استخدام كود ( خير )  
قربنالك الخير .. في شهر الخير
" . $url . "

منصة قطرة خير";

            $wati = new Wati();
            $wati->sendAbandon($order);
            // $sender = new Sender();
            // $sender->send($order->user->mobile, $message);
            $order->is_abandoned = 1;
            $order->save();
        }
        // Log::info("End Abandon Command: ");
        return 0;
    }
}
