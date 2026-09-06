<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('envios_header', function (Blueprint $table) {
            $table->id(); 
            $table->boolean('envio_ahora')->default(false);
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->integer('code_intel')->nullable();
            $table->date('date_created')->nullable();
            $table->string('description', 255)->nullable();
            $table->string('tipo', 60)->nullable();
            $table->string('estado_envio', 60)->nullable();
            $table->integer('cantidad_destinos')->nullable();
            $table->string('mensaje_defecto', 1000)->nullable();
            $table->boolean('envio_inmediato')->default(false);
            $table->boolean('envio_programado')->default(false);
            $table->date('date_programado')->nullable();
            $table->time('time_programado')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('envios_header');
    }
}
