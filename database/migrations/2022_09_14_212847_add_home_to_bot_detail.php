<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->integer('home')->default(false)->after('send_inmediately');
        });
    }
    
    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('home');
        });
    }
}



