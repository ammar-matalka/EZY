@extends('admin.layouts.app')

@section('title', 'Edit Plan')
@section('page-title', 'Edit Plan')

@section('content')

<div class="max-w-4xl">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.plans.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Back to Plans
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-primary mb-6">Edit Plan: {{ $plan->name }}</h2>

        <form action="{{ route('admin.plans.update', $plan) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Plan Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Plan Name <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $plan->name) }}"
                    required
                    placeholder="e.g., Basic, Pro, Premium"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea
                    name="description"
                    rows="3"
                    placeholder="Brief description of this plan..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('description') border-red-500 @enderror"
                >{{ old('description', $plan->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price & Duration -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Price (USD) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-500">$</span>
                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', $plan->price) }}"
                            required
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('price') border-red-500 @enderror"
                        >
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Duration (Days) <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="number"
                        name="duration_days"
                        value="{{ old('duration_days', $plan->duration_days) }}"
                        required
                        min="1"
                        placeholder="e.g., 30, 90, 365"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('duration_days') border-red-500 @enderror"
                    >
                    <p class="text-xs text-gray-500 mt-1">Common: 30 (monthly), 90 (quarterly), 365 (yearly)</p>
                    @error('duration_days')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Courses Limit -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Courses Limit <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    name="courses_limit"
                    value="{{ old('courses_limit', $plan->courses_limit) }}"
                    required
                    min="1"
                    placeholder="e.g., 1, 5, 10, 999"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('courses_limit') border-red-500 @enderror"
                >
                <p class="text-xs text-gray-500 mt-1">Maximum number of courses a student can enroll in with this plan</p>
                @error('courses_limit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Popular -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        name="is_popular"
                        value="1"
                        {{ old('is_popular', $plan->is_popular) ? 'checked' : '' }}
                        class="w-4 h-4 text-orange border-gray-300 rounded focus:ring-2 focus:ring-orange"
                    >
                    <span class="ml-2 text-sm font-medium text-gray-700">
                        Mark as Popular Plan
                    </span>
                </label>
                <p class="text-xs text-gray-500 mt-1 ml-6">This plan will be highlighted on the pricing page</p>
            </div>

            <!-- Active Subscriptions Warning -->
            @if($plan->subscriptions->where('status', 'active')->count() > 0)
                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-yellow-800 mb-1">Active Subscriptions Warning</h4>
                            <p class="text-sm text-yellow-700">
                                This plan has <strong>{{ $plan->subscriptions->where('status', 'active')->count() }} active subscriptions</strong>.
                                Changing the price or courses limit will not affect existing subscriptions, only new ones.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Preview Card -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6 border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Preview</h3>
                <div class="bg-white rounded-lg shadow-md p-6 max-w-sm">
                    <div class="text-center mb-4">
                        <h4 class="text-xl font-bold text-primary mb-2" id="preview-name">{{ $plan->name }}</h4>
                        <div class="text-3xl font-bold text-orange">
                            $<span id="preview-price">{{ $plan->price }}</span>
                            <span class="text-sm text-gray-600 font-normal">/ <span id="preview-duration">{{ $plan->duration_days }}</span> days</span>
                        </div>
                        <p class="text-gray-600 text-sm mt-1"><span id="preview-courses">{{ $plan->courses_limit }}</span> Courses Limit</p>
                    </div>
                    <p class="text-gray-600 text-sm" id="preview-description">{{ $plan->description ?? 'Plan description will appear here...' }}</p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.plans.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
                    Update Plan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Live Preview
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="name"]');
        const priceInput = document.querySelector('input[name="price"]');
        const durationInput = document.querySelector('input[name="duration_days"]');
        const coursesInput = document.querySelector('input[name="courses_limit"]');
        const descriptionInput = document.querySelector('textarea[name="description"]');

        function updatePreview() {
            document.getElementById('preview-name').textContent = nameInput.value || 'Plan Name';
            document.getElementById('preview-price').textContent = priceInput.value || '0.00';
            document.getElementById('preview-duration').textContent = durationInput.value || '0';
            document.getElementById('preview-courses').textContent = coursesInput.value || '0';
            document.getElementById('preview-description').textContent = descriptionInput.value || 'Plan description will appear here...';
        }

        nameInput.addEventListener('input', updatePreview);
        priceInput.addEventListener('input', updatePreview);
        durationInput.addEventListener('input', updatePreview);
        coursesInput.addEventListener('input', updatePreview);
        descriptionInput.addEventListener('input', updatePreview);
    });
</script>
@endpush
