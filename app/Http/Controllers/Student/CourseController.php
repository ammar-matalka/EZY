<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of available courses.
     */
    public function index(Request $request)
    {
        $query = Course::where('status', 'opened')
            ->with('teacher');

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->latest()->paginate(12);

        // Get categories for filter
        $categories = Course::where('status', 'opened')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('student.courses.index', compact('courses', 'categories'));
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        // Check if course is opened
        if (!$course->isOpened()) {
            abort(404);
        }

        $course->load(['teacher', 'modules', 'projects']);

        // Check if student already enrolled
        $student = auth()->user();
        $isEnrolled = $student->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        // Check if student can enroll
        $canEnroll = !$isEnrolled && $student->canEnroll();

        return view('student.courses.show', compact('course', 'isEnrolled', 'canEnroll'));
    }
}
