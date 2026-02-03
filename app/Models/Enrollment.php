<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'subscription_id',
        'progress',
        'status',
        'enrolled_at',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'progress' => 'integer',
            'enrolled_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    // ========== Relationships ==========

    /**
     * Student who enrolled.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Course enrolled in.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Subscription used for enrollment.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }


    // ========== Helper Methods ==========

    /**
     * Check if enrollment is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if course is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Update progress percentage.
     */
    public function updateProgress($percentage)
    {
        $this->progress = max(0, min(100, $percentage));

        if ($this->progress >= 100) {
            $this->status = 'completed';
            $this->completed_at = now();
        }

        $this->save();
    }

    /**
     * Mark as completed.
     */
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'progress' => 100,
            'completed_at' => now(),
        ]);
    }
}
