<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBnBannerTable extends Migration
{
    public function up()
    {
        Schema::create('bn_banner', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('banner_img', 100);
            $table->datetime('banner_created');
            $table->timestamp('banner_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('bn_banner');
    }
}
