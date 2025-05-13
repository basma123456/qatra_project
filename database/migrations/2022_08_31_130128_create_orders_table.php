<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("mosque_id")->nullable()->constrained("mosques");
            $table->foreignId("user_id")->nullable()->constrained("users");
            $table->foreignId("delivery_type_id")->nullable()->constrained("delivery_types");
            $table->string("delivery_name")->nullable();
            $table->string("delivery_mobile")->nullable();
            $table->unsignedBigInteger("payment_id")->nullable();
            $table->foreignId("payment_type_id")->nullable()->constrained("payment_types");
            $table->foreignId("order_status_id")->nullable()->constrained("order_statuses");
            $table->dateTime("assigned_at")->nullable();
            $table->dateTime("delivering_at")->nullable();
            $table->dateTime("delivered_at")->nullable();
            $table->float("total")->default(0);
            $table->float("tax")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
