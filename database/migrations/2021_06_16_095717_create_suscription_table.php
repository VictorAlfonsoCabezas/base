<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscriptionTable extends Migration
{

    public function up()
    {
        Schema::create('suscription', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plan');
            $table->date('date_created')->nullable();
            $table->date('date_finish')->nullable();
            $table->date('date_finished')->nullable();
            $table->boolean('renewall')->default(true);
            $table->date('date_renewall')->nullable();
            $table->date('date_cancel_renewall')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suscription');
    }
}
