<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturaNacimientoToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->date('factura_nacimiento')->nullable()->after('factura_apellidos');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->dropColumn('factura_nacimiento');
        });
    }
}
