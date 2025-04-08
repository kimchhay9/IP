<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //schema is a Laravel package that provides a fluent API to create database tables and modify existing tables using PHP code instead of SQL queries.
        Schema::create('order_products', function (Blueprint $table) {//function (Blueprint $table) { ... } → A callback function that defines the table structure.
            $table->id();
            $table->bigInteger('order_id')->unsigned()->nullable(false);
            $table->bigInteger('product_id')->unsigned();
            $table->double('price');
            $table->integer('quantity')->nullable(false)->unsigned();
            $table->timestamps();

           $table->foreign('order_id')->references('id')->on('orders');
           $table->foreign('product_id')->references('id')->on('products');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
