<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotCustomerResponseTable extends Migration
{
    public function up()
    {
        Schema::create('bot_customer_response', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('api_header_id')->nullable()->unsigned();
            $table->foreign('api_header_id')->references('id')->on('api_header');
            $table->date('date_created')->nullable();
            $table->string('table_name', 60)->nullable();
            $table->string('campo_name', 150)->nullable();
            $table->string('response_opcion', 20)->nullable();
            $table->string('response_customer', 250)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bot_customer_response');
    }
}
