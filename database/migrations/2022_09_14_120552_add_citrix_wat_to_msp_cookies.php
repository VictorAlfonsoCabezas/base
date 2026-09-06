<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCitrixWatToMspCookies extends Migration
{
    public function up()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->string('citrix_wat')->nullable()->after('citrix_ns_id');
        });
    }
    
    public function down()
    {
        Schema::table('msp_cookies', function (Blueprint $table) {
            $table->dropColumn('citrix_wat');
        });
    }
}
