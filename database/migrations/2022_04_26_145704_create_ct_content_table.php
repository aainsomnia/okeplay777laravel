<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtContentTable extends Migration
{
    public function up()
    {
        Schema::create('ct_content', function (Blueprint $table) {
            $table->id('content_id');
            $table->unsignedBigInteger("category_id");
            $table->bigInteger('content_index')->default(0);
            $table->string('content_name', 100);
            $table->string('content_img', 100);
            $table->integer('content_persen');
            $table->datetime('content_created');
            $table->timestamp('content_updated')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('category_id');
            $table->foreign('category_id')->references('category_id')->on('ct_category')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ct_content');
    }
}
