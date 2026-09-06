<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatBotDetailTable extends Migration
{
    public function up()
    {
        Schema::create('chat_bot_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('chat_bot_header_id')->nullable()->unsigned();
            $table->foreign('chat_bot_header_id')->references('id')->on('chat_bot_header');
            $table->bigInteger('bot_detail_id')->nullable()->unsigned();
            $table->boolean('last_message')->default(false);
            $table->foreign('bot_detail_id')->references('id')->on('bot_detail');
            $table->string('bot_question', 1000)->nullable();
            $table->bigInteger('bot_historial_id')->nullable()->unsigned();
            $table->foreign('bot_historial_id')->references('id')->on('bot_historial');
            $table->string('customer_address_id', 20)->nullable();
            $table->string('customer_answer', 500)->nullable();
            $table->string('description', 500)->nullable();
            $table->boolean('bot')->default(true);
            $table->string('date_format', 20)->nullable();
            $table->date('date_real')->nullable();
            $table->time('time_real')->nullable();
            $table->integer('messagenumber')->nullable();
            $table->boolean('viewed')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_bot_detail');
    }
}
