<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBackCodigoToBotHeader extends Migration
{
    public function up()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->string('back_codigo')->nullable()->after('home_texto');
        });
    }

    public function down()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->dropColumn('back_codigo');
        });
    }
}
