<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migrations are version-controlled database changes.
     *
     * This keeps the database schema consistent across machines/environments
     * (local -> staging -> production).
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('roll_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('course');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
