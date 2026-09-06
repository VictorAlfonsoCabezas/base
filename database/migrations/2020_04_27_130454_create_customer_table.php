<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{

    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('name')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('direccion')->nullable();
            $table->string('parentesco_customer')->nullable();
            $table->string('name_parentesco')->nullable();
            $table->string('numero_identificacion_parentesco')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_2')->nullable();
            $table->string('telefono_3')->nullable();
            $table->string('correo')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
