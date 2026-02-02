@extends('layouts.guest')

@section('title', 'Log In - EzySkills')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Side - Login Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12">
                <h2 class="text-3xl font-bold text-blue-900 mb-8">
                    Log In
                </h2>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="Email Address"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">
                            Remember Me
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition font-semibold text-lg mb-4"
                    >
                        Login
                    </button>

                    <!-- Register Link -->
                    <div class="text-center text-sm text-gray-600 mb-6">
                        Already Created?
                        <a href="{{ route('register') }}" class="text-blue-900 font-semibold hover:underline">Login Here</a>
                    </div>

                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or</span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="space-y-3">
                        <!-- Google -->
                        <button
                            type="button"
                            class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition"
                        >
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                <path fill="#EA4335" d="M5.26620003,9.76452941 C6.19878754,6.93863203 8.85444915,4.90909091 12,4.90909091 C13.6909091,4.90909091 15.2181818,5.50909091 16.4181818,6.49090909 L19.9090909,3 C17.7818182,1.14545455 15.0545455,0 12,0 C7.27006974,0 3.1977497,2.69829785 1.23999023,6.65002441 L5.26620003,9.76452941 Z"/>
                                <path fill="#34A853" d="M16.0407269,18.0125889 C14.9509167,18.7163016 13.5660892,19.0909091 12,19.0909091 C8.86648613,19.0909091 6.21911939,17.076871 5.27698177,14.2678769 L1.23746264,17.3349879 C3.19279051,21.2936293 7.26500293,24 12,24 C14.9328362,24 17.7353462,22.9573905 19.834192,20.9995801 L16.0407269,18.0125889 Z"/>
                                <path fill="#4A90E2" d="M19.834192,20.9995801 C22.0291676,18.9520994 23.4545455,15.903663 23.4545455,12 C23.4545455,11.2909091 23.3454545,10.5818182 23.1818182,9.90909091 L12,9.90909091 L12,14.4545455 L18.4363636,14.4545455 C18.1187732,16.013626 17.2662994,17.2212117 16.0407269,18.0125889 L19.834192,20.9995801 Z"/>
                                <path fill="#FBBC05" d="M5.27698177,14.2678769 C5.03832634,13.556323 4.90909091,12.7937589 4.90909091,12 C4.90909091,11.2182781 5.03443647,10.4668121 5.26620003,9.76452941 L1.23999023,6.65002441 C0.43658717,8.26043162 0,10.0753848 0,12 C0,13.9195484 0.444780743,15.7301709 1.23746264,17.3349879 L5.27698177,14.2678769 Z"/>
                            </svg>
                            <span class="text-gray-700 font-medium">Login with Google</span>
                        </button>

                        <!-- Facebook -->
                        <button
                            type="button"
                            class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="font-medium">Login with Facebook</span>
                        </button>

                        <!-- Apple -->
                        <button
                            type="button"
                            class="w-full flex items-center justify-center px-4 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition"
                        >
                            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                            </svg>
                            <span class="font-medium">Login with Apple</span>
                        </button>
                    </div>

                    <!-- Terms -->
                    <div class="mt-6 text-center text-xs text-gray-500">
                        By continuing, you agree to the
                        <a href="#" class="text-blue-900 hover:underline">Terms of Service</a>
                        and
                        <a href="#" class="text-blue-900 hover:underline">Privacy Policy</a>
                    </div>
                </form>
            </div>

            <!-- Right Side - Illustration -->
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative">
                    <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full opacity-20"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-orange-500 rounded-full opacity-20"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-blue-200 rounded-full opacity-30"></div>

                    <!-- Main illustration container -->
                    <div class="relative z-10 w-full max-w-lg">
                        <svg viewBox="0 0 500 500" class="w-full h-full">
                            <!-- Screen/Device -->
                            <rect x="80" y="80" width="340" height="280" rx="15" fill="#FF7043" opacity="0.9"/>
                            <rect x="100" y="100" width="300" height="240" rx="10" fill="#FFE0B2"/>

                            <!-- Code symbols -->
                            <text x="130" y="160" font-size="40" fill="#FF7043">&lt;/&gt;</text>
                            <line x1="200" y1="130" x2="300" y2="130" stroke="#FF7043" stroke-width="8"/>
                            <line x1="200" y1="170" x2="320" y2="170" stroke="#FF7043" stroke-width="8"/>
                            <line x1="200" y1="210" x2="280" y2="210" stroke="#FF7043" stroke-width="8"/>

                            <!-- Person 1 (sitting) -->
                            <circle cx="150" cy="400" r="30" fill="#2C3E50"/>
                            <rect x="130" y="430" width="40" height="60" rx="5" fill="#0D47A1"/>
                            <rect x="120" y="490" width="60" height="40" rx="5" fill="#1976D2"/>

                            <!-- Laptop -->
                            <rect x="180" y="460" width="80" height="50" rx="5" fill="#0D47A1"/>

                            <!-- Person 2 (standing) -->
                            <circle cx="380" cy="350" r="30" fill="#2C3E50"/>
                            <rect x="360" y="380" width="40" height="80" rx="5" fill="#BDBDBD"/>
                            <rect x="350" y="460" width="60" height="40" rx="5" fill="#757575"/>

                            <!-- Floating icons -->
                            <circle cx="100" cy="200" r="25" fill="#FFA726"/>
                            <text x="88" y="213" font-size="20">🔒</text>

                            <rect x="400" y="180" width="50" height="50" rx="8" fill="#003D82"/>
                            <text x="410" y="213" font-size="24">#</text>

                            <circle cx="420" cy="380" r="20" fill="#42A5F5"/>
                            <text x="410" y="390" font-size="20">👤</text>

                            <!-- Search icon -->
                            <circle cx="350" cy="120" r="25" fill="white" stroke="#757575" stroke-width="3"/>
                            <line x1="368" y1="138" x2="385" y2="155" stroke="#757575" stroke-width="5"/>

                            <!-- Chat bubbles -->
                            <rect x="50" y="300" width="100" height="40" rx="20" fill="#0D47A1" opacity="0.8"/>
                            <rect x="350" y="250" width="120" height="40" rx="20" fill="#E0E0E0"/>

                            <!-- Play button -->
                            <circle cx="250" cy="450" r="30" fill="#0D47A1"/>
                            <polygon points="245,440 245,460 265,450" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
