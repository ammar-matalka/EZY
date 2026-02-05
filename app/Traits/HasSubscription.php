<?php

namespace App\Traits;

use App\Models\Subscription;

trait HasSubscription
{
    // Get user's active subscription
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
                    ->where('status', 'active')
                    ->where('expires_at', '>', now())
                    ->latest();
    }

    // Get all subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Check if user has active subscription
    public function hasActiveSubscription(): bool
    {
        return $this->activeSubscription()->exists();
    }

    // Get remaining course slots
    public function remainingCourseSlots(): int
    {
        $subscription = $this->activeSubscription;
        return $subscription ? $subscription->remainingSlots() : 0;
    }

    // Check if user can enroll in course
    public function canEnrollInCourse($courseId): bool
    {
        $subscription = $this->activeSubscription;

        if (!$subscription) return false;
        if ($subscription->hasCourse($courseId)) return false;
        if (!$subscription->canSelectMore()) return false;

        return true;
    }

    // Get enrolled courses through subscription
    public function enrolledCourses()
    {
        $subscription = $this->activeSubscription;
        return $subscription ? $subscription->courses : collect();
    }
}
