<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsUsersTable extends Migration
{
    public function up()
    {
        Schema::create('us_users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_fname', 80);
            $table->string('user_email', 35)->unique();
            $table->string('user_password', 100);
            $table->datetime('user_created');
            $table->timestamp('user_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('us_users');
    }
}
