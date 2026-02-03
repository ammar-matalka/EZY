@extends('teacher.layouts.app')

@section('title', 'Teacher Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome Section -->
<div class="bg-gradient-to-r from-primary to-primary-dark text-white rounded-lg shadow-md p-8 mb-6">
    <h2 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h2>
    <p class="text-gray-200">Here's what's happening with your courses today</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    <!-- Total Courses -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">My Courses</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $stats['courses'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 font-medium">{{ $stats['opened_courses'] }} Opened</span>
        </div>
    </div>

    <!-- Total Students -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Students</p>
                <h3 class="text-3xl font-bold text-orange mt-2">{{ $stats['students'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-600">Across all courses</span>
        </div>
    </div>

    <!-- Total Modules -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Modules</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['modules'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-600">Course content</span>
        </div>
    </div>

    <!-- Total Projects -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                <h3 class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['projects'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-600">Assignments</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- My Courses -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-bold text-primary">My Courses</h2>
            <a href="{{ route('teacher.courses.index') }}" class="text-sm text-orange hover:text-orange-light font-medium">
                View All →
            </a>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentCourses as $course)
                    <div class="flex items-start justify-between p-4 border border-gray-200 rounded-lg hover:border-orange transition">
                        <div class="flex items-start space-x-3 flex-1">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-12 h-12 rounded-lg object-cover">
                            @else
                                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
                                <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                    <span>{{ $course->modules->count() }} Modules</span>
                                    <span>{{ $course->enrollments->count() }} Students</span>
                                </div>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $course->status == 'opened' ? 'bg-green-100 text-green-600' : '' }}
                            {{ $course->status == 'coming_soon' ? 'bg-yellow-100 text-yellow-600' : '' }}
                            {{ $course->status == 'archived' ? 'bg-gray-100 text-gray-600' : '' }}
                        ">
                            {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                        <p class="text-gray-500 mb-3">No courses yet</p>
                        <a href="{{ route('teacher.courses.create') }}" class="text-orange hover:text-orange-light font-medium text-sm">
                            Create your first course →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Students -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-bold text-primary">Recent Students</h2>
            <a href="{{ route('teacher.students.index') }}" class="text-sm text-orange hover:text-orange-light font-medium">
                View All →
            </a>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentStudents as $enrollment)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                @if($enrollment->student->avatar)
                                    <img src="{{ Storage::url($enrollment->student->avatar) }}" alt="{{ $enrollment->student->name }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-white font-bold text-sm">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $enrollment->student->name }}</p>
                                <p class="text-xs text-gray-500">{{ Str::limit($enrollment->course->title, 30) }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center mb-1">
                                <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-orange h-2 rounded-full" style="width: {{ $enrollment->progress }}%"></div>
                                </div>
                                <span class="text-xs text-gray-600">{{ $enrollment->progress }}%</span>
                            </div>
                            <p class="text-xs text-gray-400">{{ $enrollment->enrolled_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        <p class="text-gray-500">No students enrolled yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
