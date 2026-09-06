<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexResponseToBotCustomerResponse extends Migration
{
    public function up()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->string('index_response', 120)->nullable()->after('json_response');
        });
    }

    public function down()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->dropColumn('index_response');
        });
    }
}
