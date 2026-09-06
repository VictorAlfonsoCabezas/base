<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloseChatToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->boolean('close_chat')->default(false)->after('last_message');
        });
    }

    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('close_chat');
        });
    }
}
