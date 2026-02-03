<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function index()
    {
        // Statistics
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'courses' => Course::count(),
            'opened_courses' => Course::where('status', 'opened')->count(),
            'enrollments' => Enrollment::where('status', 'active')->count(),
        ];

        // Recent Users (last 5)
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Recent Courses (last 5)
        $recentCourses = Course::with(['teacher', 'modules', 'enrollments'])
            ->latest()
            ->take(5)
            ->get();

        // Recent Enrollments (last 10)
        $recentEnrollments = Enrollment::with(['student', 'course.teacher'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentUsers',
            'recentCourses',
            'recentEnrollments'
        ));
    }
}
