@extends('teacher.layouts.app')

@section('title', 'Course Details')
@section('page-title', 'Manage Course')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('teacher.courses.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Back to My Courses
    </a>
</div>

<!-- Course Header -->
<div class="bg-white rounded-lg shadow-md p-8 mb-6">
    <div class="flex items-start justify-between">
        <div class="flex items-start space-x-6 flex-1">
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
            <div class="flex-1">
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

                    @if($course->category)
                        <span class="px-4 py-1.5 text-sm font-semibold rounded-full bg-blue-100 text-blue-600">
                            {{ $course->category }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions -->
        <a href="{{ route('teacher.courses.edit', $course) }}" class="px-4 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
            Edit Course
        </a>
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

<!-- Tabs -->
<div class="bg-white rounded-lg shadow-md mb-6" x-data="{ tab: 'modules' }">
    <!-- Tab Headers -->
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 px-6" aria-label="Tabs">
            <button @click="tab = 'modules'" :class="{ 'border-orange text-orange': tab === 'modules', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'modules' }" class="py-4 px-1 border-b-2 font-medium text-sm transition">
                Modules ({{ $course->modules->count() }})
            </button>
            <button @click="tab = 'projects'" :class="{ 'border-orange text-orange': tab === 'projects', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'projects' }" class="py-4 px-1 border-b-2 font-medium text-sm transition">
                Projects ({{ $course->projects->count() }})
            </button>
            <button @click="tab = 'students'" :class="{ 'border-orange text-orange': tab === 'students', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'students' }" class="py-4 px-1 border-b-2 font-medium text-sm transition">
                Students ({{ $course->enrollments->count() }})
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="p-6">

        <!-- Modules Tab -->
        <div x-show="tab === 'modules'">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary">Course Modules</h3>
                <a href="{{ route('teacher.modules.create', $course) }}" class="px-4 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Add Module
                </a>
            </div>

            @forelse($course->modules as $module)
                <div class="flex items-start justify-between p-4 border-b border-gray-200 last:border-0 hover:bg-gray-50 transition">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900">{{ $module->order }}. {{ $module->title }}</h4>
                        @if($module->description)
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($module->description, 150) }}</p>
                        @endif
                    </div>
                    <div class="flex space-x-2 ml-4">
                        <a href="{{ route('teacher.modules.edit', [$course, $module]) }}" class="text-orange hover:text-orange-light">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </a>
                        <form action="{{ route('teacher.modules.destroy', [$course, $module]) }}" method="POST" onsubmit="return confirm('Delete this module?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                    <p class="text-gray-500 mb-3">No modules added yet</p>
                    <a href="{{ route('teacher.modules.create', $course) }}" class="text-orange hover:text-orange-light font-medium">
                        Add your first module →
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Projects Tab -->
        <div x-show="tab === 'projects'">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-primary">Course Projects</h3>
                <a href="{{ route('teacher.projects.create', $course) }}" class="px-4 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Add Project
                </a>
            </div>

            @forelse($course->projects as $project)
                <div class="p-4 border-b border-gray-200 last:border-0 hover:bg-gray-50 transition flex items-start justify-between">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900">{{ $project->title }}</h4>
                        @if($project->description)
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 150) }}</p>
                        @endif
                    </div>
                    <div class="flex space-x-2 ml-4">
                        <a href="{{ route('teacher.projects.edit', [$course, $project]) }}" class="text-orange hover:text-orange-light">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </a>
                        <form action="{{ route('teacher.projects.destroy', [$course, $project]) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-gray-500 mb-3">No projects added yet</p>
                    <a href="{{ route('teacher.projects.create', $course) }}" class="text-orange hover:text-orange-light font-medium">
                        Add your first project →
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Students Tab -->
        <div x-show="tab === 'students'">
            <h3 class="text-lg font-bold text-primary mb-6">Enrolled Students</h3>

            @forelse($course->enrollments as $enrollment)
                <div class="flex items-center justify-between p-4 border-b border-gray-200 last:border-0 hover:bg-gray-50 transition">
                    <div class="flex items-center space-x-4 flex-1">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            @if($enrollment->student->avatar)
                                <img src="{{ Storage::url($enrollment->student->avatar) }}" alt="{{ $enrollment->student->name }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <span class="text-white font-bold">{{ substr($enrollment->student->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $enrollment->student->name }}</p>
                            <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <div class="flex items-center mb-1">
                                <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-orange h-2 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                                </div>
                                <span class="text-sm text-gray-600 font-medium">{{ $enrollment->progress }}%</span>
                            </div>
                            <p class="text-xs text-gray-400">{{ $enrollment->enrolled_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-600' : '' }}
                            {{ $enrollment->status == 'completed' ? 'bg-blue-100 text-blue-600' : '' }}
                            {{ $enrollment->status == 'suspended' ? 'bg-red-100 text-red-600' : '' }}
                        ">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <p class="text-gray-500">No students enrolled yet</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

@endsection
