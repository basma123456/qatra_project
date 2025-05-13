<?php

namespace App\Console\Commands;

use App\Helpers\GiftCard;
use App\Helpers\Wati;
use App\Models\Order;
use Illuminate\Console\Command;

class SendWati extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wati:send';

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

        $order = Order::find(278);
        return GiftCard::send($order);
        //return  $wati->sendGiftCard($order,962776501263,'https://qatra.sa/public/cards/card_order_278_.jpg');

        $wati = new Wati();
        $wati->sendOrderFinish($order);
        $otp = rand(1000,9999);
        $wati->sendotp("966545191349",$otp);
        return 0;
    }
}
