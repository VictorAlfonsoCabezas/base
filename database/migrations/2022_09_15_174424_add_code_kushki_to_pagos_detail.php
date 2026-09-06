<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeKushkiToPagosDetail extends Migration
{
    public function up()
    {
        Schema::table('pagos_detail', function (Blueprint $table) {
            $table->string('code_kushki')->nullable()->after('pay_status');
        });
    }

    public function down()
    {
        Schema::table('pagos_detail', function (Blueprint $table) {
            $table->dropColumn('code_kushki');
        });
    }
}