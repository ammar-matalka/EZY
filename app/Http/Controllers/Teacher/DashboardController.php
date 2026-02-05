<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display teacher dashboard
     */
    public function index()
    {
        $teacher = auth()->user();

        // Statistics
       $stats = [
    'courses' => $teacher->courses()->count(),
    'opened_courses' => $teacher->courses()->where('status', 'opened')->count(),
    'students' => Enrollment::whereHas('course', function ($q) use ($teacher) {
        $q->where('user_id', $teacher->id);
    })->distinct('user_id')->count('user_id'),
    'modules' => $teacher->courses()->withCount('modules')->get()->sum('modules_count'),
    'projects' => $teacher->courses()->withCount('projects')->get()->sum('projects_count'),
];


        // Recent Courses (last 5)
        $recentCourses = $teacher->courses()
            ->with(['modules', 'enrollments'])
            ->latest()
            ->take(5)
            ->get();

        // Recent Students (last 10)
        $recentStudents = Enrollment::with(['student', 'course'])
            ->whereHas('course', function ($q) use ($teacher) {
                $q->where('user_id', $teacher->id);
            })
            ->latest()
            ->take(10)
            ->get();

        return view('teacher.dashboard', compact(
            'stats',
            'recentCourses',
            'recentStudents'
        ));
    }
}
