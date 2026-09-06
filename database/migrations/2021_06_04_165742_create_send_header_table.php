<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendHeaderTable extends Migration {

    public function up() {
        Schema::create('send_header', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('campania', 60)->nullable();
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('customer_name', 60)->nullable();
            $table->string('customer_phone', 60)->nullable();
            $table->string('customer_email', 60)->nullable();
            $table->string('text', 500)->nullable();
            $table->date('date_created')->nullable();
            $table->time('hour_created')->nullable();
            $table->string('observation', 60)->nullable();
            $table->string('status', 20)->default('PENDIENTE');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('send_header');
    }

}
