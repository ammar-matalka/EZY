@extends('layouts.app')

@section('title', 'My Courses')

@section('content')

<!-- Header Section -->
<div class="bg-gradient-to-r from-[#003F7D] to-[#0056a8] w-full pt-28 pb-12 px-4">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
            My <span class="text-orange-400">Courses</span>
        </h1>
        <p class="text-blue-100">Your enrolled courses and learning progress</p>
    </div>
</div>

<!-- Subscription Info Card -->
<div class="max-w-7xl mx-auto px-4 -mt-6">
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <!-- Plan Info -->
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Current Plan</p>
                    <p class="text-xl font-bold text-[#003F7D]">{{ $subscription->plan->name }}</p>
                </div>
            </div>

            <!-- Usage Stats -->
            <div class="flex items-center gap-8">
                <div class="text-center">
                    <p class="text-3xl font-bold text-orange-500">{{ $subscription->courses_selected }}</p>
                    <p class="text-sm text-gray-500">Courses Enrolled</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-400">{{ $subscription->remainingSlots() }}</p>
                    <p class="text-sm text-gray-500">Slots Remaining</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-800">{{ $subscription->expires_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">Expires</p>
                </div>
            </div>

            <!-- Add More Button -->
            @if($subscription->remainingSlots() > 0)
                <a href="{{ route('subscription.select-courses') }}"
                   class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all">
                    <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add More Courses
                </a>
            @endif
        </div>
    </div>
</div>

<!-- Courses Grid -->
<div class="max-w-7xl mx-auto px-4 pb-16">

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($courses as $course)
                <!-- Course Card -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 group">

                    <!-- Course Image -->
                    <div class="relative h-40 bg-gradient-to-br from-blue-800 to-blue-900">
                        @if($course->image)
                            <img src="{{ Storage::url($course->image) }}"
                                 alt="{{ $course->title }}"
                                 class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="flex items-center justify-center h-full">
                                <span class="text-6xl font-bold text-white/30">
                                    {{ substr($course->title, 0, 1) }}
                                </span>
                            </div>
                        @endif

                        <!-- Enrolled Badge -->
                        <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            ✓ Enrolled
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-orange-500 transition-colors">
                            {{ $course->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $course->description }}
                        </p>

                        <!-- Progress (optional) -->
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1">
                                <span>Progress</span>
                                <span>0%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-orange-500 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('courses.show', $course) }}"
                           class="block w-full py-3 bg-[#003F7D] hover:bg-[#002d5a] text-white text-center font-bold rounded-xl transition-all">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Start Learning
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow">
            <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Courses Yet</h3>
            <p class="text-gray-500 mb-8">You haven't selected any courses from your plan yet.</p>
            <a href="{{ route('subscription.select-courses') }}"
               class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Select Your Courses
            </a>
        </div>
    @endif
</div>

@endsection
