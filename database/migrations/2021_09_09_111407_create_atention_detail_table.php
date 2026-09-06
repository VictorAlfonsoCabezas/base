<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtentionDetailTable extends Migration
{
    public function up()
    {
        Schema::create('atention_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('atention_header_id')->nullable()->unsigned();
            $table->foreign('atention_header_id')->references('id')->on('atention_header');
            $table->bigInteger('procedures_id')->nullable()->unsigned();
            $table->foreign('procedures_id')->references('id')->on('procedures');
            $table->string('procedures_name', 60)->nullable();
            $table->string('type_procedures_name', 120)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('atention_detail');
    }
}
