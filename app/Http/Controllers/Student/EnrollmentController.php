<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Enroll in a course.
     */
    public function enroll(Course $course)
    {
        $student = auth()->user();

        // Check if student can enroll
        if (!$student->canEnroll()) {
            return redirect()->back()
                ->with('error', 'You have reached your plan limit! Please upgrade your plan.');
        }

        // Check if already enrolled
        if ($student->enrollments()->where('course_id', $course->id)->where('status', 'active')->exists()) {
            return redirect()->back()
                ->with('error', 'You are already enrolled in this course!');
        }

        // Check if course is available
        if (!$course->isOpened()) {
            return redirect()->back()
                ->with('error', 'This course is not available!');
        }

        // Get active subscription
        $subscription = $student->activeSubscription;

        // Create enrollment
        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'subscription_id' => $subscription->id,
            'progress' => 0,
            'status' => 'active',
            'enrolled_at' => now(),
        ]);

        return redirect()->route('student.my-courses')
            ->with('success', 'Successfully enrolled in ' . $course->title . '!');
    }

    /**
     * Display student's enrolled courses.
     */
    public function myCourses()
    {
        $student = auth()->user();

        $enrollments = $student->enrollments()
            ->with('course.teacher')
            ->latest()
            ->paginate(12);

        return view('student.my-courses.index', compact('enrollments'));
    }

    /**
     * Display learning page for enrolled course.
     */
    public function learn(Enrollment $enrollment)
    {
        // Ensure student owns this enrollment
        if ($enrollment->student_id !== auth()->id()) {
            abort(403);
        }

        $enrollment->load(['course.modules', 'course.projects', 'course.teacher']);

        return view('student.my-courses.learn', compact('enrollment'));
    }
}
