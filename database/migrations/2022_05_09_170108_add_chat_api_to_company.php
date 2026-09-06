<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChatApiToCompany extends Migration
{
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->boolean('chat_api')->default(false)->after('token_interno');
        });
    }

    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('chat_api');
        });
    }
}
