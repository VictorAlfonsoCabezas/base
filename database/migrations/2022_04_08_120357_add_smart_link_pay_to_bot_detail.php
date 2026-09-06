<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSmartLinkPayToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->boolean('smart_link_pay')->default(false)->after('guardar_api');
        });
    }

    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('smart_link_pay');
        });
    }
}
