@extends('layouts.app')

@section('title', 'Select Your Courses')

@section('content')

@php
    $selectedCourseIds = $subscription->courses()->pluck('courses.id')->toArray();
    $remaining = $subscription->courses_limit - $subscription->courses_selected;
@endphp

<!-- Header Section -->
<div class="bg-gradient-to-r from-[#003F7D] to-[#0056a8] w-full pt-28 pb-8 px-4">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
            Select Your <span class="text-orange-400">Courses</span>
        </h1>
        <p class="text-blue-100">Choose your courses carefully - selections are permanent</p>
    </div>
</div>

<!-- Selection Status Bar (Sticky) -->
<div class="sticky top-0 z-40 bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <!-- Progress Info -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                        <span class="text-xl font-bold text-orange-600" id="selectedCount">{{ $subscription->courses_selected }}</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Enrolled</p>
                        <p class="font-semibold text-gray-800">
                            <span id="selectedText">{{ $subscription->courses_selected }}</span> / {{ $subscription->courses_limit }} Courses
                        </p>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="hidden md:block w-48">
                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full transition-all duration-300"
                             id="progressBar"
                             style="width: {{ ($subscription->courses_selected / $subscription->courses_limit) * 100 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <span id="remainingSlots">{{ $remaining }}</span> slots remaining
                    </p>
                </div>
            </div>

            <!-- Warning Notice -->
            <div class="hidden md:flex items-center gap-2 text-amber-600 bg-amber-50 px-4 py-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-sm font-medium">Selections are permanent</span>
            </div>

            <!-- Plan Info & My Courses -->
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm text-gray-500">Your Plan</p>
                    <p class="font-bold text-[#003F7D]">{{ $subscription->plan->name }}</p>
                </div>

                <a href="{{ route('my-courses') }}"
                   class="px-6 py-3 bg-[#003F7D] hover:bg-[#002d5a] text-white font-bold rounded-xl transition-all">
                    My Courses
                    <svg class="w-5 h-5 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="enrollModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">

        <!-- Warning Icon -->
        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Confirm Enrollment</h3>

        <p class="text-gray-600 text-center mb-2">Are you sure you want to enroll in:</p>
        <p class="text-lg font-bold text-[#003F7D] text-center mb-4" id="modalCourseName"></p>

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 mb-6">
            <p class="text-amber-700 text-sm text-center">
                ⚠️ <strong>Warning:</strong> This action cannot be undone. Once enrolled, you cannot remove this course.
            </p>
        </div>

        <div class="flex gap-3">
            <button onclick="closeModal()"
                    class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all">
                Cancel
            </button>
            <button onclick="confirmEnroll()"
                    id="confirmBtn"
                    class="flex-1 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all">
                Yes, Enroll
            </button>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 hidden">
    <p id="toastMessage"></p>
</div>

<!-- Search & Filters -->
<div class="bg-white py-6 border-b">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            <!-- Search -->
            <div class="w-full md:w-80">
                <form method="GET" action="{{ route('subscription.select-courses') }}">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search courses..."
                               class="w-full pl-10 pr-4 py-2.5 bg-gray-100 rounded-xl text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-300">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Status Tabs -->
            <div class="flex space-x-6">
                <a href="{{ route('subscription.select-courses') }}"
                   class="pb-2 font-medium text-sm {{ !request('status') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                    All Courses
                </a>
                <a href="{{ route('subscription.select-courses', ['status' => 'opened']) }}"
                   class="pb-2 font-medium text-sm {{ request('status') == 'opened' ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                    Available
                </a>
            </div>

            <!-- Sort -->
            <form method="GET" action="{{ route('subscription.select-courses') }}" id="sortForm">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="sort" onchange="this.form.submit()"
                        class="px-3 py-2 bg-white border rounded-lg text-gray-700 text-sm focus:outline-none cursor-pointer">
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                </select>
            </form>
        </div>
    </div>
</div>

<!-- Courses Grid -->
<div class="bg-gray-50 py-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach($courses as $course)
                    @php
                        $isEnrolled = in_array($course->id, $selectedCourseIds);
                    @endphp

                    <div class="course-card">
                        <!-- Card Content -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl {{ $isEnrolled ? 'ring-2 ring-green-500 bg-green-50' : '' }}">

                            <!-- Course Image -->
                            <div class="relative h-40 bg-gradient-to-br from-blue-800 to-blue-900">
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}"
                                         alt="{{ $course->title }}"
                                         class="w-full h-full object-cover opacity-80">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <span class="text-6xl font-bold text-white/30">
                                            {{ substr($course->title, 0, 1) }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Enrolled Badge -->
                                @if($isEnrolled)
                                    <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Enrolled
                                    </div>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-1">
                                    {{ $course->title }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ $course->description }}
                                </p>

                                <div class="flex flex-col gap-2">
                                    @if($isEnrolled)
                                        {{-- Enrolled - Show Start Learning Button --}}
                                        <a href="{{ route('courses.show', $course) }}"
                                           class="block w-full py-3 bg-green-500 hover:bg-green-600 text-white text-center font-bold rounded-xl transition-all">
                                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Start Learning
                                        </a>
                                    @elseif($remaining > 0)
                                        {{-- Not Enrolled & Has Slots - Show Enroll Button --}}
                                        <button onclick="openModal({{ $course->id }}, '{{ addslashes($course->title) }}')"
                                                class="w-full py-3 rounded-xl font-bold text-sm transition-all duration-200 bg-orange-500 hover:bg-orange-600 text-white">
                                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Enroll Now
                                        </button>
                                    @else
                                        {{-- No Slots Remaining --}}
                                        <button disabled
                                                class="w-full py-3 rounded-xl font-bold text-sm bg-gray-200 text-gray-400 cursor-not-allowed">
                                            🔒 Limit Reached
                                        </button>
                                    @endif

                                    {{-- View Details - Always Visible --}}
                                    <a href="{{ route('courses.show', $course) }}"
                                       class="block w-full py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-center font-semibold rounded-xl transition-all text-sm">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $courses->links() }}
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Courses Found</h3>
                <p class="text-gray-500">Try adjusting your filters</p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Store data
    let pendingCourseId = null;
    let pendingCourseName = '';

    // Open modal
    function openModal(courseId, courseName) {
        pendingCourseId = courseId;
        pendingCourseName = courseName;
        document.getElementById('modalCourseName').textContent = courseName;
        document.getElementById('enrollModal').classList.remove('hidden');
        document.getElementById('enrollModal').classList.add('flex');
    }

    // Close modal
    function closeModal() {
        document.getElementById('enrollModal').classList.add('hidden');
        document.getElementById('enrollModal').classList.remove('flex');
        pendingCourseId = null;
        pendingCourseName = '';
    }

    // Close modal when clicking outside
    document.getElementById('enrollModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Confirm enrollment
    async function confirmEnroll() {
        if (!pendingCourseId) return;

        const btn = document.getElementById('confirmBtn');
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (!csrfToken) {
                showToast('CSRF token not found!', 'error');
                btn.disabled = false;
                btn.textContent = 'Yes, Enroll';
                return;
            }

            const response = await fetch('/subscription/add-course/' + pendingCourseId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            });

            const data = await response.json();

            if (data.success) {
                showToast('🎉 ' + data.message, 'success');
                closeModal();
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showToast(data.message, 'error');
                btn.disabled = false;
                btn.textContent = 'Yes, Enroll';
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Something went wrong. Please try again.', 'error');
            btn.disabled = false;
            btn.textContent = 'Yes, Enroll';
        }
    }

    // Show toast notification
    function showToast(message, type) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');

        toast.className = 'fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50';
        toast.classList.add(type === 'success' ? 'bg-green-500' : 'bg-red-500', 'text-white');
        toastMessage.textContent = message;

        toast.classList.remove('hidden');

        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }
</script>
@endpush
