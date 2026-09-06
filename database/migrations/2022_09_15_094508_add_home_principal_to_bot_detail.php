<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomePrincipalToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->integer('home_principal')->nullable()->default(false)->after('back');
        });
    }

    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('home_principal');
        });
    }
}

            
           

