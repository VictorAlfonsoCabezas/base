<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('name');
            $table->string('description')->nullable();
            $table->bigInteger('category_product_id')->nullable()->unsigned();
            $table->foreign('category_product_id')->references('id')->on('category');
            $table->bigInteger('unit_measure_id')->unsigned();
            $table->foreign('unit_measure_id')->references('id')->on('category');
            $table->string('unidad_name')->nullable();
            $table->string('tipo_iva', 2)->default('A');//A;iva ,B:sin iva, C:otros
            $table->float('costo')->default(0);
            $table->float('precio_a')->default(0);
            $table->float('precio_b')->default(0);
            $table->float('precio_c')->default(0);
            $table->string('tipo',1)->default('P');//P:producto S:servicio
            $table->string('photo')->nullable();
            $table->string('observation', 1000)->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->boolean('promotion')->default(false);//Si tiene una promocion
            $table->string('stock')->default(0);
            $table->string('stock_minimo')->default(0);
            $table->boolean('lotes')->default(false);//True:trabaja lotrd o false
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
