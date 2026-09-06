<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration {

    public function up() {
        Schema::create('plan', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->nullable();
            $table->decimal('month_price', 8, 2)->default(0);
            $table->decimal('year_price', 8, 2)->default(0);
            $table->string('color_1', 20)->default('#EF5A5C');
            $table->string('color_2', 20)->default('#EF5A5C');
            $table->string('color_3', 20)->default('#EF5A5C');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('plan');
    }

}
