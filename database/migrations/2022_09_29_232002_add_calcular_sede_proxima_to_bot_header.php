<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCalcularSedeProximaToBotHeader extends Migration
{
    public function up()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->boolean('calcular_sede_proxima')->default(false)->after('back_texto');
        });
    }

    public function down()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->dropColumn('calcular_sede_proxima');
        });
    }
}

