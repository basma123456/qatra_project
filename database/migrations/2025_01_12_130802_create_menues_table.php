<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menues', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('position', ['main', 'footer', 'side'])->default('main')->comment("main, footer,side");
            $table->integer('sort')->nullable()->default(0);
            $table->string('url')->nullable();
            $table->string('type')->default('static')->nullable();
            $table->string('dynamic_table')->nullable();
            $table->string('dynamic_url')->nullable();
            $table->integer('level')->nullable();
            $table->tinyinteger('status')->default('1')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menues', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('menues')->nullable()->onDelete('cascade');
        });
        Schema::dropIfExists('menues');
    }
}
