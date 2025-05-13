<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasjedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masjeds', function (Blueprint $table) {
            $table->id();
            $table->string("cid")->unique()->nullable();
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->string("lat")->nullable();
            $table->string("lng")->nullable();
            $table->string("map_url")->nullable();
            // $table->string("address")->nullable();
            // $table->string("main_image")->nullable();
            // $table->string("images")->nullable();
            $table->foreignId("district_id")->nullable()->constrained("districts");
            $table->text("img1")->nullable();
            $table->text("img2")->nullable();
            $table->text("img3")->nullable();
            $table->text("img4")->nullable();
            $table->text("img5")->nullable();
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
        Schema::dropIfExists('masjeds');
    }
}
