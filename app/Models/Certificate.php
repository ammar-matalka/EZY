<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
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
        'enrollment_id',
        'certificate_number',
        'issued_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
        ];
    }

    // ========== Relationships ==========

    /**
     * Student who earned this certificate.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Course this certificate is for.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Enrollment this certificate is for.
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    // ========== Helper Methods ==========

    /**
     * Generate unique certificate number.
     */
    public static function generateCertificateNumber()
    {
        $year = date('Y');
        $lastCertificate = self::whereYear('issued_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastCertificate ? intval(substr($lastCertificate->certificate_number, -5)) + 1 : 1;

        return 'EZYS-' . $year . '-' . str_pad($sequence, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Create certificate for enrollment.
     */
    public static function createForEnrollment(Enrollment $enrollment)
    {
        return self::create([
            'student_id' => $enrollment->student_id,
            'course_id' => $enrollment->course_id,
            'enrollment_id' => $enrollment->id,
            'certificate_number' => self::generateCertificateNumber(),
            'issued_at' => now(),
        ]);
    }
}
