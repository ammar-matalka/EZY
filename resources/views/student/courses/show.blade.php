@extends('components.student-layout')

@section('title', $course->title)
@section('page-title', 'Course Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Course Header -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2">

            <!-- Course Image -->
            <div class="h-96 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                @if($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                @endif
            </div>

            <!-- Course Info -->
            <div class="p-8">

                <!-- Category & Level -->
                <div class="flex items-center gap-2 mb-4">
                    @if($course->category)
                        <span class="bg-blue-100 text-blue-800 text-sm px-4 py-1 rounded-full font-semibold">{{ $course->category }}</span>
                    @endif
                    <span class="bg-gray-100 text-gray-800 text-sm px-4 py-1 rounded-full">{{ ucfirst($course->level) }}</span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $course->title }}</h1>

                <!-- Teacher -->
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($course->teacher->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold text-gray-800">{{ $course->teacher->name }}</p>
                        @if($course->teacher->expertise)
                            <p class="text-sm text-gray-600">{{ $course->teacher->expertise }}</p>
                        @endif
                    </div>
                </div>

                <!-- Stats -->
                <div class="flex items-center gap-6 mb-6 text-gray-600">
                    @if($course->duration)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $course->duration }} hours
                        </div>
                    @endif
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        {{ $course->enrollments_count ?? 0 }} students
                    </div>
                </div>

                <!-- Enroll Button -->
                @if($isEnrolled)
                    <a href="{{ route('student.my-courses') }}" class="inline-block w-full text-center px-8 py-4 bg-green-600 text-white rounded-lg font-semibold">
                        ✓ Enrolled - Go to My Courses
                    </a>
                @elseif($canEnroll)
                    <form action="{{ route('student.enroll', $course) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-lg">
                            Enroll Now
                        </button>
                    </form>
                @else
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-6 py-4 rounded-lg">
                        <p class="font-semibold mb-2">⚠️ Enrollment Limit Reached</p>
                        <p class="text-sm">You've reached your plan limit. Please upgrade your subscription to enroll in more courses.</p>
                        <a href="{{ route('student.plans.choose') }}" class="inline-block mt-3 text-blue-600 hover:text-blue-800 font-semibold">
                            Upgrade Plan →
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Course Description</h2>
        <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
    </div>

    <!-- Modules -->
    @if($course->modules->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Course Content</h2>
        <div class="space-y-4">
            @foreach($course->modules as $module)
            <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-4">
                            {{ $module->order }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $module->title }}</h3>
                            @if($module->description)
                                <p class="text-sm text-gray-600 mt-1">{{ $module->description }}</p>
                            @endif
                        </div>
                    </div>
                    @if($module->duration)
                        <span class="text-sm text-gray-500">{{ $module->formatted_duration }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Projects -->
    @if($course->projects->count() > 0)
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Course Projects</h2>
        <div class="space-y-4">
            @foreach($course->projects as $project)
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $project->title }}</h3>
                <p class="text-gray-700 mb-3">{{ $project->description }}</p>
                @if($project->requirements)
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm font-semibold text-blue-800 mb-2">Requirements:</p>
                        <p class="text-sm text-gray-700">{{ $project->requirements }}</p>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@endsection
