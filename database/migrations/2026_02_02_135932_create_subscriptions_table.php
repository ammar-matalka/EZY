<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // User subscriptions
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->integer('courses_limit');
            $table->integer('courses_selected')->default(0);
            $table->dateTime('starts_at');      // ← غيّرنا من timestamp لـ dateTime
            $table->dateTime('expires_at');     // ← غيّرنا من timestamp لـ dateTime
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->timestamps();
        });

        // Pivot table - selected courses
        Schema::create('subscription_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->dateTime('enrolled_at')->useCurrent();
            $table->timestamps();

            $table->unique(['subscription_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_courses');
        Schema::dropIfExists('subscriptions');
    }
};
