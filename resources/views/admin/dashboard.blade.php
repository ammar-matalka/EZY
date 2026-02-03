@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    <!-- Total Students -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Students</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $stats['students'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 font-medium">Active</span>
        </div>
    </div>

    <!-- Total Teachers -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Teachers</p>
                <h3 class="text-3xl font-bold text-orange mt-2">{{ $stats['teachers'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 font-medium">Instructors</span>
        </div>
    </div>

    <!-- Total Courses -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Courses</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $stats['courses'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-500">{{ $stats['opened_courses'] }} Opened</span>
        </div>
    </div>

    <!-- Total Enrollments -->
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Enrollments</p>
                <h3 class="text-3xl font-bold text-orange mt-2">{{ $stats['enrollments'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 font-medium">Active</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-primary">Recent Users</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentUsers as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                @if($user->avatar)
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-white font-bold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : '' }}
                            {{ $user->role == 'teacher' ? 'bg-orange-100 text-orange-600' : '' }}
                            {{ $user->role == 'student' ? 'bg-blue-100 text-blue-600' : '' }}
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No recent users</p>
                @endforelse
            </div>

            @if($recentUsers->count() > 0)
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.users.index') }}" class="text-primary hover:text-orange font-medium text-sm">
                        View All Users →
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Courses -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-primary">Recent Courses</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentCourses as $course)
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $course->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1">
                                by {{ $course->teacher->name }}
                            </p>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="text-xs text-gray-500">
                                    {{ $course->modules->count() }} Modules
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $course->enrollments->count() }} Students
                                </span>
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
                    <p class="text-gray-500 text-center py-4">No recent courses</p>
                @endforelse
            </div>

            @if($recentCourses->count() > 0)
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.courses.index') }}" class="text-primary hover:text-orange font-medium text-sm">
                        View All Courses →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Recent Enrollments -->
<div class="bg-white rounded-lg shadow-md mt-6">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-bold text-primary">Recent Enrollments</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recentEnrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-bold text-xs">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $enrollment->student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-900">{{ $enrollment->course->title }}</p>
                            <p class="text-xs text-gray-500">by {{ $enrollment->course->teacher->name }}</p>
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
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No recent enrollments
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($recentEnrollments->count() > 0)
        <div class="p-4 border-t border-gray-200 text-center">
            <a href="{{ route('admin.enrollments.index') }}" class="text-primary hover:text-orange font-medium text-sm">
                View All Enrollments →
            </a>
        </div>
    @endif
</div>

@endsection
