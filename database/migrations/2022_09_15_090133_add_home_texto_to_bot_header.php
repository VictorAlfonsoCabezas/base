<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomeTextoToBotHeader extends Migration
{
    public function up()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->string('home_texto')->nullable()->after('home_codigo');
        });
    }

    public function down()
    {
        Schema::table('bot_header', function (Blueprint $table) {
            $table->dropColumn('home_texto');
        });
    }
}
