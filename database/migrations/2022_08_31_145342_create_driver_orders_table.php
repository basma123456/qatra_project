<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained("orders");
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("assign_by")->constrained("users");
            $table->foreignId("driver_status_id")->constrained("driver_statuses");
            $table->float("distance")->nullable();
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
        Schema::dropIfExists('driver_orders');
    }
}
