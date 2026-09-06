<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBotConectionIdToBotHistorial extends Migration
{
    public function up()
    {
        Schema::table('bot_historial', function (Blueprint $table) {
            $table->string('bot_conection_id')->nullable()->after('main_answer_id');
        });
    }

    public function down()
    {
        Schema::table('bot_historial', function (Blueprint $table) {
            $table->dropColumn('bot_conection_id');
        });
    }
}