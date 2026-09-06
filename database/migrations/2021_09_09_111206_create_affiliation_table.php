<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationTable extends Migration
{
    public function up()
    {
        Schema::create('affiliation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->bigInteger('type_affiliation_id')->nullable()->unsigned();
            $table->foreign('type_affiliation_id')->references('id')->on('type_affiliation');
            $table->string('name', 60)->nullable();
            $table->date('date_created')->nullable();
            $table->boolean('percentage')->default(false);
            $table->decimal('percentage_coverage', 8, 2)->nullable();
            $table->string('code_intel')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('affiliation');
    }
}
