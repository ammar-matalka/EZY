@extends('layouts.app')

@section('title', 'Courses')

@section('content')

@php
    $hasSubscription = auth()->check() && auth()->user()->hasActiveSubscription();
    $subscription = $hasSubscription ? auth()->user()->activeSubscription : null;
    $selectedCourseIds = $subscription ? $subscription->courses()->pluck('courses.id')->toArray() : [];
@endphp

<!-- Subscription Status Bar (Only for subscribers) -->
@if($hasSubscription)
<div class="sticky top-0 z-40 bg-gradient-to-r from-[#003F7D] to-[#0056a8] shadow-lg"
     x-data="courseSelector({
         limit: {{ $subscription->courses_limit }},
         selected: {{ $subscription->courses_selected }},
         selectedIds: {{ json_encode($selectedCourseIds) }}
     })">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <!-- Progress Info -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                        <span class="text-lg font-bold text-white" x-text="selected"></span>
                    </div>
                    <div class="text-white">
                        <p class="text-xs text-white/70">Enrolled</p>
                        <p class="font-semibold text-sm">
                            <span x-text="selected"></span> / <span x-text="limit"></span> Courses
                        </p>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="hidden md:block w-32">
                    <div class="h-2 bg-white/20 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full transition-all duration-300"
                             :style="`width: ${(selected / limit) * 100}%`"></div>
                    </div>
                </div>
            </div>

            <!-- Plan Badge & My Courses Link -->
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-orange-500 text-white text-xs font-bold rounded-full">
                    {{ $subscription->plan->name }}
                </span>
                <a href="{{ route('my-courses') }}" class="text-white/80 hover:text-white text-sm font-medium flex items-center gap-1">
                    My Courses
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div x-show="showModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
         @click.self="showModal = false">

        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Confirm Enrollment</h3>

            <p class="text-gray-600 text-center mb-2">Are you sure you want to enroll in:</p>
            <p class="text-lg font-bold text-[#003F7D] text-center mb-4" x-text="selectedCourseName"></p>

            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-6">
                <p class="text-amber-700 text-sm text-center">
                    ⚠️ <strong>Warning:</strong> This action cannot be undone.
                </p>
            </div>

            <div class="flex gap-3">
                <button @click="showModal = false"
                        class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all">
                    Cancel
                </button>
                <button @click="confirmEnroll()"
                        :disabled="loading"
                        class="flex-1 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all disabled:opacity-50">
                    <span x-show="!loading">Yes, Enroll</span>
                    <span x-show="loading">
                        <svg class="animate-spin h-5 w-5 inline" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div x-show="toast.show"
         x-transition
         class="fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50"
         :class="toast.type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'">
        <p x-text="toast.message"></p>
    </div>
</div>
@endif

<!-- Search & Filters Section -->
<div class="bg-white py-8 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <!-- Search Bar -->
            <div class="w-full md:w-80">
                <form method="GET" action="{{ route('courses.index') }}">
                    <div class="relative rounded-xl bg-gray-100">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search The Course Here"
                               class="w-full pl-10 pr-4 py-2.5 bg-transparent rounded-xl text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-0 text-sm">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Status Tabs -->
            <div class="flex space-x-8 border-b-2 border-transparent">
                <a href="{{ route('courses.index') }}"
                   class="pb-2 font-medium text-sm {{ !request('status') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                    All
                </a>
                <a href="{{ route('courses.index', ['status' => 'opened']) }}"
                   class="pb-2 font-medium text-sm {{ request('status') == 'opened' ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                    Opened
                </a>
                <a href="{{ route('courses.index', ['status' => 'coming_soon']) }}"
                   class="pb-2 font-medium text-sm {{ request('status') == 'coming_soon' ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                    Coming Soon
                </a>
                <a href="{{ route('courses.index', ['status' => 'archived']) }}"
                   class="pb-2 font-medium text-sm {{ request('status') == 'archived' ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                    Archived
                </a>
            </div>

            <!-- Sort Dropdown -->
            <div class="w-full md:w-auto">
                <form method="GET" action="{{ route('courses.index') }}" id="sortForm">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="sort" onchange="document.getElementById('sortForm').submit()"
                            class="w-full md:w-48 px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 text-sm focus:outline-none focus:border-gray-400 cursor-pointer">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Sort by: Popular Class</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Sort by: Newest</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Sort by: Oldest</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by: Name A-Z</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Courses Grid Section -->
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
                 x-data="{ show: false }"
                 x-init="setTimeout(() => show = true, 100)">

                @foreach($courses as $index => $course)
                    <div x-show="show"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-5"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="transition-delay: {{ $index * 50 }}ms;">

                        <div class="block relative pb-40 group">

                            <!-- Blue Background Section -->
                            <div class="h-72 bg-gradient-to-br from-blue-800 to-blue-900 rounded-2xl relative transition-transform group-hover:scale-105 duration-300"
                                 @if($hasSubscription)
                                 :class="{ 'ring-4 ring-green-500': isEnrolled({{ $course->id }}) }"
                                 @endif>

                                <!-- Course Image/Logo -->
                                <div class="absolute top-6 left-1/2 transform -translate-x-1/2" style="width: 120px; height: 120px;">
                                    @if($course->image)
                                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-contain">
                                    @else
                                        <div class="text-cyan-300 text-6xl font-bold text-center">
                                            {{ substr($course->title, 0, 1) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Enrolled Badge -->
                                @if($hasSubscription)
                                <div x-show="isEnrolled({{ $course->id }})"
                                     class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Enrolled
                                </div>
                                @endif
                            </div>

                            <!-- White Overlapping Card -->
                            <div class="absolute left-4 right-4 bg-white rounded-xl shadow-lg p-4 group-hover:shadow-2xl transition-shadow" style="top: 11rem;">

                                <h3 class="text-lg font-black text-gray-900 mb-2 text-center group-hover:text-orange-500 transition-colors">
                                    {{ Str::limit($course->title, 20) }}
                                </h3>

                                <p class="text-xs text-gray-700 mb-3 text-center leading-snug px-1" style="height: 2.5rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $course->description }}
                                </p>

                                <!-- Action Buttons Based on User State -->
                                <div class="flex flex-col gap-2">

                                    @guest
                                        <!-- Not Logged In -->
                                        <a href="{{ route('login') }}"
                                           class="w-full flex items-center justify-center px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full font-semibold transition text-xs shadow-md">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                            </svg>
                                            Login to Enroll
                                        </a>
                                    @else
                                        @if($hasSubscription)
                                            <!-- Has Subscription -->
                                            <template x-if="isEnrolled({{ $course->id }})">
                                                <a href="{{ route('courses.show', $course) }}"
                                                   class="w-full flex items-center justify-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-full font-semibold transition text-xs shadow-md">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Start Learning
                                                </a>
                                            </template>

                                            <template x-if="!isEnrolled({{ $course->id }})">
                                                <button @click="openModal({{ $course->id }}, '{{ addslashes($course->title) }}')"
                                                        :disabled="remaining === 0"
                                                        class="w-full flex items-center justify-center px-3 py-2 rounded-full font-semibold transition text-xs shadow-md"
                                                        :class="remaining === 0
                                                            ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                                            : 'bg-orange-500 hover:bg-orange-600 text-white'">
                                                    <span x-show="remaining > 0">
                                                        <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                        </svg>
                                                        Enroll Now
                                                    </span>
                                                    <span x-show="remaining === 0">🔒 Limit Reached</span>
                                                </button>
                                            </template>
                                        @else
                                            <!-- No Subscription -->
                                            <a href="{{ route('pricing') }}"
                                               class="w-full flex items-center justify-center px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-full font-semibold transition text-xs shadow-md">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                Subscribe to Enroll
                                            </a>
                                        @endif
                                    @endguest

                                    <!-- View Details (Always visible) -->
                                    <a href="{{ route('courses.show', $course) }}"
                                       class="w-full flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full font-semibold transition text-xs">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-24 text-center"
                 x-data="{ show: false }"
                 x-init="setTimeout(() => show = true, 100)"
                 x-show="show"
                 x-transition>

                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Courses Found</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-8">
                    We couldn't find any courses matching your filters.
                </p>

                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium transition shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset Filters
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $courses->links() }}
            </div>
        @endif

    </div>
</div>

@endsection

@if($hasSubscription)
@push('scripts')
<script>
function courseSelector(config) {
    return {
        limit: config.limit,
        selected: config.selected,
        selectedIds: config.selectedIds,
        loading: false,
        showModal: false,
        pendingCourseId: null,
        selectedCourseName: '',
        toast: { show: false, message: '', type: 'success' },

        get remaining() {
            return Math.max(0, this.limit - this.selected);
        },

        isEnrolled(courseId) {
            return this.selectedIds.includes(courseId);
        },

        openModal(courseId, courseName) {
            if (this.remaining === 0) {
                this.showToast('You have reached your course limit!', 'error');
                return;
            }
            this.pendingCourseId = courseId;
            this.selectedCourseName = courseName;
            this.showModal = true;
        },

        async confirmEnroll() {
            if (this.loading || !this.pendingCourseId) return;
            this.loading = true;

            try {
                const response = await fetch(`/subscription/add-course/${this.pendingCourseId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.selectedIds.push(this.pendingCourseId);
                    this.selected = data.selected;
                    this.showModal = false;
                    this.showToast('🎉 ' + data.message, 'success');

                    // Reload to update UI
                    setTimeout(() => location.reload(), 1500);
                } else {
                    this.showToast(data.message, 'error');
                }
            } catch (error) {
                this.showToast('Something went wrong. Please try again.', 'error');
            } finally {
                this.loading = false;
                this.pendingCourseId = null;
            }
        },

        showToast(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => this.toast.show = false, 3000);
        }
    }
}
</script>
@endpush
@endif
