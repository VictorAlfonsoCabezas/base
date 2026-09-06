<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosDetailTable extends Migration
{
    public function up()
    {
        Schema::create('envios_detail', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->bigInteger('envios_header_id')->nullable()->unsigned();
            $table->foreign('envios_header_id')->references('id')->on('envios_header');
            $table->string('phone', 20)->nullable();
            $table->string('mensaje', 1000)->nullable();
            $table->string('estado_envio', 60)->nullable();
            $table->date('date_enviado')->nullable();
            $table->time('time_enviado')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('envios_detail');
    }
}
