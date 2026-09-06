<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserWriteIdToChatBotDetail extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->integer('user_write_id')->nullable()->after('viewed');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_detail', function (Blueprint $table) {
            $table->dropColumn('user_write_id');
        });
    }
}
