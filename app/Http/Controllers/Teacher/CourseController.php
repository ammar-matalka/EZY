<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of teacher's courses.
     */
    public function index()
    {
        $courses = auth()->user()->courses()
            ->withCount('enrollments')
            ->latest()
            ->paginate(20);

        return view('teacher.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('teacher.courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:opened,coming_soon,archived'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
        }

        // Create course for current teacher
        $course = auth()->user()->courses()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category' => $request->category,
            'level' => $request->level,
            'duration' => $request->duration,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        // Ensure teacher owns this course
        if ($course->teacher_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        $course->load(['modules', 'projects', 'enrollments.student']);

        return view('teacher.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        // Ensure teacher owns this course
        if ($course->teacher_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        return view('teacher.courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        // Ensure teacher owns this course
        if ($course->teacher_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:opened,coming_soon,archived'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image) {
                \Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses', 'public');
        }

        // Update course
        $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category' => $request->category,
            'level' => $request->level,
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Ensure teacher owns this course
        if ($course->teacher_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        // Delete image if exists
        if ($course->image) {
            \Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}
