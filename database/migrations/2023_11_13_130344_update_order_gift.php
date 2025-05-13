<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderGift extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean("is_gift_card")->default(0)->after('marketer_id');
            $table->string("gift_sender")->nullable()->after('is_gift_card');
            $table->string("gift_recipient_name")->nullable()->after('gift_sender');
            $table->string("gift_recipient_mobile")->nullable()->after('gift_recipient_name');
            $table->timestamp("gift_sent_at")->nullable()->after('gift_recipient_mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn("is_gift_card");
            $table->dropColumn("gift_sender");
            $table->dropColumn("gift_recipient");
            $table->dropColumn("gift_sent_at");
        });
    }
}
