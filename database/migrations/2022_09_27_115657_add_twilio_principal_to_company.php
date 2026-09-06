<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwilioPrincipalToCompany extends Migration
{
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->boolean('twilio_principal')->default(true)->after('hora_fin');
        });
    }
    
    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('twilio_principal');
        });
    }
}
