<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeCodigoToBotHeader extends Migration
{
    public function up()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->string('home_codigo')->nullable()->after('start_code');
        });
    }

    public function down()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->dropColumn('home_codigo');
        });
    }
}
