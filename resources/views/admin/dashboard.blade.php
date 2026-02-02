@extends('components.admin-layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Total Students -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Students</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_students'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Teachers -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Teachers</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_teachers'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Courses -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Active Courses</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['active_courses'] }}</h3>
                <p class="text-xs text-gray-400 mt-1">of {{ $stats['total_courses'] }} total</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Enrollments -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Enrollments</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_enrollments'] }}</h3>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['completed_courses'] }} completed</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
    </div>

</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- Recent Enrollments -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Enrollments</h3>
        <div class="space-y-4">
            @forelse($recentEnrollments as $enrollment)
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($enrollment->student->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $enrollment->student->name }}</p>
                        <p class="text-sm text-gray-500">{{ $enrollment->course->title }}</p>
                    </div>
                </div>
                <span class="text-xs text-gray-400">{{ $enrollment->enrolled_at->diffForHumans() }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No enrollments yet</p>
            @endforelse
        </div>
    </div>

    <!-- Top Courses -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Top Courses by Enrollment</h3>
        <div class="space-y-4">
            @forelse($topCourses as $course)
            <div class="flex items-center justify-between border-b pb-3">
                <div>
                    <p class="font-medium text-gray-800">{{ $course->title }}</p>
                    <p class="text-sm text-gray-500">by {{ $course->teacher->name }}</p>
                </div>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $course->enrollments_count }} students
                </span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No courses yet</p>
            @endforelse
        </div>
    </div>

</div>

@endsection
