<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwilioCredencialesTable extends Migration
{
    public function up()
    {
        Schema::create('twilio_credenciales', function (Blueprint $table) {
            $table->id();
            $table->boolean('principal')->default(true);
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->integer('sede_id')->nullable();
            $table->date('date_created')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('sid', 150)->nullable();
            $table->string('token', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('twilio_credenciales');
    }
}
