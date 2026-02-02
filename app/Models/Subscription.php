<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'plan_id',
        'status',
        'started_at',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    // ========== Relationships ==========

    /**
     * Student who owns this subscription.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Plan associated with this subscription.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Enrollments under this subscription.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Payments for this subscription.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // ========== Helper Methods ==========

    /**
     * Check if subscription is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if subscription is expired.
     */
    public function isExpired()
    {
        return $this->status === 'expired';
    }

    /**
     * Check if subscription is cancelled.
     */
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get enrolled courses count.
     */
    public function enrolledCoursesCount()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }

    /**
     * Get remaining courses.
     */
    public function remainingCourses()
    {
        $enrolled = $this->enrolledCoursesCount();
        return max(0, $this->plan->courses_limit - $enrolled);
    }

    /**
     * Check if can enroll more courses.
     */
    public function canEnrollMore()
    {
        if (!$this->isActive()) {
            return false;
        }

        return $this->enrolledCoursesCount() < $this->plan->courses_limit;
    }
}
