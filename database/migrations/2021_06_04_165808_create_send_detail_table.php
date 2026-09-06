<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendDetailTable extends Migration {

    public function up() {
        Schema::create('send_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('send_header_id')->unsigned();
            $table->foreign('send_header_id')->references('id')->on('send_header');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('service_name', 60)->nullable();
            $table->string('campania', 60)->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('customer_name', 60)->nullable();
            $table->string('customer_phone', 60)->nullable();
            $table->string('customer_email', 60)->nullable();
            $table->string('text', 500)->nullable();
            $table->date('date_created')->nullable();
            $table->time('hour_created')->nullable();
            $table->date('date_send')->nullable();
            $table->time('hour_send')->nullable();
            $table->boolean('immediately')->default(false);
            $table->boolean('programmed')->default(false);
            $table->boolean('repeat')->default(false);
            $table->boolean('reminder')->default(false);
            $table->string('reminder_type', 20)->nullable();
            $table->integer('reminder_valor')->nullable();
            $table->boolean('recurrence')->default(false);
            $table->string('recurrence_type', 20)->nullable();
            $table->integer('recurrence_valor')->nullable();
            $table->integer('lapsos')->nullable();
            $table->string('observation', 60)->nullable();
            $table->string('status', 20)->default('PENDIENTE');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('send_detail');
    }

}
