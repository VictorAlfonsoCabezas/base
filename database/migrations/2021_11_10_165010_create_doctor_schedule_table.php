<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_schedule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('doctor_id')->nullable()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->string('doctor_name', 100)->nullable();
            $table->time('hour_start')->nullable();
            $table->time('hour_end')->nullable();
            $table->integer('day')->nullable();
            $table->integer('date_total')->nullable();
            $table->integer('interval')->nullable();
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sede');
            $table->string('sede_name', 100)->nullable();
            $table->bigInteger('departament_id')->nullable()->unsigned();
            $table->foreign('departament_id')->references('id')->on('departament');
            $table->string('departament_name', 100)->nullable();
            $table->string('code_intel')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor_schedule');
    }
}
