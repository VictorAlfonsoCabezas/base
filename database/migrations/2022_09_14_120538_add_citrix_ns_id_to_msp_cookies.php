<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitrixNsIdToMspCookies extends Migration
{
    public function up()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->string('citrix_ns_id')->nullable()->after('cookie');
        });
    }

    public function down()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->dropColumn('citrix_ns_id');
        });
    }
}
