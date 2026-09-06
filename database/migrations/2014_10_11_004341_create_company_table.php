<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 13)->unique();
            $table->string('company_name')->nullable();
            $table->string('company_color', 60)->default('#3274b1');
            $table->string('comercial_name')->nullable();
            $table->string('company_description', 255)->nullable();
            $table->string('legal_representative')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('conexion')->default(true);
            $table->string('imprimir_comprobantes', 1)->default('S');
            $table->string('ip')->nullable();
            $table->string('latitud', 20)->nullable();
            $table->string('longitud', 20)->nullable();
            $table->boolean('electronica')->default(false);
            $table->string('contribuyente_especial')->nullable();
            $table->string('obligado_contabilidad')->nullable();
            $table->time('hora_inicio')->default('09:00:00');
            $table->time('hora_fin')->default('23:00:00');
            $table->string('instancia_interno', 60)->nullable();
            $table->string('token_interno', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}
