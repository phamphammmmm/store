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
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 255)->unique()->nullable();
                $table->string('address',200)->nullable();
                $table->string('phone', 30)->unique();
                $table->string('email',50)->unique();
                $table->string('password',200)->nullable();
                $table->text('path')->nullable();
                $table->string('role')->default('user');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};