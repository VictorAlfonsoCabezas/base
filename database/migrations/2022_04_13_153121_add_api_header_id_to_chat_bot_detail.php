<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiHeaderIdToChatBotDetail extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->bigInteger('api_header_id')->nullable()->after('bot_detail_id');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->dropColumn('api_header_id');
        });
    }
}
