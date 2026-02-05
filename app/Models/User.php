<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasSubscription;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasSubscription;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'bio',
        'expertise',
        'rating',
        'reviews_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rating' => 'decimal:2',
            'reviews_count' => 'integer',
        ];
    }

    // ========== Relationships ==========

    /**
     * Courses taught by this teacher.
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    /**
     * Subscriptions for this student.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    /**
     * Active subscription for this student.
     */
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class, 'user_id')
            ->where('status', 'active')
            ->latest();
    }

    /**
     * Course enrollments for this student.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }



    /**
     * Payments made by this user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    // ========== Helper Methods ==========

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is teacher.
     */
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if user is student.
     */
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * Check if student can enroll in more courses.
     */
    public function canEnroll()
    {
        if (!$this->isStudent()) {
            return false;
        }

        $subscription = $this->activeSubscription;

        if (!$subscription) {
            return false;
        }

        $enrolledCount = $this->enrollments()
            ->where('subscription_id', $subscription->id)
            ->where('status', 'active')
            ->count();

        return $enrolledCount < $subscription->plan->courses_limit;
    }

    /**
     * Get remaining courses for student.
     */
    public function remainingCourses()
    {
        if (!$this->isStudent()) {
            return 0;
        }

        $subscription = $this->activeSubscription;

        if (!$subscription) {
            return 0;
        }

        $enrolledCount = $this->enrollments()
            ->where('subscription_id', $subscription->id)
            ->where('status', 'active')
            ->count();

        return max(0, $subscription->plan->courses_limit - $enrolledCount);
    }
}
