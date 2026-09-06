<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiParametersTable extends Migration
{
    public function up()
    {
        Schema::create('api_parameters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('api_header_id')->nullable()->unsigned();
            $table->foreign('api_header_id')->references('id')->on('api_header');
            $table->date('date_created')->nullable();
            $table->string('description', 500)->nullable();
            $table->string('type', 250)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('default_value', 150)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_parameters');
    }
}
