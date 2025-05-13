<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomecolumnsToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->tinyInteger('feature')->default(0)->nullable();
            $table->integer('sort')->default(0)->nullable();
            $table->string('slug')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_title')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('categories', ['feature', 'sort', 'slug', 'meta_description', 'meta_key', 'meta_title']);
    }
}
