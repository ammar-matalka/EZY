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
            'remaining_courses' => $subscription ? $subscription->remainingCourses() : 0,
        ];

        // Get enrolled courses with details
        $enrolledCourses = $student->enrollments()
            ->where('status', 'active')
            ->with(['course.teacher', 'course.modules'])
            ->latest()
            ->get();

        return view('student.dashboard', compact(
            'subscription',
            'stats',
            'enrolledCourses'
        ));
    }
}
