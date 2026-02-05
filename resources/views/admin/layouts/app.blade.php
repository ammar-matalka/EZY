<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') - EZY Skills</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#003B73',
                            dark: '#002A52',
                            light: '#0056A8',
                        },
                        secondary: {
                            DEFAULT: '#FF8C42',
                            light: '#FFA766',
                        },
                        orange: {
                            DEFAULT: '#FF8C42',
                            light: '#FFA766',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #003B73;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #002A52;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-primary text-white flex-shrink-0 hidden md:block overflow-y-auto">
            <div class="p-6">
                <!-- Logo -->
                <div class="mb-8">
                    <img src="{{ asset('images/logo-white.png') }}" alt="EZY Skills" class="h-12 w-auto">
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-orange text-white' : 'text-gray-300 hover:bg-primary-light' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-orange text-white' : 'text-gray-300 hover:bg-primary-light' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        Users
                    </a>

                    <!-- Courses -->
                  <!-- Certifications -->
<a href="{{ route('admin.certifications.index') }}"
    class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.certifications.*') ? 'bg-orange text-white' : 'text-gray-300 hover:bg-primary-light' }} transition">
    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
    </svg>
    Certifications
</a>


                    <!-- Plans -->
                    <a href="{{ route('admin.plans.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.plans.*') ? 'bg-orange text-white' : 'text-gray-300 hover:bg-primary-light' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                        </svg>
                        Plans
                    </a>

                    <!-- Enrollments -->
                    <a href="{{ route('admin.enrollments.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.enrollments.*') ? 'bg-orange text-white' : 'text-gray-300 hover:bg-primary-light' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        Enrollments
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-600 my-4"></div>

                    <!-- Back to Website -->
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-lg text-gray-300 hover:bg-primary-light transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Back to Website
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="px-6 py-4 flex items-center justify-between">
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-2xl font-bold text-primary">@yield('page-title', 'Dashboard')</h1>

                    <!-- User Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                @if(auth()->user()->avatar)
                                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-white font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200">

                            <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Back to Website
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>
</html>
