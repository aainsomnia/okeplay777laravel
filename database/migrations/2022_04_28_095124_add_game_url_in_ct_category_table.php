<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGameUrlInCtCategoryTable extends Migration
{
    public function up()
    {
        Schema::table('ct_category', function (Blueprint $table) {
            $table->string('game_url', 100)->after('category_img');
        });
    }

    public function down()
    {
        Schema::table('ct_category', function (Blueprint $table) {
            $table->dropColumn('game_url');
        });
    }
}
