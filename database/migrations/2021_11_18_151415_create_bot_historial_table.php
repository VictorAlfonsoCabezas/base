<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotHistorialTable extends Migration
{
    public function up()
    {
        Schema::create('bot_historial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('bot_header_id')->nullable()->unsigned();
            $table->foreign('bot_header_id')->references('id')->on('bot_header');
            $table->bigInteger('bot_detail_id')->nullable()->unsigned();
            $table->foreign('bot_detail_id')->references('id')->on('bot_detail');
            $table->foreign('api_header_id')->references('id')->on('api_header');
            $table->bigInteger('api_header_id')->nullable()->unsigned();
            $table->string('api_header_code', 20)->nullable();
            $table->string('api_header_response', 250)->nullable();
            $table->integer('api_parameters_id')->nullable();
            $table->string('opcion', 60)->nullable();
            $table->string('description', 500)->nullable();
            $table->boolean('last_message')->default(true);
            $table->boolean('main_detail')->default(true);
            $table->bigInteger('main_answer_id')->nullable()->unsigned();
            $table->foreign('main_answer_id')->references('id')->on('bot_detail');
            $table->integer('order')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_historial');
    }
}
