@extends('layouts.app')

@section('title', $course->title)

@section('content')

<!-- Course Hero Section -->
<div class="relative bg-gradient-to-br from-blue-900 to-blue-800 py-20 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row items-center gap-8"
             x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 100)"
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-5"
             x-transition:enter-end="opacity-100 translate-y-0">

            <!-- Course Logo -->
            <div class="flex-shrink-0">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="w-32 h-32 md:w-40 md:h-40 object-contain bg-white rounded-2xl p-4 shadow-xl">
                @else
                    <div class="w-32 h-32 md:w-40 md:h-40 bg-white rounded-2xl flex items-center justify-center shadow-xl">
                        <span class="text-6xl font-bold text-blue-800">{{ substr($course->title, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <!-- Course Info -->
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-3">
                    {{ $course->title }}
                </h1>
                <p class="text-lg text-white/90 mb-4">
                    {{ $course->description }}
                </p>
                <div class="flex items-center justify-center md:justify-start gap-4 text-white/80">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $course->instructor_name ?? 'Expert Instructor' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $course->duration ?? '40 Hours' }}</span>
                    </div>
                </div>
            </div>

            <!-- Price Badge -->
            <div class="flex-shrink-0 bg-white rounded-2xl p-6 shadow-xl text-center">
                <div class="text-sm text-gray-600 mb-1">Price</div>
                <div class="text-4xl font-black text-orange-500">${{ number_format($course->price) }}</div>
                <div class="text-xs text-gray-500 mt-1">+ Tax</div>
            </div>
        </div>
    </div>
</div>

@if(!$hasAccess)
    <!-- Locked Content View -->
    <div class="max-w-4xl mx-auto px-4 py-20">
        <div class="bg-white rounded-[40px] p-12 shadow-2xl border border-gray-100 relative overflow-hidden"
             x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 200)"
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">

            <!-- Decorative Background Icon -->
            <div class="absolute -top-10 -right-10 opacity-[0.03] rotate-12">
                <svg class="w-80 h-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <div class="relative z-10 text-center">
                <div class="w-20 h-20 bg-orange-500/10 rounded-3xl flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Content Locked</h2>
                <p class="text-gray-500 text-lg mb-10 max-w-lg mx-auto leading-relaxed">
                    This premium course is exclusive. You can unlock it by purchasing it individually for
                    <span class="text-orange-500 font-bold mx-1">${{ number_format($course->price) }}</span>
                    or by subscribing to one of our value-packed pricing plans.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <button onclick="alert('Payment gateway integration coming soon!')" class="px-10 py-4 bg-orange-500 text-white rounded-2xl font-bold shadow-xl shadow-orange-500/30 hover:shadow-2xl hover:-translate-y-1 transition-all">
                            Purchase Course
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-orange-500 text-white rounded-2xl font-bold shadow-xl shadow-orange-500/30 hover:shadow-2xl hover:-translate-y-1 transition-all">
                            Login to Purchase
                        </a>
                    @endauth

                    <a href="{{ route('pricing') }}" class="px-10 py-4 bg-white text-orange-500 border-2 border-orange-500/20 rounded-2xl font-bold hover:bg-orange-500/5 transition-all">
                        View Plans
                    </a>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Full Course Content View -->

    <!-- About & Objectives Section -->
    <section class="py-20 max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

            <!-- About Course -->
            <div class="lg:col-span-5">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">About This Course</h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $course->description }}
                </p>

                <!-- Learning Objectives -->
                @if($course->objectives)
                    <h3 class="text-xl font-bold text-gray-900 mb-4">What You'll Learn</h3>
                    <ul class="space-y-3">
                        @foreach(json_decode($course->objectives) as $objective)
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">{{ $objective }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Curriculum -->
            <div class="lg:col-span-7">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Course Curriculum</h2>

                <div class="space-y-4">
                    @forelse($course->modules as $index => $module)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <button class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                                    x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }"
                                    @click="open = !open">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $module->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $module->lessons->count() }} Lessons</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" x-collapse class="px-6 pb-4">
                                <ul class="space-y-2">
                                    @foreach($module->lessons as $lesson)
                                        <li class="flex items-center gap-3 text-gray-600">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-sm">{{ $lesson->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No curriculum available yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    @if($course->projects && $course->projects->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Course Projects</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($course->projects as $project)
                        <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                            <h3 class="font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $project->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-4">Ready to Start Learning?</h2>
            <p class="text-xl mb-8 text-white/90">Join thousands of students already enrolled</p>
            <a href="{{ route('student.dashboard') }}" class="inline-block px-10 py-4 bg-white text-orange-500 rounded-2xl font-bold hover:bg-gray-100 transition">
                Go to Dashboard
            </a>
        </div>
    </section>
@endif

@endsection
