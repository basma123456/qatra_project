<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPaymentMethodIdToBanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id')->nullable(); // Foreign key referencing payment_methods table
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->nullOnDelete()->cascadeOnUpdate();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banks', function (Blueprint $table) {
            $table->dropForeign('payment_method_id' );
        });
    }
}
