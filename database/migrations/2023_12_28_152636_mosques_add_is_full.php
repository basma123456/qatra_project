<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MosquesAddIsFull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mosques', function (Blueprint $table) {
            $table->boolean("is_full")->after("confirmed_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mosques', function (Blueprint $table) {
            $table->dropColumn("is_full");
        });
    }
}
