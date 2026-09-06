<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMspCookiesTable extends Migration
{
    public function up()
    {
        Schema::create('msp_cookies', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->string('sesion', 500)->nullable();
            $table->string('cookie', 500)->nullable();
            $table->dateTime('date_expired')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('msp_cookies');
    }
}
