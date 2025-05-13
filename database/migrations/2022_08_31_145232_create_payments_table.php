<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained("users");
            $table->string("transaction_id")->nullable();
            $table->string("brand")->nullable();
            $table->float("amount")->nullable();
            $table->string("last4")->nullable();
            $table->string("status")->nullable();
            $table->string("description")->nullable();
            $table->foreignId("order_id")->nullable()->constrained("orders");
            $table->string("ip")->nullable();
            $table->string("device_family")->nullable();
            $table->string("device_model")->nullable();
            $table->string("browser_family")->nullable();
            $table->string("browser_version")->nullable();
            $table->string("platform_family")->nullable();
            $table->string("platform_version")->nullable();
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
        Schema::dropIfExists('payments');
    }
}
