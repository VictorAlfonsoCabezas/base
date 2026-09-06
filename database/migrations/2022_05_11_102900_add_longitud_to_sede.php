<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLongitudToSede extends Migration
{
    public function up()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->string('longitud', 20)->nullable()->after('latitud');
        });
    }

    public function down()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropColumn('longitud');
        });
    }
}
