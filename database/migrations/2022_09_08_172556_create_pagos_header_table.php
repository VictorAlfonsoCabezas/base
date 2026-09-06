<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('pagos_header', function (Blueprint $table) {
            $table->id();
            $table->date('date_created')->nullable();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('chat_bot_header_id')->nullable()->unsigned();
            $table->foreign('chat_bot_header_id')->references('id')->on('chat_bot_header');
            $table->string('pay_smart_link_url')->nullable();
            $table->string('pay_smart_link')->nullable();
            $table->integer('pay_status')->nullable();
            $table->boolean('status', 1)->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos_header');
    }
}
