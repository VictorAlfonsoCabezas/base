<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturaEmailToChatBotHeader extends Migration
{
    public function up()
    {
        Schema::table('chat_bot_header', function (Blueprint $table) {
            $table->string('factura_email', 60)->nullable()->after('factura_nacimiento');
        });
    }

    public function down()
    {
        Schema::table('factura_nacimiento', function (Blueprint $table) {
            $table->dropColumn('factura_email');
        });
    }
}
