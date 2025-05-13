<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar");
            $table->string("name_en");
            $table->string("img")->nullable();
            $table->float("price")->nullable();
            $table->string("description_ar")->nullable();
            $table->string("description_en")->nullable();
            $table->foreignId("category_id")->constrained("categories");
            $table->boolean("status")->default(0);
            $table->boolean("deliverable")->default(0);
            $table->boolean("taxable")->default(0);
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
        Schema::dropIfExists('products');
    }
}
