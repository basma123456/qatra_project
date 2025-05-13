<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToSomeMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('feature')->default(0)->nullable();
            $table->integer('sort')->default(0)->nullable();
            $table->boolean('no_carton')->default(0)->nullable();

            $table->string('slug')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_title')->nullable();
//            $table->string('name_en')->nullable()->change();
//            $table->text('description_en')->nullable()->change();

        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */


    public function down()
    {
        Schema::dropColumns('products' , ['feature' , 'sort' , 'slug' , 'no_carton' , 'meta_description' , 'meta_key' , 'meta_title']);
        // Schema::dropColumns('categories' , ['feature' , 'sort'  , 'slug' , 'meta_description' , 'meta_key' , 'meta_title']);

    }
}
