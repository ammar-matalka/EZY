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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('title'); // e.g., "01 HTML", "02 CSS", "03 Bootstrap"
            $table->text('description')->nullable();
            $table->integer('order')->default(0); // For ordering modules
            $table->longText('content')->nullable(); // Text/HTML content
            $table->string('video_url')->nullable(); // Link to video
            $table->integer('duration')->nullable(); // Duration in minutes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
