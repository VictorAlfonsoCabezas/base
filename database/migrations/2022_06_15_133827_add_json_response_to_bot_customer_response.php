<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJsonResponseToBotCustomerResponse extends Migration
{
    public function up()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->string('json_response', 5000)->nullable()->after('campo_name');
        });
    }

    public function down()
    {
        Schema::table('bot_customer_response', function (Blueprint $table) {
            $table->dropColumn('json_response');
        });
    }
}
