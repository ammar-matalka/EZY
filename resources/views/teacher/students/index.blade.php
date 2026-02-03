@extends('teacher.layouts.app')

@section('title', 'My Students')
@section('page-title', 'My Students')

@section('content')

<!-- Header -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-primary">My Students</h2>
    <p class="text-gray-600 mt-1">View and manage students enrolled in your courses</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- Total Students -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Students</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $stats['total'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Active</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['active'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Completed -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Completed</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['completed'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Avg Progress -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Avg Progress</p>
                <h3 class="text-3xl font-bold text-orange mt-2">{{ $stats['avg_progress'] }}%</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('teacher.students.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search Student -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Student</label>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Name or email..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
            >
        </div>

        <!-- Course Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Course</label>
            <select name="course_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex items-end space-x-2">
            <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-medium transition">
                Filter
            </button>
            <a href="{{ route('teacher.students.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium transition">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Students Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
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
                @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <!-- Student -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3">
                                    @if($enrollment->student->avatar)
                                        <img src="{{ Storage::url($enrollment->student->avatar) }}" alt="{{ $enrollment->student->name }}" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <span class="text-white font-bold text-sm">{{ substr($enrollment->student->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $enrollment->student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Course -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($enrollment->course->image)
                                    <img src="{{ Storage::url($enrollment->course->image) }}" alt="{{ $enrollment->course->title }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                                @else
                                    <div class="w-10 h-10 bg-orange rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ Str::limit($enrollment->course->title, 30) }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->course->modules->count() }} Modules</p>
                                </div>
                            </div>
                        </td>

                        <!-- Progress -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2 mr-2" style="width: 100px;">
                                    <div class="h-2 rounded-full transition-all
                                        {{ $enrollment->progress < 30 ? 'bg-red-500' : '' }}
                                        {{ $enrollment->progress >= 30 && $enrollment->progress < 70 ? 'bg-yellow-500' : '' }}
                                        {{ $enrollment->progress >= 70 ? 'bg-green-500' : '' }}
                                    " style="width: {{ $enrollment->progress }}%"></div>
                                </div>
                                <span class="text-sm text-gray-600 font-medium">{{ $enrollment->progress }}%</span>
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-600' : '' }}
                                {{ $enrollment->status == 'completed' ? 'bg-blue-100 text-blue-600' : '' }}
                                {{ $enrollment->status == 'suspended' ? 'bg-red-100 text-red-600' : '' }}
                            ">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>

                        <!-- Enrolled At -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $enrollment->enrolled_at->format('Y-m-d') }}
                            <p class="text-xs text-gray-400">{{ $enrollment->enrolled_at->diffForHumans() }}</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No students found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($enrollments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $enrollments->links() }}
        </div>
    @endif
</div>

@endsection
