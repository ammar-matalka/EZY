<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of all courses.
     */
    public function index()
    {
        $courses = Course::with('teacher')
            ->latest()
            ->paginate(20);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        // Get all teachers
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.courses.create', compact('teachers'));
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

        // Create course
     $course = Course::create([
    'user_id' => auth()->id(),
    'title' => $request->title,
    'slug' => Str::slug($request->title),
    'description' => $request->description,
    'category' => $request->category,
    'level' => $request->level,
    'duration' => $request->duration,
    'status' => $request->status,
    'image' => $imagePath,
]);


        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['teacher', 'modules', 'projects', 'enrollments.student']);

        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
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
        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image) {
                \Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses', 'public');
        }

        // Update course
        $course->update([
    'user_id' => auth()->id(),
    'title' => $request->title,
    'slug' => Str::slug($request->title),
    'description' => $request->description,
    'category' => $request->category,
    'level' => $request->level,
    'duration' => $request->duration,
    'status' => $request->status,
]);


        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Delete image if exists
        if ($course->image) {
            \Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}
