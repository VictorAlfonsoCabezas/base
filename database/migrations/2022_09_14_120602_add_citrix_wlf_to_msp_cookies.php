<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitrixWlfToMspCookies extends Migration
{
    public function up()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->string('citrix_wlf')->nullable()->after('citrix_wat');
        });
    }
    
    public function down()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->dropColumn('citrix_wlf');
        });
    }
}
