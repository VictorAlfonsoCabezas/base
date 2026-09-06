<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSendMassiveTable extends Migration {

    public function up() {
        Schema::create('date_send_massive', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('code_header', 15)->nullable();
            $table->integer('massive_header_id')->nullable();
            $table->date('date_created')->nullable();
            $table->time('hour_created')->nullable();
            $table->boolean('status', 1)->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('date_send_massive');
    }

}
