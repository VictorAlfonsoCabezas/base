<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePayStatusToPagosHeader extends Migration
{
    public function up()
    {
        Schema::table('pagos_header', function (Blueprint $table) {
            $table->string('pay_status')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pagos_header', function (Blueprint $table) {
            $table->integer('pay_status')->change();
        });
    }
}
