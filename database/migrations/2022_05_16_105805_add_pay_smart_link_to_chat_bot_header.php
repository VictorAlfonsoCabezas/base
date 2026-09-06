<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaySmartLinkToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->string('pay_smart_link', 20)->nullable()->after('pay_smart_link_url');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->dropColumn('pay_smart_link');
        });
    }
}
