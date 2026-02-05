@extends('teacher.layouts.app')

@section('title', 'Edit Course')
@section('page-title', 'Edit Course: ' . $course->title)

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('teacher.courses.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Back to My Courses
        </a>
    </div>

    <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Current Image Preview -->
        @if($course->image)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-lg font-bold text-primary mb-4">Current Course Image</h3>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $course->image) }}" alt="Current Course Image" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                <div>
                    <button type="button" onclick="removeImage()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Remove Image
                    </button>
                    <input type="hidden" name="remove_image" id="remove-image-input" value="0">
                    <p class="text-sm text-gray-500 mt-2">Check the box to remove current image</p>
                </div>
            </div>
        </div>
        @endif

        <!-- 1. Basic Information -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Basic Information</h2>

            <!-- Course Title -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Course Title <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $course->title) }}"
                    required
                    placeholder="e.g., Angular JS: Basic to Advance Level Coding"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('title') border-red-500 @enderror"
                >
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Course Image -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Change Course Image/Logo
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

            <!-- Status & Duration -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="opened" {{ old('status', $course->status) == 'opened' ? 'selected' : '' }}>Opened</option>
                        <option value="coming_soon" {{ old('status', $course->status) == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                        <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Duration (hours)
                    </label>
                    <input
                        type="number"
                        name="duration"
                        value="{{ old('duration', $course->duration) }}"
                        min="1"
                        placeholder="e.g., 40"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                </div>
            </div>
        </div>

        <!-- 2. About The Course -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">About The Course</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="description"
                    rows="6"
                    required
                    placeholder="Write a detailed description about the course..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('description') border-red-500 @enderror"
                >{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- 3. Objectives -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Objectives (What You'll Learn)</h2>

            <div id="objectives-container">
                @php
                    $objectives = old('objectives', $course->objectives ?? []);
                    if (is_string($objectives)) {
                        $objectives = json_decode($objectives, true) ?? [];
                    }
                @endphp

                @if(count($objectives) > 0)
                    @foreach($objectives as $index => $objective)
                        <div class="objective-item flex gap-2 mb-3">
                            <input
                                type="text"
                                name="objectives[]"
                                value="{{ $objective }}"
                                placeholder="e.g., Utilizing Angular.js in Multi-Page Web Applications"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button type="button" onclick="removeObjective(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="objective-item flex gap-2 mb-3">
                        <input
                            type="text"
                            name="objectives[]"
                            placeholder="e.g., Utilizing Angular.js in Multi-Page Web Applications"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        <button type="button" onclick="removeObjective(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addObjective()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                + Add Objective
            </button>
        </div>

        <!-- 4. Course Content (Modules) -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Course Content (Modules)</h2>

            <div id="modules-container">
                @php
                    $modules = old('modules', $course->modules ?? []);
                    if (is_string($modules)) {
                        $modules = json_decode($modules, true) ?? [];
                    }
                @endphp

                @if(count($modules) > 0)
                    @foreach($modules as $index => $module)
                        <div class="module-item border border-gray-300 rounded-lg p-4 mb-4">
                            <div class="flex items-center gap-2 mb-3">
                                <input
                                    type="text"
                                    name="modules[{{ $index }}][title]"
                                    value="{{ $module['title'] ?? '' }}"
                                    placeholder="Module Title (e.g., 01 HTML)"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                >
                                <button type="button" onclick="removeModule(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <textarea
                                name="modules[{{ $index }}][content]"
                                rows="2"
                                placeholder="Module description/content (optional)"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >{{ $module['content'] ?? '' }}</textarea>
                        </div>
                    @endforeach
                @else
                    <div class="module-item border border-gray-300 rounded-lg p-4 mb-4">
                        <div class="flex items-center gap-2 mb-3">
                            <input
                                type="text"
                                name="modules[0][title]"
                                placeholder="Module Title (e.g., 01 HTML)"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button type="button" onclick="removeModule(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <textarea
                            name="modules[0][content]"
                            rows="2"
                            placeholder="Module description/content (optional)"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        ></textarea>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addModule()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                + Add Module
            </button>
        </div>

        <!-- 5. Projects -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Projects</h2>

            <div id="projects-container">
                @php
                    $projects = old('projects', $course->projects ?? []);
                    if (is_string($projects)) {
                        $projects = json_decode($projects, true) ?? [];
                    }
                @endphp

                @if(count($projects) > 0)
                    @foreach($projects as $index => $project)
                        <div class="project-item border border-gray-300 rounded-lg p-4 mb-4">
                            <div class="flex items-center gap-2 mb-3">
                                <input
                                    type="text"
                                    name="projects[{{ $index }}][title]"
                                    value="{{ $project['title'] ?? '' }}"
                                    placeholder="Project Title (e.g., Angular Hello World Project)"
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                >
                                <button type="button" onclick="removeProject(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <textarea
                                name="projects[{{ $index }}][description]"
                                rows="2"
                                placeholder="Project description..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >{{ $project['description'] ?? '' }}</textarea>
                        </div>
                    @endforeach
                @else
                    <div class="project-item border border-gray-300 rounded-lg p-4 mb-4">
                        <div class="flex items-center gap-2 mb-3">
                            <input
                                type="text"
                                name="projects[0][title]"
                                placeholder="Project Title (e.g., Angular Hello World Project)"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            <button type="button" onclick="removeProject(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <textarea
                            name="projects[0][description]"
                            rows="2"
                            placeholder="Project description..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        ></textarea>
                    </div>
                @endif
            </div>
            <button type="button" onclick="addProject()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                + Add Project
            </button>
        </div>

        <!-- 6. Tools & Platforms -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Tools & Platforms</h2>
            <p class="text-sm text-gray-600 mb-4">Current tools:</p>

            <div id="existing-tools-container" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                @php
                    $tools = old('existing_tools', $course->tools ?? []);
                    if (is_string($tools)) {
                        $tools = json_decode($tools, true) ?? [];
                    }
                @endphp

                @foreach($tools as $index => $tool)
                    @if(is_string($tool) && filter_var($tool, FILTER_VALIDATE_URL))
                        <div class="relative group">
                            <img src="{{ $tool }}" class="w-full h-20 object-contain bg-gray-100 rounded-lg p-2 border border-gray-300">
                            <button type="button" onclick="removeExistingTool(this)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            <input type="hidden" name="existing_tools[]" value="{{ $tool }}">
                        </div>
                    @endif
                @endforeach
            </div>

            <p class="text-sm text-gray-600 mb-4">Add new tools:</p>
            <div id="new-tools-container" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4">
                <!-- New tools will be added here -->
            </div>

            <div class="flex gap-2">
                <input
                    type="file"
                    id="tool-input"
                    accept="image/*"
                    multiple
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                >
                <button type="button" onclick="addNewTools()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                    Add New Tools
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-2">You can select multiple images at once. Max size per image: 1MB</p>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-between space-x-4 pt-6">
            <button type="button" onclick="if(confirm('Are you sure you want to delete this course?')) document.getElementById('delete-form').submit();" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-medium transition">
                Delete Course
            </button>

            <div class="flex space-x-4">
                <a href="{{ route('teacher.courses.index') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
                    Update Course
                </button>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    <form id="delete-form" action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
// Remove Image Function
function removeImage() {
    const input = document.getElementById('remove-image-input');
    input.value = '1';
    document.querySelector('img[alt="Current Course Image"]').style.opacity = '0.5';
    alert('Current image will be removed. You can upload a new one.');
}

// Remove Existing Tool Function
function removeExistingTool(button) {
    button.closest('.relative').remove();
}

// Objectives Functions
function addObjective() {
    const container = document.getElementById('objectives-container');
    const div = document.createElement('div');
    div.className = 'objective-item flex gap-2 mb-3';
    div.innerHTML = `
        <input
            type="text"
            name="objectives[]"
            placeholder="e.g., Utilizing Angular.js in Multi-Page Web Applications"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
        >
        <button type="button" onclick="removeObjective(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeObjective(button) {
    const container = document.getElementById('objectives-container');
    if (container.children.length > 1) {
        button.closest('.objective-item').remove();
    } else {
        alert('At least one objective is required');
    }
}

// Modules Functions
let moduleIndex = {{ count($modules) }};
function addModule() {
    const container = document.getElementById('modules-container');
    const div = document.createElement('div');
    div.className = 'module-item border border-gray-300 rounded-lg p-4 mb-4';
    div.innerHTML = `
        <div class="flex items-center gap-2 mb-3">
            <input
                type="text"
                name="modules[${moduleIndex}][title]"
                placeholder="Module Title (e.g., 01 HTML)"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
            >
            <button type="button" onclick="removeModule(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <textarea
            name="modules[${moduleIndex}][content]"
            rows="2"
            placeholder="Module description/content (optional)"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
        ></textarea>
    `;
    container.appendChild(div);
    moduleIndex++;
}

function removeModule(button) {
    button.closest('.module-item').remove();
}

// Projects Functions
let projectIndex = {{ count($projects) }};
function addProject() {
    const container = document.getElementById('projects-container');
    const div = document.createElement('div');
    div.className = 'project-item border border-gray-300 rounded-lg p-4 mb-4';
    div.innerHTML = `
        <div class="flex items-center gap-2 mb-3">
            <input
                type="text"
                name="projects[${projectIndex}][title]"
                placeholder="Project Title (e.g., Angular Hello World Project)"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
            >
            <button type="button" onclick="removeProject(this)" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <textarea
            name="projects[${projectIndex}][description]"
            rows="2"
            placeholder="Project description..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
        ></textarea>
    `;
    container.appendChild(div);
    projectIndex++;
}

function removeProject(button) {
    button.closest('.project-item').remove();
}

// New Tools Functions
function addNewTools() {
    const input = document.getElementById('tool-input');
    const container = document.getElementById('new-tools-container');

    if (input.files.length === 0) {
        alert('Please select at least one image');
        return;
    }

    Array.from(input.files).forEach((file, index) => {
        if (file.size > 1048576) { // 1MB
            alert(`${file.name} is too large. Max size is 1MB`);
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-20 object-contain bg-gray-100 rounded-lg p-2 border border-gray-300">
                <button type="button" onclick="removeNewTool(this)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <input type="hidden" name="new_tools[]" value="${e.target.result}">
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });

    input.value = '';
}

function removeNewTool(button) {
    button.closest('.relative').remove();
}
</script>

@endsection
