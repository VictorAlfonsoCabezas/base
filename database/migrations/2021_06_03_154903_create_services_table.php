<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration {

    public function up() {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('description', 255)->nullable();
            $table->string('photo')->nullable();
            $table->string('icon', 60)->nullable();
            $table->string('class', 60)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('services');
    }

}
