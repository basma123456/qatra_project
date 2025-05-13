<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssignToOrderDeatilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreignId("delivery_type_id")->nullable()->constrained("delivery_types")->after('order_id');

            $table->dateTime("assigned_at")->nullable();
            $table->dateTime("delivering_at")->nullable();
            $table->dateTime("delivered_at")->nullable();
            $table->foreignId("order_status_id")->nullable()->constrained("order_statuses");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_deatils', function (Blueprint $table) {
            $table->foreignId("delivery_type_id")->nullable()->constrained("delivery_types");
            $table->dateTime("assigned_at")->nullable();
            $table->dateTime("delivering_at")->nullable();
            $table->dateTime("delivered_at")->nullable();
        });
    }
}
