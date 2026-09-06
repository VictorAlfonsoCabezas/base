<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBotConectionIdToBotHeader extends Migration
{
    public function up()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->integer('bot_conection_id')->nullable()->after('calcular_sede_proxima');
        });
    }

    public function down()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->dropColumn('bot_conection_id');
        });
    }
}