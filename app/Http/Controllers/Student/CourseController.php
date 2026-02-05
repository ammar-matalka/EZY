<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display courses listing
     */
    public function index(Request $request)
    {
        $query = Course::with(['modules', 'enrollments']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Sorting
        switch ($request->get('sort', 'popular')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('title', 'asc');
                break;
            case 'popular':
            default:
                $query->withCount('enrollments')
                      ->orderBy('enrollments_count', 'desc');
                break;
        }

        $courses = $query->paginate(12);

        return view('student.courses.index', compact('courses'));
    }

    /**
     * Display course details
     */
   /**
 * Display course details
 */
public function show(Course $course)
{
    // Load relationships
    $course->load(['modules.lessons', 'projects']);

    // Check if user has access (enrolled or subscribed)
    $hasAccess = false;

    if (auth()->check()) {
        // Check if user is enrolled via subscription
        $hasAccess = auth()->user()
            ->activeSubscription
            ?->courses()
            ->where('courses.id', $course->id)
            ->exists() ?? false;
    }

    return view('student.courses.show', compact('course', 'hasAccess'));
}
}
