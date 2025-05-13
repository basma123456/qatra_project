<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMosquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mosques', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar");
            $table->string("name_en")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("capacity");
            $table->unsignedInteger("rows");
            $table->float("row_length");
            $table->boolean("status")->default(0);
            $table->foreignId("city_id")->constrained("cities");
            $table->foreignId("district_id")->constrained("districts");
            $table->string("overseer_name")->nullable();
            $table->string("overseer_mobile")->nullable();
            $table->foreignId("overseer_job_id")->nullable()->constrained("overseer_jobs");
            $table->foreignId("mosque_type_id")->nullable()->constrained("mosque_types");
            $table->foreignId("place_type_id")->nullable()->constrained("place_types");
            $table->boolean("need_water")->default(0);
            $table->boolean("has_fridge")->default(0);
            $table->foreignId("fridge_id")->nullable()->constrained("fridges");

            $table->boolean("inside_boundaries")->default(0);
            $table->boolean("place_umrah")->default(0);
            $table->boolean("woman_place")->default(0);

            $table->foreignId("confirmed_by")->nullable()->constrained("users");
            $table->dateTime("confirmed_at")->nullable();
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
        Schema::dropIfExists('mosques');
    }
}
