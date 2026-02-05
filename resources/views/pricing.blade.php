@extends('layouts.app')

@section('title', 'Pricing')

@section('content')

<!-- Flash Messages -->
@if(session('error'))
    <div class="fixed top-24 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg"
         x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="fixed top-24 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg"
         x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)">
        {{ session('success') }}
    </div>
@endif

<!-- Blue Header Section -->
<div class="bg-[#003F7D] w-full pt-32 pb-64 md:pb-80 px-4 relative">

    <div class="max-w-7xl mx-auto text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-show="show"
            x-transition:enter="transition ease-out duration-600"
            x-transition:enter-start="opacity-0 -translate-y-5"
            x-transition:enter-end="opacity-100 translate-y-0">
            Our <span class="text-orange-500">Pricing</span>
        </h1>
        <p class="text-blue-100 text-lg max-w-2xl mx-auto">
            Choose the perfect plan for your learning journey
        </p>
    </div>

    <!-- Diagonal Wave Decoration -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-[150px] md:h-[250px] fill-white">
            <path d="M0,64L80,74.7C160,85,320,107,480,106.7C640,107,800,85,960,69.3C1120,53,1280,43,1360,37.3L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</div>

<!-- Pricing Cards Grid -->
<div class="max-w-7xl mx-auto px-4 -mt-40 md:-mt-64 relative z-20 pb-32">
    <div class="relative">

        <!-- Left Dots Decoration -->
        <div class="absolute -left-20 top-1/2 hidden xl:grid grid-cols-4 gap-4 opacity-70">
            @for($i = 0; $i < 16; $i++)
                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
            @endfor
        </div>

        <!-- Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-center"
             x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 200)">

            @foreach($plans as $index => $plan)
                <!-- Pricing Card -->
                <div x-show="show"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     style="transition-delay: {{ $index * 100 }}ms;"
                     class="relative flex flex-col bg-white rounded-[30px] shadow-xl transition-all duration-300 w-full max-w-[320px] mx-auto {{ $plan->is_highlighted ? 'lg:scale-105 lg:-translate-y-4 z-20 border-2 border-orange-500/10' : 'lg:scale-100 z-10' }}">

                    <!-- Top Area - Orange -->
                    <div class="p-6 pb-24 flex flex-col items-center text-white relative bg-orange-500 rounded-t-[30px]">
                        <!-- Plan Badge -->
                        <div class="bg-white text-orange-500 px-12 py-3 rounded-xl text-center font-bold text-xs -mt-12 mb-8 shadow-lg relative z-30 transform hover:scale-105 transition-transform">
                            {{ $plan->name }}
                        </div>

                        <!-- Price Section -->
                        <div class="text-center -mt-2 flex flex-col items-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <span class="text-3xl font-bold">$</span>
                                <span class="text-5xl font-extrabold tracking-tight">
                                    {{ number_format($plan->price) }}
                                </span>
                                <span class="text-sm font-bold mt-auto mb-2.5 text-white">+ Tax</span>
                            </div>
                            <p class="text-sm mt-1 font-medium text-white/90">
                                (Exclusive of GST & Taxes)
                            </p>
                        </div>

                        <!-- Courses Count Badge -->
                        <div class="mt-4 bg-white/20 px-4 py-2 rounded-full">
                            <span class="text-sm font-bold">
                                @if($plan->courses_limit >= 999)
                                    Unlimited Courses
                                @else
                                    {{ $plan->courses_limit }} Courses
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Bottom Area - White -->
                    <div class="flex-grow p-8 pb-6 flex flex-col -mt-5 bg-white rounded-b-[30px] relative z-10 shadow-[0_-10px_20px_rgba(0,0,0,0.05)]">

                        <!-- Features -->
                        <div class="space-y-6 mb-8 mt-2">
                            @foreach($plan->features as $feature)
                                <div class="flex items-center gap-4">
                                    <div class="text-gray-600 p-2 bg-gray-100 rounded-lg">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-bold text-gray-900 leading-snug">
                                        {{ $feature->text }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- CTA Button -->
                        <div class="mt-auto flex flex-col items-center">
                            @auth
                                @if(auth()->user()->hasActiveSubscription())
                                    <span class="w-full py-3 px-6 rounded-xl bg-gray-300 text-gray-600 font-bold text-sm text-center mb-4">
                                        Already Subscribed
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('subscribe', $plan->id) }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full py-3 px-6 rounded-xl bg-orange-500 text-white font-bold text-sm hover:bg-orange-600 shadow-md transition-all mb-4">
                                            Choose Plan
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full py-3 px-6 rounded-xl bg-orange-500 text-white font-bold text-sm hover:bg-orange-600 shadow-md transition-all mb-4 text-center">
                                    Login to Subscribe
                                </a>
                            @endauth

                            <!-- Payment Logo -->
                            <div class="w-20 opacity-60 hover:opacity-100 transition-opacity">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Razorpay_logo.svg" alt="Secure Payments" class="w-full h-auto object-contain grayscale brightness-50">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Right Dots Decoration -->
        <div class="absolute -right-20 top-1/2 hidden xl:grid grid-cols-4 gap-4 opacity-70">
            @for($i = 0; $i < 16; $i++)
                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
            @endfor
        </div>
    </div>
</div>

@endsection
