<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Show the form for creating a new module.
     */
    public function create(Course $course)
    {
        // Check if teacher owns this course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.modules.create', compact('course'));
    }

    /**
     * Store a newly created module in storage.
     */
    public function store(Request $request, Course $course)
    {
        // Check if teacher owns this course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:1'],
            'content' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url'],
            'duration' => ['nullable', 'integer', 'min:1'],
        ]);

        $course->modules()->create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'content' => $request->input('content'),
            'video_url' => $request->video_url,
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Module added successfully!');
    }

    /**
     * Show the form for editing the specified module.
     */
    public function edit(Course $course, Module $module)
    {
        // Check if teacher owns this course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.modules.edit', compact('course', 'module'));
    }

    /**
     * Update the specified module in storage.
     */
    public function update(Request $request, Course $course, Module $module)
    {
        // Check if teacher owns this course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:1'],
            'content' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url'],
            'duration' => ['nullable', 'integer', 'min:1'],
        ]);

        $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
            'content' => $request->input('content'),
            'video_url' => $request->video_url,
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Module updated successfully!');
    }

    /**
     * Remove the specified module from storage.
     */
    public function destroy(Course $course, Module $module)
    {
        // Check if teacher owns this course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $module->delete();

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Module deleted successfully!');
    }
}
