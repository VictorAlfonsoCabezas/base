<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPathFileToBotDetail extends Migration
{
    public function up()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->string('path_file', 255)->nullable()->after('order');
        });
    }

    public function down()
    {
        Schema::table('bot_detail', function (Blueprint $table) {
            $table->dropColumn('path_file');
        });
    }
}
