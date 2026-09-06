<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenuTypeToRol extends Migration
{
    public function up()
    {
        Schema::table('rol', function (Blueprint $table) {
            $table->string('menu_type', 60)->default('DEFAULT')->after('observation');
        });
    }

    public function down()
    {
        Schema::table('rol', function (Blueprint $table) {
            $table->dropColumn('menu_type');
        });
    }
}
