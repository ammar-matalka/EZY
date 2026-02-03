@extends('layouts.app')

@section('title', 'EZY Skills - Empower Your Skills')

@section('content')

{{-- ========================================
    HERO SECTION
========================================= --}}
<section class="bg-gradient-to-br from-blue-50 to-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary leading-tight">
                    Skill Your Way<br>
                    Up To Success<br>
                    With Us
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed">
                    Get the skills you need for<br>
                    the future of work.
                </p>

                <!-- Search Bar & Category Pills -->
                <div class="space-y-4">
                    <!-- Search Input -->
                    <form action="{{ route('courses') }}" method="GET" class="flex">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search the course you want"
                            class="flex-1 px-6 py-4 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        <button
                            type="submit"
                            class="px-8 py-4 bg-primary text-white font-medium rounded-r-lg hover:bg-primary-dark transition"
                        >
                            Search
                        </button>
                    </form>

                    <!-- Category Pills -->
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('courses') }}?category=Cloud Computing" class="px-5 py-2.5 bg-orange text-white rounded-lg font-medium hover:bg-orange-light transition">
                            Cloud Computing
                        </a>
                        <a href="{{ route('courses') }}?category=Cyber Security" class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                            Cyber Security
                        </a>
                        <a href="{{ route('courses') }}?category=DevOps" class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                            DevOps
                        </a>
                        <a href="{{ route('courses') }}?category=Data Science" class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                            Data Science
                        </a>
                        <a href="{{ route('courses') }}?category=Software Testing" class="px-5 py-2.5 bg-white text-gray-700 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                            Software Testing
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Image with Course Cards -->
            <div class="relative">
                <img
                    src="{{ asset('images/hero-person.png') }}"
                    alt="Student Success"
                    class="w-full h-auto relative z-10"
                >

                <!-- Decorative circles -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange rounded-full opacity-20 -z-10"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-primary rounded-full opacity-20 -z-10"></div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    AI COURSE SELECTOR SECTION (SLIDER)
========================================= --}}
<section class="py-16 bg-white relative overflow-hidden">
    <!-- Decorative dots -->
    <div class="absolute left-8 top-1/2 transform -translate-y-1/2 grid grid-cols-3 gap-2 opacity-50">
        @for($i = 0; $i < 30; $i++)
            <div class="w-1.5 h-1.5 bg-orange rounded-full"></div>
        @endfor
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="space-y-6">
                <h2 class="text-4xl md:text-5xl font-bold text-primary">
                    World's<br>
                    First AI Based<br>
                    <span class="text-orange">Online Learning</span><br>
                    <span class="text-orange">Platform</span>
                </h2>
            </div>

            <!-- Right Slider -->
            <div class="space-y-6">
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-3xl p-8 relative">
                    <div class="swiper aiSlider">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 - AI Course Selector -->
                            <div class="swiper-slide">
                                <div class="text-center space-y-6">
                                    <img
                                        src="{{ asset('images/slider/ai-brain.png') }}"
                                        alt="AI Based Course Selector"
                                        class="mx-auto h-48 w-auto"
                                    >
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-primary">AI Based</h3>
                                        <h3 class="text-2xl font-bold text-orange">Course</h3>
                                        <h3 class="text-2xl font-bold text-orange">Selector</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 - Smart Learning -->
                            <div class="swiper-slide">
                                <div class="text-center space-y-6">
                                    <img
                                        src="{{ asset('images/slider/smart-learning.png') }}"
                                        alt="Smart Learning Platform"
                                        class="mx-auto h-48 w-auto"
                                    >
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-primary">Smart Learning</h3>
                                        <h3 class="text-2xl font-bold text-orange">Personalized</h3>
                                        <h3 class="text-2xl font-bold text-orange">Experience</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 - Career Path -->
                            <div class="swiper-slide">
                                <div class="text-center space-y-6">
                                    <img
                                        src="{{ asset('images/slider/career-path.png') }}"
                                        alt="Career Path Guidance"
                                        class="mx-auto h-48 w-auto"
                                    >
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-primary">Career Path</h3>
                                        <h3 class="text-2xl font-bold text-orange">AI Powered</h3>
                                        <h3 class="text-2xl font-bold text-orange">Guidance</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination Lines (Outside the slider box) -->
                <div class="swiper-pagination-ai text-center"></div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    SKILL DEVELOPMENT SCHEMES SECTION
========================================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="space-y-8">
                <div>
                    <p class="text-orange font-semibold uppercase tracking-wider mb-2">WHO CAN JOIN</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-primary">
                        Skill Development<br>
                        Schemes For All
                    </h2>
                </div>

                <!-- Grid of 4 categories -->
                <div class="grid grid-cols-2 gap-6">
                    <!-- Colleges/Universities -->
                    <div class="space-y-3">
                        <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-primary flex items-center">
                                <span class="text-primary text-2xl mr-2">01</span>
                                Colleges/Universities
                            </h3>
                        </div>
                    </div>

                    <!-- Individuals/Working Professionals -->
                    <div class="space-y-3">
                        <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-primary flex items-center">
                                <span class="text-primary text-2xl mr-2">02</span>
                                Individuals/Working Professionals
                            </h3>
                        </div>
                    </div>

                    <!-- Startups -->
                    <div class="space-y-3">
                        <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-primary flex items-center">
                                <span class="text-primary text-2xl mr-2">03</span>
                                Startups
                            </h3>
                        </div>
                    </div>

                    <!-- Corporates -->
                    <div class="space-y-3">
                        <div class="w-16 h-16 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-10 h-10 text-orange" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-primary flex items-center">
                                <span class="text-primary text-2xl mr-2">04</span>
                                Corporates
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div>
                <img
                    src="{{ asset('images/skill-development.png') }}"
                    alt="Skill Development"
                    class="w-full h-auto"
                >
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    HOW IT WORKS SECTION
========================================= --}}
<section class="py-16 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <div class="inline-block px-6 py-3 bg-orange text-white font-semibold rounded-full mb-4">
                How It Works
            </div>
        </div>

        <!-- Process Flow -->
        <div class="bg-primary rounded-3xl p-8 md:p-12 relative overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-10 right-10 w-32 h-32 bg-orange rounded-full opacity-20"></div>

            <div class="relative z-10">
                <div class="flex flex-wrap items-center justify-between gap-8">
                    <!-- Job Seeker -->
                    <div class="text-center">
                        <div class="bg-white rounded-2xl p-6 w-32 mx-auto mb-4">
                            <img src="{{ asset('images/job-seeker.png') }}" alt="Job Seeker" class="w-full h-auto">
                        </div>
                        <p class="text-white font-semibold">Job Seeker</p>
                        <!-- Dots decoration -->
                        <div class="mt-4 flex justify-center gap-1">
                            @for($i = 0; $i < 4; $i++)
                                <div class="w-2 h-2 bg-orange rounded-full"></div>
                            @endfor
                        </div>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Step 01 - Assessment Aptitude Test -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white mb-1"><span class="font-bold">01</span></p>
                        <p class="text-xs text-white">Assessment<br>Aptitude Test</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Step 02 & 03 - Hands on Practice -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 1a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm4-4a1 1 0 100 2h.01a1 1 0 100-2H13zM9 9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zM7 8a1 1 0 000 2h.01a1 1 0 000-2H7z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white mb-1"><span class="font-bold">02</span> <span class="font-bold">03</span></p>
                        <p class="text-xs text-white">Hands on Practice<br>Scenarios, Test<br>Cases</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Step 04 - Soft Skills Training -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white mb-1"><span class="font-bold">04</span></p>
                        <p class="text-xs text-white">Soft Skills &<br>Business Training</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Step 05 - Daily Assessments -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white mb-1"><span class="font-bold">05</span></p>
                        <p class="text-xs text-white">Daily, Weekly, Monthly<br>Assessments</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Step 06 - Real Time Projects -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white mb-1"><span class="font-bold">06</span></p>
                        <p class="text-xs text-white">Real Time Project<br>Hackathons</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Assessment Guidance -->
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 w-20 mx-auto mb-2">
                            <svg class="w-full h-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-xs text-white">Assessment Guidance<br>& Monitoring</p>
                    </div>

                    <!-- Arrow -->
                    <div class="text-white text-2xl hidden md:block">→</div>

                    <!-- Employed -->
                    <div class="text-center">
                        <div class="bg-white rounded-2xl p-6 w-32 mx-auto mb-4">
                            <img src="{{ asset('images/employed.png') }}" alt="Employed" class="w-full h-auto">
                        </div>
                        <p class="text-white font-semibold">Employed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    POPULAR COURSES SECTION
========================================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">
                <span class="text-primary">Popoular</span> <span class="text-orange">Courses</span>
            </h2>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @forelse($featuredCourses as $course)
                <div class="bg-primary rounded-2xl overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                    <!-- Course Image -->
                    <div class="h-48 bg-white flex items-center justify-center p-8">
                        @if($course->image)
                            <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="h-full w-auto object-contain">
                        @else
                            <div class="w-20 h-20 bg-orange rounded-2xl flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Course Content -->
                    <div class="p-6 space-y-4">
                        <h3 class="text-xl font-bold text-white">{{ $course->title }}</h3>

                        <p class="text-gray-300 text-sm line-clamp-3">
                            {{ Str::limit($course->description, 100) }}
                        </p>

                        <!-- Stats -->
                        <div class="flex items-center justify-between text-sm text-gray-300">
                            <div class="flex items-center space-x-4">
                                <!-- Modules -->
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                    {{ $course->modules->count() }} Modules
                                </span>

                                <!-- Students -->
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    {{ $course->enrolledStudentsCount() }} Students
                                </span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-3">
                            <a href="{{ route('courses') }}" class="flex-1 px-4 py-2 bg-white text-primary text-center rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                                Live Demo
                            </a>
                            <a href="{{ route('courses') }}" class="flex-1 px-4 py-2 bg-orange text-white text-center rounded-lg hover:bg-orange-light transition text-sm font-medium">
                                Enroll Now
                            </a>
                        </div>

                        <!-- Download Curriculum Badge -->
                        <div class="pt-2">
                            <span class="inline-flex items-center px-3 py-1.5 bg-orange text-white text-xs font-medium rounded-full">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Download Curriculum
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-500">No courses available at the moment.</p>
                </div>
            @endforelse
        </div>

        <!-- View All Button -->
        <div class="text-center">
            <a href="{{ route('courses') }}" class="inline-block px-8 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition">
                View All Courses
            </a>
        </div>
    </div>
</section>

{{-- ========================================
    ACHIEVEMENTS SECTION
========================================= --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">
                <span class="text-primary">Our</span> <span class="text-orange">Achievements</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Illustration -->
            <div class="relative">
                <img
                    src="{{ asset('images/achievements-illustration.png') }}"
                    alt="Achievements"
                    class="w-full h-auto"
                >
                <!-- Decorative dots -->
                <div class="absolute right-0 bottom-0 grid grid-cols-4 gap-2 opacity-30">
                    @for($i = 0; $i < 16; $i++)
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    @endfor
                </div>
            </div>

            <!-- Right Stats Cards -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Students Trained -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <h3 class="text-5xl font-bold text-orange mb-2">{{ $stats['students'] ?? 100 }}</h3>
                    <p class="text-gray-600 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                        Students Trained
                    </p>
                </div>

                <!-- Courses Available -->
                <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <h3 class="text-5xl font-bold text-orange mb-2">{{ $stats['courses'] ?? 50 }}</h3>
                    <p class="text-gray-600 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        Courses Available
                    </p>
                </div>

                <!-- Students Secured Jobs -->
                <div class="col-span-2 bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
                    <h3 class="text-5xl font-bold text-orange mb-2">70%</h3>
                    <p class="text-gray-600">Students Secured Jobs in Level 1 Companies</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    PROFESSIONAL MENTORS SECTION
========================================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">
                <span class="text-primary">Meet Our Professional</span><br>
                <span class="text-orange">Mentors & Trainers</span>
            </h2>
        </div>

        <!-- Mentors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @forelse($topInstructors as $instructor)
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition relative overflow-hidden">
                    <!-- Best Trainer Badge (for first instructor) -->
                    @if($loop->first)
                        <div class="absolute top-4 left-4 bg-orange text-white px-4 py-1 rounded-full text-sm font-semibold">
                            ⭐ BEST TRAINER
                        </div>
                    @endif

                    <div class="flex items-start space-x-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            @if($instructor->avatar)
                                <img
                                    src="{{ Storage::url($instructor->avatar) }}"
                                    alt="{{ $instructor->name }}"
                                    class="w-24 h-24 rounded-full object-cover border-4 border-gray-200"
                                >
                            @else
                                <div class="w-24 h-24 rounded-full bg-primary flex items-center justify-center border-4 border-gray-200">
                                    <span class="text-3xl text-white font-bold">{{ substr($instructor->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-primary mb-1">{{ $instructor->name }}</h3>
                            <p class="text-orange font-medium mb-3">{{ $instructor->expertise }}</p>

                            <!-- Rating -->
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($instructor->rating))
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">{{ number_format($instructor->rating, 1) }} ({{ $instructor->reviews_count }} Reviews)</span>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                    {{ $instructor->courses->count() }} Modules
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    {{ $instructor->courses->sum(function($course) { return $course->enrolledStudentsCount(); }) }} Students
                                </span>
                            </div>

                            <!-- Bio -->
                            @if($instructor->bio)
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ Str::limit($instructor->bio, 150) }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Decorative circle -->
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-orange rounded-full opacity-10"></div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12">
                    <p class="text-gray-500">No instructors available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================
    CERTIFICATIONS SECTION
========================================= --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">
                <span class="text-primary">Our</span> <span class="text-orange">Certifications</span>
            </h2>
        </div>

        <!-- Certifications Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
            <!-- ISO 27001 -->
            <div class="text-center hover:scale-110 transition duration-300">
                <img
                    src="{{ asset('images/certifications/iso-27001.png') }}"
                    alt="ISO 27001 Certification"
                    class="w-32 h-32 mx-auto object-contain"
                >
            </div>

            <!-- ISO 9001 -->
            <div class="text-center hover:scale-110 transition duration-300">
                <img
                    src="{{ asset('images/certifications/iso-9001.png') }}"
                    alt="ISO 9001 Certification"
                    class="w-32 h-32 mx-auto object-contain"
                >
            </div>

            <!-- ISO 20000-1 -->
            <div class="text-center hover:scale-110 transition duration-300">
                <img
                    src="{{ asset('images/certifications/iso-20000.png') }}"
                    alt="ISO 20000-1 Certification"
                    class="w-32 h-32 mx-auto object-contain"
                >
            </div>

            <!-- ISO 29993 -->
            <div class="text-center hover:scale-110 transition duration-300">
                <img
                    src="{{ asset('images/certifications/iso-29993.png') }}"
                    alt="ISO 29993 Certification"
                    class="w-32 h-32 mx-auto object-contain"
                >
            </div>
        </div>
    </div>
</section>

{{-- ========================================
    COLLABORATIONS SECTION
========================================= --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">
                <span class="text-primary">Our</span> <span class="text-orange">Collaborations</span>
            </h2>
        </div>

        <!-- Collaborations Logos -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
            <!-- NASSCOM -->
            <div class="flex justify-center items-center p-6 bg-white rounded-lg hover:shadow-lg transition">
                <img
                    src="{{ asset('images/collaborations/nasscom.png') }}"
                    alt="NASSCOM Foundation"
                    class="h-16 w-auto object-contain grayscale hover:grayscale-0 transition"
                >
            </div>

            <!-- Skill India -->
            <div class="flex justify-center items-center p-6 bg-white rounded-lg hover:shadow-lg transition">
                <img
                    src="{{ asset('images/collaborations/skill-india.png') }}"
                    alt="Skill India"
                    class="h-16 w-auto object-contain grayscale hover:grayscale-0 transition"
                >
            </div>

            <!-- Startup India -->
            <div class="flex justify-center items-center p-6 bg-white rounded-lg hover:shadow-lg transition">
                <img
                    src="{{ asset('images/collaborations/startupindia.png') }}"
                    alt="Startup India"
                    class="h-16 w-auto object-contain grayscale hover:grayscale-0 transition"
                >
            </div>

            <!-- IIE Hyderabad -->
            <div class="flex justify-center items-center p-6 bg-white rounded-lg hover:shadow-lg transition">
                <img
                    src="{{ asset('images/collaborations/iie-hyderabad.png') }}"
                    alt="IIE Hyderabad"
                    class="h-16 w-auto object-contain grayscale hover:grayscale-0 transition"
                >
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Custom Swiper Pagination - Lines instead of dots */
    .swiper-pagination-ai .swiper-pagination-bullet {
        width: 40px;
        height: 4px;
        border-radius: 2px;
        background: #D1D5DB;
        opacity: 1;
        transition: all 0.3s ease;
        display: inline-block;
        margin: 0 4px;
    }

    .swiper-pagination-ai .swiper-pagination-bullet-active {
        background: #FF8C42;
        width: 50px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize Swiper for AI Course Selector
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.aiSlider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination-ai',
                clickable: true,
            },
            autoplay: {
                delay: 1000, // 1 second
                disableOnInteraction: false,
            },
        });
    });
</script>
@endpush
