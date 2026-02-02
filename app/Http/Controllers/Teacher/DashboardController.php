<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display teacher dashboard.
     */
    public function index()
    {
        $teacher = auth()->user();

        // Statistics for this teacher only
        $stats = [
            'total_courses' => $teacher->courses()->count(),
            'active_courses' => $teacher->courses()->where('status', 'opened')->count(),
            'total_students' => $teacher->courses()
                ->withCount('enrollments')
                ->get()
                ->sum('enrollments_count'),
            'completed_enrollments' => $teacher->courses()
                ->with(['enrollments' => function ($q) {
                    $q->where('status', 'completed');
                }])
                ->get()
                ->sum(function ($course) {
                    return $course->enrollments->count();
                }),
        ];

        // Recent enrollments in my courses
        $recentEnrollments = \App\Models\Enrollment::whereHas('course', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })
            ->with(['student', 'course'])
            ->latest()
            ->take(10)
            ->get();

        // My courses
        $myCourses = $teacher->courses()
            ->withCount('enrollments')
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact('stats', 'recentEnrollments', 'myCourses'));
    }
}
