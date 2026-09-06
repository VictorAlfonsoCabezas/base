<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('bot_header', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('start_code', 500)->nullable();
            $table->bigInteger('user_created_id')->nullable()->unsigned();
            $table->foreign('user_created_id')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_header');
    }
}
