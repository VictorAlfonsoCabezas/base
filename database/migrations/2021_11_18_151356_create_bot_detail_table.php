<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotDetailTable extends Migration
{
    public function up()
    {
        Schema::create('bot_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->date('date_created')->nullable();
            $table->bigInteger('bot_header_id')->nullable()->unsigned();
            $table->foreign('bot_header_id')->references('id')->on('bot_header');
            $table->string('description', 500)->nullable();
            $table->boolean('option')->default(false);
            $table->boolean('api')->default(false);
            $table->boolean('api_response')->default(false);
            $table->boolean('personalized_response')->default(false);
            $table->boolean('refresh')->default(false);
            $table->boolean('location')->default(false);
            $table->boolean('location_description')->default(false);
            $table->boolean('guardar_api')->default(false);
            $table->boolean('disabled')->default(false);
            $table->boolean('last_message')->default(false);
            $table->boolean('main_branch')->default(true);
            $table->boolean('send_inmediately')->default(false);
            $table->string('order', 20)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_detail');
    }
}
