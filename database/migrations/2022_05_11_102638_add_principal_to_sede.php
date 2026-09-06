<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrincipalToSede extends Migration
{
    public function up()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->boolean('principal')->default(false)->after('company_id');
        });
    }

    public function down()
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropColumn('principal');
        });
    }
}
