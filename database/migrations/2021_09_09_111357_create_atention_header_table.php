<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtentionHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('atention_header', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->bigInteger('sede_id')->nullable()->unsigned();
            $table->foreign('sede_id')->references('id')->on('sede');
            $table->bigInteger('departament_id')->nullable()->unsigned();
            $table->foreign('departament_id')->references('id')->on('departament');
            $table->bigInteger('doctor_id')->nullable()->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctor');
            $table->date('date_created')->nullable();
            $table->date('date_opening')->nullable();
            $table->datetime('date_atention')->nullable();
            $table->datetime('date_atention_end')->nullable();
            $table->string('oda')->nullable();
            $table->string('generation_area_id')->nullable();
            $table->string('generation_area_name')->nullable();
            $table->boolean('generation_area_externa')->default(false);
            $table->datetime('date_order')->nullable();
            $table->string('reservador_1')->nullable();
            $table->string('reservador_2')->nullable();
            $table->string('observation')->nullable();
            $table->string('status_atention')->nullable();
            $table->string('status_pay')->nullable();
            $table->string('code_intel')->nullable(); //doc_motivo en Intelho
            $table->string('type_send', 60)->default('INTELHO');
            $table->boolean('sincronizado')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atention_header');
    }
}
