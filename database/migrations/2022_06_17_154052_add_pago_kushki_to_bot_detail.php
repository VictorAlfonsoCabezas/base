<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPagoKushkiToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->boolean('pago_kushki')->default(false)->after('fecha_agenda');
        });
    }

    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('pago_kushki');
        });
    }
}
