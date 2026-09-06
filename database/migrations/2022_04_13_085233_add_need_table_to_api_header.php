<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNeedTableToApiHeader extends Migration
{
    public function up()
    {
        Schema::table('api_header', function (Blueprint $table) {
            $table->boolean('need_table')->default(true)->after('api_link');
        });
    }

    public function down()
    {
        Schema::table('api_header', function (Blueprint $table) {
            $table->dropColumn('need_table');
        });
    }
}
