{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EzySkills')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!--  Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    @include('components.navbar')
    <!-- Navbar -->
{{-- <nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="EzySkills" class="h-14 w-auto mr-3">
                </a>
            </div>

            <!-- Navigation Links فقط -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-orange-500 transition font-medium">Home</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">Course Selector</a>
                <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-orange-500 transition font-medium">Courses</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">Pricing</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">FAQ</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">Contact US</a>
            </div>

            <!-- زر الـ CTA (Call to Action) -->
            <div class="hidden lg:block">
                @auth
                    <!-- إذا المستخدم مسجل دخول - أيقونة الإعدادات أولاً ثم صورة البروفايل -->
                    <div class="flex items-center space-x-4">
                        <!-- أيقونة الإعدادات مع القائمة المنسدلة -->
                        <div class="relative">
                            <button id="settings-button" class="text-gray-600 hover:text-orange-500 transition p-2 rounded-full hover:bg-orange-50">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>

                            <!-- القائمة المنسدلة -->
                            <div id="settings-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 hidden border border-gray-200">
                                <a href="{{ route('student.dashboard') }}"
                                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href=""
                                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    My Profile
                                </a>
                                <a href=""
                                   class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Settings
                                </a>
                                <div class="border-t my-2"></div>
                                <form action="" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- صورة البروفايل -->
                        <a href="{{ route('student.dashboard') }}" class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 transition">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                     alt="{{ auth()->user()->name }}"
                                     class="w-10 h-10 rounded-full border-2 border-orange-500">
                            @else
                                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </a>
                    </div>
                @else
                    <!-- إذا المستخدم مش مسجل - زر Get Started -->
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-medium shadow-md">
                        Get Started
                    </a>
                @endauth
            </div>

            <!-- زر القائمة للموبايل -->
            <div class="lg:hidden">
                <button id="mobile-menu-button" class="text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript للتحكم في القائمة المنسدلة -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const settingsButton = document.getElementById('settings-button');
        const settingsMenu = document.getElementById('settings-menu');

        if (settingsButton && settingsMenu) {
            // عند النقر على أيقونة الإعدادات
            settingsButton.addEventListener('click', function(event) {
                event.stopPropagation(); // منع إغلاق القائمة مباشرة
                settingsMenu.classList.toggle('hidden');
            });

            // إغلاق القائمة عند النقر في أي مكان آخر
            document.addEventListener('click', function(event) {
                if (!settingsMenu.contains(event.target) && !settingsButton.contains(event.target)) {
                    settingsMenu.classList.add('hidden');
                }
            });

            // إغلاق القائمة عند النقر على أي عنصر داخلها
            settingsMenu.addEventListener('click', function(event) {
                if (event.target.tagName === 'A' || event.target.tagName === 'BUTTON') {
                    setTimeout(() => {
                        settingsMenu.classList.add('hidden');
                    }, 100);
                }
            });
        }

        // كود القائمة الموبايل
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script> --}}

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
<!-- Footer -->
{{-- <footer class="bg-blue-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Left Column - Brand Info & Newsletter -->
            <div class="lg:col-span-2">
                <!-- Logo and Title -->
                <div class="flex items-center mb-3">
                    <img src="/images/logo footer.png" alt="EZY SKILLS Logo" class="h-20 w-auto">

                </div>

                <!-- Description -->
                <p class="text-gray-300 mb-8 leading-relaxed">
                    Let Us build your career together Be the first person to transform yourself with our unique & world class corporate level trainings.
                </p>

                <!-- Newsletter Subscription -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Subscribe Our Newsletter</h3>
                    <div class="flex max-w-md">
                    <input type="email" placeholder="Your Email address"
    class="flex-1 px-4 py-3 rounded-l-lg bg-blue-800 text-white placeholder-gray-300 border border-blue-700 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                        <button class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-r-lg transition font-medium text-white">
                            →
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h3 class="text-2xl font-bold  mb-6">Quick <span class="text-orange-400">Links</span></h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Our Story</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Best Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Your FAQ's</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Cancellation & Refunds</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-white transition flex items-center">
                            <span>Contact US</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info Column -->
            <div>
                <h3 class="text-2xl font-bold  mb-6">Contact <span class="text-orange-400">Us</span></h3>
                <div class="space-y-4 text-gray-300">
                    <!-- Address -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="leading-relaxed">
                            Navakethan Complex,<br>
                            6th Floor, 605, 606 A&P opp,<br>
                            Clock Tower, SD Road,<br>
                            Secunderabad, Telangana<br>
                            500003
                        </p>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:info@ezyskills.in" class="hover:text-white transition">info@ezyskills.in</a>
                    </div>

                    <!-- Phone Numbers -->
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div class="leading-relaxed">
                            <p>+91 8428448903</p>
                            <p>+91 9475484959</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- السطر الأخير: Privacy Policy على اليسار والسوشيال على اليمين -->
        <div class="mt-8 pt-6 ">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Privacy Policy على اليسار -->
                <div class="text-gray-400 text-sm mb-4 md:mb-0">
                    <a href="#" class="hover:text-white transition mr-6">Terms & Conditions</a>
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                </div>

                <!-- السوشيال ميديا على اليمين -->
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-orange-400 transition">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-orange-400 transition">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-orange-400 transition">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-orange-400 transition">
                        <i class="fab fa-linkedin-in text-lg"></i>
                    </a>
                    <a href="#" class="text-white hover:text-orange-400 transition">
                        <i class="fab fa-youtube text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer> --}}

{{-- </body>

</html> --}} --}}
