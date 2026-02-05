@php
    $user = auth()->user();
    $dashboardRoute = $user
        ? ($user->role === 'admin'
            ? route('admin.dashboard')
            : ($user->role === 'teacher'
                ? route('teacher.dashboard')
                : route('student.dashboard')))
        : '#';
@endphp

<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="EzySkills" class="h-14 w-auto mr-3">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-orange-500 transition font-medium">Home</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">Course Selector</a>
                <a href="{{ route('courses.index') }}"
                    class="text-gray-700 hover:text-orange-500 transition font-medium">Courses</a>
                <a href="{{ route('pricing') }}"
                    class="text-gray-700 hover:text-orange-500 transition font-medium">Pricing</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">FAQ</a>
                <a href="#" class="text-gray-700 hover:text-orange-500 transition font-medium">Contact US</a>
            </div>

            <!-- Right Side -->
            <div class="hidden lg:block">
                @auth
                    <div class="flex items-center space-x-4">
                        <!-- Settings -->
                        <div class="relative">
                            <button id="settings-button"
                                class="text-gray-600 hover:text-orange-500 transition p-2 rounded-full hover:bg-orange-50">
                                ⚙️
                            </button>

                            <!-- Dropdown -->
                            <div id="settings-menu"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 hidden border border-gray-200">

                                <!-- Dashboard -->
                                <a href="{{ $dashboardRoute }}"
                                    class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                    Dashboard
                                </a>

                                <div class="border-t my-2"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Avatar -->
                        <a href="{{ $dashboardRoute }}" class="flex items-center">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                    class="w-10 h-10 rounded-full border-2 border-orange-500">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </a>
                    </div>
                @else
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-medium shadow-md">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('settings-button');
        const menu = document.getElementById('settings-menu');

        if (btn && menu) {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', () => menu.classList.add('hidden'));
        }
    });
</script>
