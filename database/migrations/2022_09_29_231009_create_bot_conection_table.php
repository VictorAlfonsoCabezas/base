<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotConectionTable extends Migration
{
    public function up()
    {
        Schema::create('bot_conection', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->nullable();
            $table->string('description', 150)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_conection');
    }
}
