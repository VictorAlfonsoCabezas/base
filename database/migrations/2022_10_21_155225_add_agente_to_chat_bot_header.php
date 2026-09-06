<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgenteToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->boolean('agente')->default(false)->after('factura_direccion');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->dropColumn('agente');
        });
    }
}
