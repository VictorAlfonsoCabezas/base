<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('api_header', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->boolean('type_api')->default(false);
            $table->string('tipo_consulta', 20)->nullable();
            $table->date('date_created')->nullable();
            $table->string('description', 500)->nullable();
            $table->string('table_name', 100)->nullable();
            $table->string('api_link', 250)->nullable();
            $table->string('instancia', 100)->nullable();
            $table->string('token', 60)->nullable();
            $table->string('method', 20)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_header');
    }
}
