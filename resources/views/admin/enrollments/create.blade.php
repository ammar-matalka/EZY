@extends('admin.layouts.app')

@section('title', 'Create Course')
@section('page-title', 'Create New Course')

@section('content')

<div class="max-w-4xl">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.courses.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Back to Courses
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-primary mb-6">Course Information</h2>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Teacher Selection -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Teacher <span class="text-red-500">*</span>
                </label>
                <select name="user_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('user_id') border-red-500 @enderror">
                    <option value="">Select Teacher</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} ({{ $teacher->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Course Title -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Course Title <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="e.g., Advanced React Development"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('title') border-red-500 @enderror"
                >
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="description"
                    rows="5"
                    required
                    placeholder="Describe what students will learn in this course..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('description') border-red-500 @enderror"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>
                <input
                    type="text"
                    name="category"
                    value="{{ old('category') }}"
                    placeholder="e.g., Programming, Design, Marketing"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('category') border-red-500 @enderror"
                >
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Level & Duration -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Level <span class="text-red-500">*</span>
                    </label>
                    <select name="level" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('level') border-red-500 @enderror">
                        <option value="">Select Level</option>
                        <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('level')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Duration (hours)
                    </label>
                    <input
                        type="number"
                        name="duration"
                        value="{{ old('duration') }}"
                        min="1"
                        placeholder="e.g., 40"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('duration') border-red-500 @enderror"
                    >
                    @error('duration')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('status') border-red-500 @enderror">
                    <option value="opened" {{ old('status') == 'opened' ? 'selected' : '' }}>Opened</option>
                    <option value="coming_soon" {{ old('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Course Image -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Course Image
                </label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('image') border-red-500 @enderror"
                >
                <p class="text-xs text-gray-500 mt-1">Max size: 2MB. Formats: JPG, PNG, WEBP</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.courses.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
                    Create Course
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
