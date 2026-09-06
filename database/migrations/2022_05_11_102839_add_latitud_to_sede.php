<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLatitudToSede extends Migration
{
    public function up()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->string('latitud', 20)->nullable()->after('code_intel');
        });
    }

    public function down()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropColumn('latitud');
        });
    }
}
