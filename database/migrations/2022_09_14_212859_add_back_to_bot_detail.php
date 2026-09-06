<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBackToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->integer('back')->nullable()->default(false)->after('home');
        });
    }
    
    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('back');
        });
    }
}
