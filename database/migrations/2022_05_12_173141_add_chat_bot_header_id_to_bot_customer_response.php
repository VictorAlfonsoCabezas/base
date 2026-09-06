<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChatBotHeaderIdToBotCustomerResponse extends Migration
{
    public function up()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->string('chat_bot_header_id', 2)->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->dropColumn('chat_bot_header_id');
        });
    }
}
