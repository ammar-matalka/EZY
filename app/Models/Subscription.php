<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'courses_limit',
        'courses_selected',
        'starts_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'subscription_courses')
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }

    // Check if user can select more courses
    public function canSelectMore(): bool
    {
        return $this->courses_selected < $this->courses_limit;
    }

    // Get remaining slots
    public function remainingSlots(): int
    {
        return max(0, $this->courses_limit - $this->courses_selected);
    }

    // Check if subscription is active
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->expires_at->isFuture();
    }

    // Check if course is already selected
    public function hasCourse($courseId): bool
    {
        return $this->courses()->where('course_id', $courseId)->exists();
    }

    // Scope for active subscriptions
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where('expires_at', '>', now());
    }
    // Get remaining courses (alias for remainingSlots)
public function remainingCourses(): int
{
    return $this->remainingSlots();
}
}

