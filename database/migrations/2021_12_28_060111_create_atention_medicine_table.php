<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtentionMedicineTable extends Migration
{

    public function up()
    {
        Schema::create('atention_medicine', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('atention_header_id')->nullable()->unsigned();
            $table->foreign('atention_header_id')->references('id')->on('atention_header');
            $table->bigInteger('medicine_id')->nullable()->unsigned();
            $table->foreign('medicine_id')->references('id')->on('medicine');
            $table->string('medicine_name', 150)->nullable();
            $table->date('date_created')->nullable();
            $table->string('dosis', 100)->nullable();
            $table->string('observation', 500)->nullable();
            $table->integer('total')->nullable();
            $table->string('status_dispatched', 60)->nullable();
            $table->string('reservado_1', 150)->nullable();
            $table->string('reservado_2', 150)->nullable();
            $table->string('code_intel')->nullable(); //ID de Intélho
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atention_medicine');
    }
}
