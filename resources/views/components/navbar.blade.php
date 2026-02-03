<nav class="bg-white shadow-sm">
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
                <a href="{{ route('courses') }}"
                    class="text-gray-700 hover:text-orange-500 transition font-medium">Courses</a>
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
                            <button id="settings-button"
                                class="text-gray-600 hover:text-orange-500 transition p-2 rounded-full hover:bg-orange-50">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            <!-- القائمة المنسدلة -->
                            <div id="settings-menu"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 hidden border border-gray-200">
                                <a href="{{ route('student.dashboard') }}"
                                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                                <a href=""
                                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    My Profile
                                </a>
                                <a href=""
                                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Settings
                                </a>
                                <div class="border-t my-2"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                        Logout
                                    </button>
                                </form>

                            </div>
                        </div>

                        <!-- صورة البروفايل -->
                        <a href="{{ route('student.dashboard') }}"
                            class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 transition">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                    class="w-10 h-10 rounded-full border-2 border-orange-500">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript للتحكم في القائمة المنسدلة -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const settingsButton = document.getElementById('settings-button');
        const settingsMenu = document.getElementById('settings-menu');

        if (settingsButton && settingsMenu) {
            // عند النقر على أيقونة الإعدادات
            settingsButton.addEventListener('click', function (event) {
                event.stopPropagation(); // منع إغلاق القائمة مباشرة
                settingsMenu.classList.toggle('hidden');
            });

            // إغلاق القائمة عند النقر في أي مكان آخر
            document.addEventListener('click', function (event) {
                if (!settingsMenu.contains(event.target) && !settingsButton.contains(event.target)) {
                    settingsMenu.classList.add('hidden');
                }
            });

            // إغلاق القائمة عند النقر على أي عنصر داخلها
            settingsMenu.addEventListener('click', function (event) {
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
            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
