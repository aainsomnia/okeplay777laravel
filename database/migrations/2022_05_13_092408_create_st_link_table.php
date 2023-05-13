<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStLinkTable extends Migration
{
    public function up()
    {
        Schema::create('st_link', function (Blueprint $table) {
            $table->id();
            $table->string('link_btn_login', 100);
            $table->string('link_btn_register', 100);
            $table->datetime('link_created');
            $table->timestamp('link_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('st_link');
    }
}
