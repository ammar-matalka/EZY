<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display student dashboard.
     */
    public function index()
    {
        $student = auth()->user();

        // Get active subscription
        $subscription = $student->activeSubscription;

        // Statistics
        $stats = [
            'enrolled_courses' => $student->enrollments()->where('status', 'active')->count(),
            'completed_courses' => $student->enrollments()->where('status', 'completed')->count(),
            'certificates_earned' => $student->certificates()->count(),
            'remaining_courses' => $subscription ? $subscription->remainingCourses() : 0,
        ];

        // Recent enrollments
        $recentEnrollments = $student->enrollments()
            ->with('course.teacher')
            ->latest()
            ->take(5)
            ->get();

        // Recent certificates
        $recentCertificates = $student->certificates()
            ->with('course')
            ->latest()
            ->take(3)
            ->get();

        return view('student.dashboard', compact(
            'subscription',
            'stats',
            'recentEnrollments',
            'recentCertificates'
        ));
    }
}
