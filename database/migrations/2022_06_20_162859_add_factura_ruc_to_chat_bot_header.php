<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturaRucToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->string('factura_ruc', 20)->nullable()->after('pay_status');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->dropColumn('factura_ruc');
        });
    }
}
