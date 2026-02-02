<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        // Statistics
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_courses' => Course::count(),
            'active_courses' => Course::where('status', 'opened')->count(),
            'total_enrollments' => Enrollment::where('status', 'active')->count(),
            'completed_courses' => Enrollment::where('status', 'completed')->count(),
        ];

        // Recent enrollments
        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->latest()
            ->take(10)
            ->get();

        // Top courses by enrollment
        $topCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentEnrollments',
            'topCourses'
        ));
    }
}
