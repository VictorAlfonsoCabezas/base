<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKushkiIdToPagosDetail extends Migration
{
    public function up()
    {
        Schema::table('pagos_detail', function (Blueprint $table) {
            $table->string('kushki_id')->nullable()->after('code_kushki');
        });
    }

    public function down()
    {
        Schema::table('pagos_detail', function (Blueprint $table) {
            $table->dropColumn('kushki_id');
        });
    }
}

       
