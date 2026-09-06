<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration {

    public function up() {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('title', 100);
            $table->text('description', 250)->nullable();
            $table->integer('type')->default(1); //1:company YAPAS
            $table->string('type_name')->nullable(); //Nombre Prueba
            $table->integer('sub_type')->default(0);
            $table->string('photo')->nullable();
            $table->string('opcion1', 60)->nullable();
            $table->string('opcion2', 60)->nullable();
            $table->string('opcion3', 60)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('category');
    }

}
