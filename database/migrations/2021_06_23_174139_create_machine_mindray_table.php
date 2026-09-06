<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineMindrayTable extends Migration {

    public function up() {
        Schema::create('machine_mindray', function (Blueprint $table) {

            $table->id();
            $table->string('date', 8000)->nullable();
            $table->date('date_created')->nullable;

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('machine_mindray');
    }

}
