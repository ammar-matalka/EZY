@extends('teacher.layouts.app')

@section('title', 'My Courses')
@section('page-title', 'My Courses')

@section('content')

<!-- Header with Add Button -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">My Courses</h2>
        <p class="text-gray-600 mt-1">Manage your courses and content</p>
    </div>
    <a href="{{ route('teacher.courses.create') }}" class="bg-orange hover:bg-orange-light text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Create New Course
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('teacher.courses.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Course title..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
            >
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Status</option>
                <option value="opened" {{ request('status') == 'opened' ? 'selected' : '' }}>Opened</option>
                <option value="coming_soon" {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

        <!-- Level Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
            <select name="level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Levels</option>
                <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                <option value="advanced" {{ request('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex items-end space-x-2">
            <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-medium transition">
                Filter
            </button>
            <a href="{{ route('teacher.courses.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Courses Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <!-- Course Image -->
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover hover:scale-105 transition duration-300">
                @else
                    <div class="w-full h-full bg-primary flex items-center justify-center">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Course Content -->
            <div class="p-6">
                <!-- Status & Level Badges -->
                <div class="flex items-center justify-between mb-3">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $course->status == 'opened' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $course->status == 'coming_soon' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $course->status == 'archived' ? 'bg-gray-100 text-gray-600' : '' }}
                    ">
                        {{ ucfirst(str_replace('_', ' ', $course->status)) }}
                    </span>

                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        {{ $course->level == 'beginner' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $course->level == 'intermediate' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $course->level == 'advanced' ? 'bg-red-100 text-red-600' : '' }}
                    ">
                        {{ ucfirst($course->level) }}
                    </span>
                </div>

                <!-- Title -->
                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $course->title }}</h3>

                <!-- Description -->
                <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $course->description }}</p>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mb-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-primary">{{ $course->modules->count() }}</p>
                        <p class="text-xs text-gray-500">Modules</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-orange">{{ $course->projects->count() }}</p>
                        <p class="text-xs text-gray-500">Projects</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-green-600">{{ $course->enrollments->count() }}</p>
                        <p class="text-xs text-gray-500">Students</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('teacher.courses.show', $course) }}" class="flex-1 px-4 py-2 bg-primary hover:bg-primary-dark text-white text-center rounded-lg font-medium transition text-sm">
                        Manage
                    </a>
                    <a href="{{ route('teacher.courses.edit', $course) }}" class="px-4 py-2 bg-orange-100 hover:bg-orange-200 text-orange rounded-lg font-medium transition text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </a>
                    <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this course?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg font-medium transition text-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-3 bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
            <p class="text-gray-500 mb-4">No courses found</p>
            <a href="{{ route('teacher.courses.create') }}" class="text-orange hover:text-orange-light font-medium">
                Create your first course →
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($courses->hasPages())
    <div class="mt-6">
        {{ $courses->links() }}
    </div>
@endif

@endsection
