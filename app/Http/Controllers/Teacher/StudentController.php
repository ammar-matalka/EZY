<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display students enrolled in teacher's courses.
     */
    public function index(Request $request)
    {
        $teacher = auth()->user();

        // Get enrollments in teacher's courses
        $query = Enrollment::whereHas('course', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })
            ->with(['student', 'course']);

        // Filter by course
        if ($request->has('course_id') && $request->course_id != '') {
            $query->where('course_id', $request->course_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search by student name
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $enrollments = $query->latest()->paginate(20);

        // Get teacher's courses for filter
        $myCourses = $teacher->courses;

        return view('teacher.students.index', compact('enrollments', 'myCourses'));
    }
}
