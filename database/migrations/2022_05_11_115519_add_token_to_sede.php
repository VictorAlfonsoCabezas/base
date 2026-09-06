<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToSede extends Migration
{
    public function up()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->string('token', 40)->nullable()->after('instancia');
        });
    }

    public function down()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
}
