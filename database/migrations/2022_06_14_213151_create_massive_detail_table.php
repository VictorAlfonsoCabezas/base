<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassiveDetailTable extends Migration {

    public function up() {
        Schema::create('massive_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('code_header', 15)->nullable();
            $table->integer('massive_header_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('sex', 2)->nullable();
            $table->string('citizenship_type', 6)->nullable();
            $table->string('citizenship_card')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('cellular')->nullable();
            $table->string('email')->nullable();
            $table->integer('envios')->default(0);
            $table->boolean('status', 1)->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('massive_detail');
    }

}
