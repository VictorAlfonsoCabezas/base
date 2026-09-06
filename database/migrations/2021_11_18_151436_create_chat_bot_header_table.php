<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatBotHeaderTable extends Migration
{

    public function up()
    {
        Schema::create('chat_bot_header', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('bot_header_id')->nullable()->unsigned();
            $table->foreign('bot_header_id')->references('id')->on('bot_header');
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->string('name', 100)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('chatId', 150)->nullable();
            $table->string('status')->default('FINALIZADO');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('chat_bot_header');
    }
}
