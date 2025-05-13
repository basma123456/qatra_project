<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('amount')->default(0)->after('delivered_at');
            $table->string('note')->nullable()->after('tax');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->bigInteger('city_id')->nullable()->after('order_id');
            $table->bigInteger('district_id')->nullable()->after('order_id');
            $table->bigInteger('mosque_id')->nullable()->after('order_id');
            $table->tinyInteger('coupon')->default(0)->after('order_id');

            $table->boolean("is_gift_card")->default(0)->after('order_id');
            $table->string("gift_sender")->nullable()->after('order_id');
            $table->string("gift_recipient_name")->nullable()->after('order_id');
            $table->string("gift_recipient_mobile")->nullable()->after('order_id');
            $table->timestamp("gift_sent_at")->nullable()->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            //
        });
    }
}
