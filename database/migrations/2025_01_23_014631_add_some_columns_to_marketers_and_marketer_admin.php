<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsToMarketersAndMarketerAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketers', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('marketer_admin_id')->nullable()->constrained('marketers')->onDelete('cascade');
            $table->rememberToken();
        });

        Schema::table('marketer_admins', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketers', function (Blueprint $table) {
            //
        });
    }
}
