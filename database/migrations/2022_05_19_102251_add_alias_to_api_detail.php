<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAliasToApiDetail extends Migration
{
    public function up()
    {
        Schema::table('api_detail', function (Blueprint $table) {
            $table->string('alias', 60)->nullable()->after('column_name');
        });
    }

    public function down()
    {
        Schema::table('api_detail', function (Blueprint $table) {
            $table->dropColumn('alias');
        });
    }
}
