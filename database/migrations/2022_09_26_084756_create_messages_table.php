<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("mobile")->nullable();
            $table->string("email")->nullable();
            $table->string("subject")->nullable();
            $table->string("text")->nullable();
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
        Schema::dropIfExists('messages');
    }
}
