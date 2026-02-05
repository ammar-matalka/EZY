@extends('layouts.app')

@section('title', $course->title)

@section('content')

<!-- Course Hero Section with Diagonal Pattern -->
<div class="relative bg-gradient-to-br from-[#003F7D] to-[#0056a8] overflow-hidden">
    <!-- Diagonal Pattern Background -->
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="diagonal-lines" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <line x1="0" y1="0" x2="40" y2="40" stroke="white" stroke-width="2"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#diagonal-lines)"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <!-- Course Logo -->
            <div class="flex-shrink-0">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}"
                         alt="{{ $course->title }}"
                         class="w-48 h-48 object-contain drop-shadow-2xl">
                @else
                    <div class="w-48 h-48 bg-white/10 backdrop-blur rounded-3xl flex items-center justify-center">
                        <span class="text-8xl font-bold text-white/50">{{ substr($course->title, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <!-- Course Title -->
            <div class="flex-1 text-center md:text-left">
                @if($course->subtitle)
                    <h2 class="text-3xl md:text-4xl font-bold text-orange-400 mb-2">
                        {{ $course->subtitle }}
                    </h2>
                @endif
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">
                    {{ $course->title }}
                </h1>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Left Column: About & Objectives -->
            <div class="lg:col-span-5 space-y-10">
                <!-- About The Course -->
                <div>
                    <h2 class="text-3xl font-bold text-orange-500 mb-6">About The Course</h2>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $course->description }}
                    </p>
                </div>

                <!-- Objectives -->
                @if($course->objectives)
                    <div>
                        <h2 class="text-3xl font-bold text-orange-500 mb-6">Objectives</h2>
                        <ul class="space-y-4">
                            @foreach(json_decode($course->objectives) as $objective)
                                <li class="flex items-start gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-800 font-medium">{{ $objective }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Right Column: Course Content -->
            <div class="lg:col-span-7">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-orange-500">Course Content</h2>
                    <!-- Decorative Dots -->
                    <div class="hidden lg:flex flex-col gap-2">
                        @for($i = 0; $i < 10; $i++)
                            <div class="flex gap-2">
                                @for($j = 0; $j < 3; $j++)
                                    <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Modules/Curriculum List -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    @forelse($course->modules as $index => $module)
                        <div class="border-b border-gray-200 last:border-0" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="w-full py-4 flex items-center justify-between text-left hover:text-orange-500 transition group">
                                <div class="flex items-center gap-4">
                                    <span class="text-2xl font-bold text-[#003F7D] group-hover:text-orange-500 transition">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-lg font-semibold text-gray-800 group-hover:text-orange-500 transition">
                                        {{ $module->title }}
                                    </span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                     :class="{ 'rotate-180': open }"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Lessons Dropdown -->
                            <div x-show="open"
                                 x-collapse
                                 class="pl-14 pb-4">
                                <div class="text-sm text-gray-600 space-y-2">
                                    @foreach($module->lessons as $lesson)
                                        <div class="py-2">
                                            {{ $lesson->title }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            No curriculum available yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Projects Section -->
        @if($course->projects && $course->projects->count() > 0)
            <div class="mt-20">
                <div class="flex items-center mb-8">
                    <h2 class="text-3xl font-bold text-orange-500">{{ $course->title }} Projects</h2>
                    <div class="flex-1 h-1 bg-orange-400 ml-6"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($course->projects as $project)
                        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 group cursor-pointer">
                            <div class="w-14 h-14 bg-orange-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[#003F7D] mb-2 group-hover:text-orange-500 transition">
                                {{ $project->title }}
                            </h3>
                            @if($project->description)
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ Str::limit($project->description, 80) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- CTA Section -->
        <div class="mt-20 bg-gradient-to-br from-[#003F7D] to-[#0056a8] rounded-[40px] p-12 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Wanna check more<br>about the course?
                    </h2>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    @if($hasAccess)
                        <a href="{{ route('student.dashboard') }}"
                           class="px-8 py-4 bg-white text-[#003F7D] rounded-xl font-bold hover:shadow-xl transition-all inline-flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Go to Dashboard
                        </a>
                    @else
                        <button onclick="alert('Demo feature coming soon!')"
                                class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-xl font-bold hover:bg-white/10 transition-all inline-flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Demo
                        </button>

                        @auth
                            @if(auth()->user()->hasActiveSubscription())
                                <a href="{{ route('subscription.select-courses') }}"
                                   class="px-8 py-4 bg-white text-[#003F7D] rounded-xl font-bold hover:shadow-xl transition-all inline-flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Enroll Now
                                </a>
                            @else
                                <button onclick="alert('Payment gateway coming soon!')"
                                        class="px-8 py-4 bg-white text-[#003F7D] rounded-xl font-bold hover:shadow-xl transition-all inline-flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Enroll Now
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="px-8 py-4 bg-white text-[#003F7D] rounded-xl font-bold hover:shadow-xl transition-all inline-flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Enroll Now
                            </a>
                        @endguest

                        <button onclick="alert('Download feature coming soon!')"
                                class="px-8 py-4 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 transition-all inline-flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                            </svg>
                            Download Curriculum
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tools & Platforms -->
        @if($course->tools || true)
            <div class="mt-20">
                <div class="flex items-center mb-8">
                    <h2 class="text-3xl font-bold text-orange-500">Tools & Platforms</h2>
                    <div class="flex-1 h-1 bg-orange-400 ml-6"></div>
                </div>

                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @php
                        $defaultTools = [
                            ['name' => 'Angular', 'icon' => 'A'],
                            ['name' => 'TypeScript', 'icon' => 'TS'],
                            ['name' => 'VS Code', 'icon' => 'VS'],
                            ['name' => 'Node.js', 'icon' => 'N'],
                            ['name' => 'React', 'icon' => 'R'],
                            ['name' => 'Git', 'icon' => 'G'],
                        ];
                    @endphp

                    @foreach($defaultTools as $tool)
                        <div class="aspect-square bg-[#003F7D] rounded-full flex items-center justify-center text-white text-4xl font-bold hover:scale-110 transition-transform cursor-pointer shadow-lg">
                            {{ $tool['icon'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Smooth collapse animation */
    [x-cloak] { display: none !important; }
</style>
@endpush
