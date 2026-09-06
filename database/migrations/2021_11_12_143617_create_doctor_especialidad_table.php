<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorEspecialidadTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_especialidad', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('doctor_id')->nullable()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->bigInteger('especialidad_id')->nullable()->unsigned();
            $table->foreign('especialidad_id')->references('id')->on('especialidad');
            $table->string('description', 500)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor_especialidad');
    }
}
