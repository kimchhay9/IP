<?php

//Illuminate is the core namespace used in Laravel for its built-in components and features. 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//blueprint is a Laravel package that provides a fluent API to create database tables and modify existing tables using PHP code instead of SQL queries.
return new class extends Migration {
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {//create activity_logs table
            $table->id();//create id column
            $table->string('model'); // Model name
            $table->unsignedBigInteger('model_id')->nullable(); // Record ID
            $table->string('action'); // create, update, delete
            $table->json('changes')->nullable(); // Stores old and new data
            $table->timestamp('created_at')->useCurrent();//create created_at column
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');//drop activity_logs table
    }
};
