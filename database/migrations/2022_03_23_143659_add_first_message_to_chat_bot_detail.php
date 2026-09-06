<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFirstMessageToChatBotDetail extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->boolean('first_message')->default(false)->after('bot_detail_id');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->dropColumn('first_message');
        });
    }
}
