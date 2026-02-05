<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Create courses table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('objectives')->nullable();
            $table->string('image')->nullable();
            $table->string('duration')->nullable();
            $table->enum('status', ['opened', 'coming_soon', 'archived'])->default('opened');
            $table->integer('enrollments_count')->default(0);
            $table->timestamps();
        });

        // Create modules table
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Create projects table
        Schema::create('course_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Create tools table
        Schema::create('course_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->string('name')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_tools');
        Schema::dropIfExists('course_projects');
        Schema::dropIfExists('course_modules');
        Schema::dropIfExists('courses');
    }
};
