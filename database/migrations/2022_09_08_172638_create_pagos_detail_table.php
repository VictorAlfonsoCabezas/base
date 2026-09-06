<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosDetailTable extends Migration
{
    public function up()
    {
        Schema::create('pagos_detail', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('chat_bot_header_id')->nullable()->unsigned();
            $table->foreign('chat_bot_header_id')->references('id')->on('chat_bot_header');
            $table->bigInteger('pagos_header_id')->nullable()->unsigned();
            $table->foreign('pagos_header_id')->references('id')->on('pagos_header');
            $table->string('pay_payment_method')->nullable();
            $table->string('pay_ticket_number')->nullable();
            $table->integer('pay_status')->nullable();
            $table->boolean('status', 1)->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos_detail');
    }
}
