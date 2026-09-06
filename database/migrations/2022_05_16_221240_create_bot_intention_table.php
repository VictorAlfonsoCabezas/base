<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotIntentionTable extends Migration
{
    public function up()
    {
        Schema::create('bot_intention', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->string('name', 150)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('code', 8)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_intention');
    }
}
