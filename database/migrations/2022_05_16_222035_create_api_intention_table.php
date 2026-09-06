<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiIntentionTable extends Migration
{
    public function up()
    {
        Schema::create('api_intention', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('api_header_id')->nullable()->unsigned();
            $table->foreign('api_header_id')->references('id')->on('api_header');
            $table->bigInteger('bot_intention_id')->nullable()->unsigned();
            $table->foreign('bot_intention_id')->references('id')->on('bot_intention');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_intention');
    }
}
