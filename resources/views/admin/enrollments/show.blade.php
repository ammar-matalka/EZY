@extends('admin.layouts.app')

@section('title', 'Course Details')
@section('page-title', 'Course Details')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.courses.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Back to Courses
    </a>
</div>

<!-- Course Header -->
<div class="bg-white rounded-lg shadow-md p-8 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex items-start space-x-6">
            <!-- Course Image -->
            @if($course->image)
                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-32 h-32 rounded-lg object-cover">
            @else
                <div class="w-32 h-32 bg-primary rounded-lg flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                </div>
            @endif

            <!-- Course Info -->
            <div>
                <h1 class="text-3xl font-bold text-primary mb-2">{{ $course->title }}</h1>
                <p class="text-gray-600 mb-4">{{ $course->description }}</p>

                <div class="flex flex-wrap items-center gap-4">
                    <!-- Status Badge -->
                    <span class="px-4 py-1.5 text-sm font-semibold rounded-full
                        {{ $course->status == 'opened' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $course->status == 'coming_soon' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $course->status == 'archived' ? 'bg-gray-100 text-gray-600' : '' }}
                    ">
                        {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                    </span>

                    <!-- Level Badge -->
                    <span class="px-4 py-1.5 text-sm font-semibold rounded-full
                        {{ $course->level == 'beginner' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $course->level == 'intermediate' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $course->level == 'advanced' ? 'bg-red-100 text-red-600' : '' }}
                    ">
                        {{ ucfirst($course->level) }}
                    </span>

                    <!-- Category -->
                    @if($course->category)
                        <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-blue-100 text-blue-600">
                            {{ $course->category }}
                        </span>
                    @endif

                    <!-- Duration -->
                    @if($course->duration)
                        <span class="text-gray-600 text-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            {{ $course->duration }} Hours
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex space-x-2">
            <a href="{{ route('admin.courses.edit', $course) }}" class="px-4 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
                Edit Course
            </a>
        </div>
    </div>
</div>

<!-- Teacher Info -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h2 class="text-xl font-bold text-primary mb-4">Instructor</h2>
    <div class="flex items-center space-x-4">
        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
            @if($course->teacher->avatar)
                <img src="{{ Storage::url($course->teacher->avatar) }}" alt="{{ $course->teacher->name }}" class="w-full h-full rounded-full object-cover">
            @else
                <span class="text-white font-bold text-xl">{{ substr($course->teacher->name, 0, 1) }}</span>
            @endif
        </div>
        <div>
            <h3 class="font-bold text-gray-900">{{ $course->teacher->name }}</h3>
            <p class="text-sm text-gray-600">{{ $course->teacher->email }}</p>
            @if($course->teacher->expertise)
                <p class="text-sm text-orange mt-1">{{ $course->teacher->expertise }}</p>
            @endif
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Modules -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Modules</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $course->modules->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Projects -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                <h3 class="text-3xl font-bold text-orange mt-2">{{ $course->projects->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Enrolled Students -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Enrolled Students</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $course->enrollments->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Modules List -->
<div class="bg-white rounded-lg shadow-md mb-6">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-primary">Course Modules</h2>
    </div>
    <div class="p-6">
        @forelse($course->modules as $module)
            <div class="flex items-start justify-between p-4 border-b border-gray-200 last:border-0">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">{{ $module->order }}. {{ $module->title }}</h3>
                    @if($module->description)
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($module->description, 100) }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center py-8">No modules added yet</p>
        @endforelse
    </div>
</div>

<!-- Projects List -->
<div class="bg-white rounded-lg shadow-md mb-6">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-primary">Course Projects</h2>
    </div>
    <div class="p-6">
        @forelse($course->projects as $project)
            <div class="p-4 border-b border-gray-200 last:border-0">
                <h3 class="font-semibold text-gray-900">{{ $project->title }}</h3>
                @if($project->description)
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 150) }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500 text-center py-8">No projects added yet</p>
        @endforelse
    </div>
</div>

<!-- Enrolled Students -->
<div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-primary">Enrolled Students</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progress</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrolled At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($course->enrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold text-sm">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $enrollment->student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2 mr-2" style="width: 100px;">
                                    <div class="bg-orange h-2 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                                </div>
                                <span class="text-sm text-gray-600">{{ $enrollment->progress }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-600' : '' }}
                                {{ $enrollment->status == 'completed' ? 'bg-blue-100 text-blue-600' : '' }}
                                {{ $enrollment->status == 'suspended' ? 'bg-red-100 text-red-600' : '' }}
                            ">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $enrollment->enrolled_at->format('Y-m-d') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            No students enrolled yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
