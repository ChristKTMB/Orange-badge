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
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('name'); 
            $table->string('first_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->boolean('profil_complete')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('direction')->nullable();
            $table->string('fonction')->nullable();
            $table->string('matricule')->nullable();
            $table->string('manager')->nullable();
            $table->rememberToken();
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
