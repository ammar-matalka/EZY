<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display list of students enrolled in teacher's courses
     */
    public function index(Request $request)
    {
        $teacher = auth()->user();

        // Get teacher's courses for filter dropdown
        $courses = $teacher->courses()->orderBy('title')->get();

        // Statistics
        $allEnrollments = Enrollment::whereHas('course', function($q) use ($teacher) {
            $q->where('teacher_id', $teacher->id);
        });

        $stats = [
            'total' => (clone $allEnrollments)->distinct('student_id')->count('student_id'),
            'active' => (clone $allEnrollments)->where('status', 'active')->count(),
            'completed' => (clone $allEnrollments)->where('status', 'completed')->count(),
            'avg_progress' => round((clone $allEnrollments)->avg('progress') ?? 0),
        ];

        // Query with filters
        $query = Enrollment::with(['student', 'course.modules'])
            ->whereHas('course', function($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            });

        // Filter by student search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get enrollments with pagination
        $enrollments = $query->latest()->paginate(20);

        return view('teacher.students.index', compact('enrollments', 'courses', 'stats'));
    }
}
