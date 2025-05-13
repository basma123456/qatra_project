<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasjed2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masjedtemp', function (Blueprint $table) {
            $table->id();
            $table->string("cid")->unique()->nullable();
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->string("lat")->nullable();
            $table->string("lng")->nullable();
            $table->string("address")->nullable();
            $table->text("map_url")->nullable();
            $table->foreignId("district_id")->nullable()->constrained("districts");
            $table->text("img1")->nullable();
            $table->text("img2")->nullable();
            $table->text("img3")->nullable();
            $table->text("img4")->nullable();
            $table->text("img5")->nullable();
            $table->timestamp("copy_at")->nullable();
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
        Schema::dropIfExists('masjedtemp');
    }
}
