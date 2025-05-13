<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("message_type_id")->nullable()->constrained("message_types");
            $table->foreignId("user_id")->nullable()->constrained("users");
            $table->string("mobile")->nullable();
            $table->string("name")->nullable();
            $table->string("text")->nullable();
            $table->string("status")->nullable();
            $table->string("send_times")->nullable();
            $table->string("last_error")->nullable();
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
        Schema::dropIfExists('message_histories');
    }
}
