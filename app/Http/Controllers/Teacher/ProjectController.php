<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show the form for creating a new project.
     */
    public function create(Course $course)
    {
        // Ensure teacher owns this course
        if ($course->user_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        return view('teacher.projects.create', compact('course'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request, Course $course)
    {
        // Ensure teacher owns this course
        if ($course->user_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
        ]);

        $course->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Project added successfully!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Course $course, Project $project)
    {
        // Ensure teacher owns this course
        if ($course->user_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        return view('teacher.projects.edit', compact('course', 'project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Course $course, Project $project)
    {
        // Ensure teacher owns this course
        if ($course->user_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Course $course, Project $project)
    {
        // Ensure teacher owns this course
        if ($course->user_id !== auth()->id()) { abort(403, 'Unauthorized action.'); }

        $project->delete();

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Project deleted successfully!');
    }
}
