<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'courses_limit',
        'features',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'courses_limit' => 'integer',
            'features' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // ========== Relationships ==========

    /**
     * Subscriptions using this plan.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // ========== Helper Methods ==========

    /**
     * Check if plan is active.
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Check if plan has unlimited courses.
     */
    public function isUnlimited()
    {
        return $this->courses_limit >= 999;
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' JOD';
    }
}
