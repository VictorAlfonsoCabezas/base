<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturaCelularToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->string('factura_celular', 20)->nullable()->after('factura_email');
        });
    }

    public function down()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->dropColumn('factura_celular');
        });
    }
}
