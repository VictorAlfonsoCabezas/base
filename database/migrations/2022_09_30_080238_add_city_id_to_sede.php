<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToSede extends Migration
{
    public function up()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->integer('city_id')->nullable()->after('code_intel');
        });
    }

    public function down()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
}