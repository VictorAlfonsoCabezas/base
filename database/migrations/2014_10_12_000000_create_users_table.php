<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('company_varias')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('photo')->nullable();
            $table->string('username')->unique();
            $table->string('ruc')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('token');
            $table->boolean('status')->default(true);
            $table->boolean('admin')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }

}
