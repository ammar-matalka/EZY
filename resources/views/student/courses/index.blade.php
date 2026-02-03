<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الكورسات - EZY Skills</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Cairo', sans-serif;
        }

        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .tab-active {
            color: #FF6B35;
            border-bottom: 2px solid #FF6B35;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                        <span class="text-white text-xl font-bold">EZY</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">EZY Skills</h1>
                        <p class="text-xs text-gray-500">Online Courses</p>
                    </div>
                </div>

                <!-- Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Course Selector</a>
                    <a href="{{ route('student.courses.index') }}" class="text-orange-500 font-semibold">Courses</a>
                    <a href="{{ route('pricing') }}" class="text-gray-600 hover:text-blue-600">Pricing</a>
                    <a href="{{ route('faq') }}" class="text-gray-600 hover:text-blue-600">FAQ</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-blue-600">Contact Us</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('student.dashboard') }}" class="px-6 py-2 text-orange-500 border-2 border-orange-500 rounded-lg hover:bg-orange-50">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-orange-500 border-2 border-orange-500 rounded-lg hover:bg-orange-50">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                            Create Account
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">

        <!-- Page Title -->
        <h2 class="text-4xl font-bold text-center mb-12">
            <span class="text-gray-700">Courses</span>
            <span class="text-orange-500">List</span>
        </h2>

        <!-- Search & Filters -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">

            <!-- Search Box -->
            <div class="w-full md:w-1/3">
                <form method="GET" action="{{ route('student.courses.index') }}">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search The Course Here..."
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                        <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Status Tabs -->
            <div class="flex items-center gap-8">
                <a href="{{ route('student.courses.index') }}"
                   class="text-gray-600 hover:text-orange-500 pb-2 {{ !request('status') ? 'tab-active' : '' }}">
                    All
                </a>
                <a href="{{ route('student.courses.index', ['status' => 'opened']) }}"
                   class="text-gray-600 hover:text-orange-500 pb-2 {{ request('status') == 'opened' ? 'tab-active' : '' }}">
                    Opened
                </a>
                <a href="{{ route('student.courses.index', ['status' => 'coming_soon']) }}"
                   class="text-gray-600 hover:text-orange-500 pb-2 {{ request('status') == 'coming_soon' ? 'tab-active' : '' }}">
                    Coming Soon
                </a>
                <a href="{{ route('student.courses.index', ['status' => 'archived']) }}"
                   class="text-gray-600 hover:text-orange-500 pb-2 {{ request('status') == 'archived' ? 'tab-active' : '' }}">
                    Archived
                </a>
            </div>

            <!-- Sort Dropdown -->
            <div class="w-full md:w-auto">
                <form method="GET" action="{{ route('student.courses.index') }}" id="sortForm">
                    <select
                        name="sort"
                        onchange="document.getElementById('sortForm').submit()"
                        class="px-6 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option value="latest">Sort by: Popular Class</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @forelse($courses as $course)
                <div class="course-card bg-white rounded-2xl overflow-hidden shadow-md">

                    <!-- Course Image with Icon -->
                    <div class="relative bg-gradient-to-br from-blue-700 to-blue-900 h-48 flex items-center justify-center">
                        @php
                            // Map course categories to icons and colors
                            $courseIcons = [
                                'angular' => ['icon' => 'fab fa-angular', 'color' => 'text-red-600', 'bg' => 'bg-white'],
                                'aws' => ['icon' => 'fab fa-aws', 'color' => 'text-orange-400', 'bg' => 'bg-gray-900'],
                                'vue' => ['icon' => 'fab fa-vuejs', 'color' => 'text-green-500', 'bg' => 'bg-gray-900'],
                                'python' => ['icon' => 'fab fa-python', 'color' => 'text-blue-500', 'bg' => 'bg-white'],
                                'react' => ['icon' => 'fab fa-react', 'color' => 'text-blue-400', 'bg' => 'bg-gray-900'],
                                'default' => ['icon' => 'fas fa-graduation-cap', 'color' => 'text-white', 'bg' => 'bg-blue-600']
                            ];

                            $icon = $courseIcons[strtolower($course->category)] ?? $courseIcons['default'];
                        @endphp

                        <div class="w-32 h-32 {{ $icon['bg'] }} rounded-2xl flex items-center justify-center">
                            <i class="{{ $icon['icon'] }} text-6xl {{ $icon['color'] }}"></i>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 text-center">{{ $course->title }}</h3>
                        <p class="text-sm text-gray-600 mb-4 text-center h-12 overflow-hidden">
                            {{ Str::limit($course->description, 80) }}
                        </p>

                        <!-- Course Stats -->
                        <div class="flex items-center justify-center gap-6 mb-4">
                            <div class="flex items-center gap-1 text-gray-600 text-sm">
                                <i class="far fa-clock text-orange-500"></i>
                                <span>{{ $course->duration }} Hours</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-600 text-sm">
                                <i class="far fa-user text-orange-500"></i>
                                <span>Good Start</span>
                            </div>
                        </div>

                        <!-- Enroll Button -->
                        @if($course->status === 'opened')
                            <a href="{{ route('student.courses.show', $course->slug) }}"
                               class="block w-full py-3 bg-orange-500 text-white text-center rounded-full hover:bg-orange-600 transition">
                                <i class="fas fa-download mr-2"></i>
                                Download Certificate
                            </a>
                        @elseif($course->status === 'coming_soon')
                            <button disabled class="block w-full py-3 bg-gray-300 text-gray-500 text-center rounded-full cursor-not-allowed">
                                <i class="fas fa-clock mr-2"></i>
                                Coming Soon
                            </button>
                        @else
                            <button disabled class="block w-full py-3 bg-gray-300 text-gray-500 text-center rounded-full cursor-not-allowed">
                                <i class="fas fa-archive mr-2"></i>
                                Archived
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No courses found</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center gap-2">
            {{ $courses->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-12 mt-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <!-- Logo & Description -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-blue-800 text-xl font-bold">EZY</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">EZY Skills</h3>
                            <p class="text-xs text-blue-200">Online Courses</p>
                        </div>
                    </div>
                    <p class="text-blue-200 mb-6">
                        Let Us build your career together! Be the first person to transform yourself with our unique & world class corporate level trainings.
                    </p>

                    <!-- Newsletter -->
                    <div>
                        <h4 class="font-semibold mb-3">Subscribe Our Newsletter</h4>
                        <div class="flex gap-2">
                            <input
                                type="email"
                                placeholder="Your Email address..."
                                class="flex-1 px-4 py-2 rounded-lg text-gray-800 focus:outline-none"
                            >
                            <button class="px-6 py-2 bg-orange-500 rounded-lg hover:bg-orange-600">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold text-lg mb-6">Quick <span class="text-orange-400">Links</span></h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-blue-200 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white">Our Story</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white">Best Courses</a></li>
                        <li><a href="{{ route('faq') }}" class="text-blue-200 hover:text-white">Why FAQs</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white">Cancellation & Refunds</a></li>
                        <li><a href="{{ route('contact') }}" class="text-blue-200 hover:text-white">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Us -->
                <div>
                    <h4 class="font-bold text-lg mb-6">Contact <span class="text-orange-400">Us</span></h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-orange-400 mt-1"></i>
                            <span class="text-blue-200">Nowakethon Complex, 5th floor, 905, A&P opp. Clock Tower, SG Road, Secundrabad, Telangana 500003</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-orange-400"></i>
                            <span class="text-blue-200">info@ezyskills.in</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-phone text-orange-400 mt-1"></i>
                            <div>
                                <p class="text-blue-200">+91 8328448903</p>
                                <p class="text-blue-200">+91 9475484889</p>
                            </div>
                        </li>
                    </ul>

                    <!-- Social Media -->
                    <div class="flex gap-4 mt-6">
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center hover:bg-blue-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center hover:bg-blue-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center hover:bg-blue-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center hover:bg-blue-600">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center hover:bg-blue-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-blue-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-200 text-sm">© 2025 EZY Skills. All rights reserved.</p>
                <div class="flex gap-6 text-sm">
                    <a href="#" class="text-blue-200 hover:text-white">Terms & Conditions</a>
                    <a href="#" class="text-blue-200 hover:text-white">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
