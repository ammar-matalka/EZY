@extends('layouts.guest')

@section('title', 'Home - EzySkills | Empower Your Skills')

@section('content')

<!-- Hero Section -->
<section class="bg-black text-white py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="z-10">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6">
                    <span class="text-blue-400">Skill Your Way</span><br>
                    <span class="text-blue-400">Up To Success</span><br>
                    <span class="text-blue-400">With Us</span>
                </h1>
                <p class="text-gray-300 text-lg mb-8">
                    Get the skills you need for the future of work.
                </p>

                <!-- Search Bar -->
                <div class="bg-white rounded-lg p-2 flex items-center mb-6">
                    <input
                        type="text"
                        placeholder="Search the course you want"
                        class="flex-1 px-4 py-3 text-gray-800 focus:outline-none"
                    >
                    <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                        →
                    </button>
                </div>

                <!-- Popular Categories -->
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-orange-500 text-white rounded-full text-sm font-medium">Cloud Computing</span>
                    <span class="px-4 py-2 bg-white text-gray-800 rounded-full text-sm font-medium">Cyber Security</span>
                    <span class="px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded-full text-sm font-medium">DevOps</span>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative hidden lg:block">
                <div class="relative h-96 flex items-center justify-center">
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-500 rounded-full opacity-80"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-600 rounded-full"></div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- AI Course Selector -->
<section class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">
                World's First <span class="text-blue-400">AI Based</span><br>
                <span class="text-orange-500">Online Learning Platform</span>
            </h2>
        </div>

        <div class="bg-gradient-to-br from-blue-100 to-orange-100 rounded-3xl p-8 max-w-3xl mx-auto shadow-2xl">
            <div class="flex items-center justify-between">
                <img src="{{ asset('images/logo.png') }}" alt="EzySkills" class="h-16">
                <div class="text-center flex-1">
                    <h3 class="text-2xl font-bold text-gray-800">AI Based</h3>
                    <h2 class="text-3xl font-bold text-orange-500">Course Selector</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Who Can Join -->
<section class="py-16 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-orange-500 text-sm uppercase tracking-wider mb-2">WHO CAN JOIN</p>
            <h2 class="text-4xl font-bold text-blue-400 mb-4">
                Skill Development Schemes For All
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-blue-400">01</h3>
                <p class="text-lg font-semibold">Colleges/Universities</p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-blue-400">02</h3>
                <p class="text-lg font-semibold">Individuals/Professionals</p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-blue-400">03</h3>
                <p class="text-lg font-semibold">Startups</p>
            </div>

            <div class="text-center">
                <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 7V3H2v18h20V7H12z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-blue-400">04</h3>
                <p class="text-lg font-semibold">Corporates</p>
            </div>
        </div>
    </div>
</section>

<!-- Achievements -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">Our <span class="text-orange-500">Achievements</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <h3 class="text-5xl font-bold text-orange-500 mb-2">{{ $stats['students'] }}</h3>
                <p class="text-gray-600 font-medium">Students Trained</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <h3 class="text-5xl font-bold text-orange-500 mb-2">{{ $stats['courses'] }}</h3>
                <p class="text-gray-600 font-medium">Courses Available</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <h3 class="text-5xl font-bold text-blue-900 mb-2">70%</h3>
                <p class="text-gray-600 font-medium">Job Placement</p>
            </div>
        </div>
    </div>
</section>

<!-- Mentors -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">
                Meet Our Professional<br>
                <span class="text-orange-500">Mentors & Trainers</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($topInstructors as $instructor)
            <div class="bg-white rounded-2xl shadow-xl p-8">
                @if($loop->first)
                <div class="text-center mb-4">
                    <span class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm">⭐ BEST TRAINER</span>
                </div>
                @endif

                <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                    {{ substr($instructor->name, 0, 1) }}
                </div>

                <h3 class="text-2xl font-bold text-center mb-2">{{ $instructor->name }}</h3>
                <p class="text-orange-500 text-center mb-4">{{ $instructor->expertise }}</p>

                <div class="flex justify-center mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $instructor->rating ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    @endfor
                </div>

                <p class="text-gray-600 text-sm text-center">{{ Str::limit($instructor->bio, 100) }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">No instructors available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
