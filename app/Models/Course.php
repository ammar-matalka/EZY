<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'teacher_id',
        'title',
        'slug',
        'description',
        'image',
        'category',
        'level',
        'duration',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration' => 'integer',
        ];
    }

    // ========== Relationships ==========

    /**
     * Teacher who owns this course.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Modules in this course.
     */
    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order');
    }

    /**
     * Projects in this course.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Student enrollments in this course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

   

    // ========== Helper Methods ==========

    /**
     * Check if course is opened.
     */
    public function isOpened()
    {
        return $this->status === 'opened';
    }

    /**
     * Check if course is coming soon.
     */
    public function isComingSoon()
    {
        return $this->status === 'coming_soon';
    }

    /**
     * Check if course is archived.
     */
    public function isArchived()
    {
        return $this->status === 'archived';
    }

    /**
     * Get total enrolled students count.
     */
    public function enrolledStudentsCount()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }

    /**
     * Generate slug from title.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    /**
     * Get route key name for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
