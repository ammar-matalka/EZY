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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Role
            $table->enum('role', ['admin', 'teacher', 'student'])->default('student');

            // Profile fields
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable(); // For teachers
            $table->string('expertise')->nullable(); // For teachers (e.g., "Cloud & Cyber Security, Forensic")
            $table->decimal('rating', 3, 2)->default(0.00); // For teachers (0.00 to 5.00)
            $table->integer('reviews_count')->default(0); // For teachers

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
