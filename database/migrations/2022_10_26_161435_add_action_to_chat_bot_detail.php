<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionToChatBotDetail extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->boolean('action')->default(false)->after('viewed');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->dropColumn('action');
        });
    }
}
