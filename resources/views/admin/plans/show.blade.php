@extends('admin.layouts.app')

@section('title', 'Plan Details')
@section('page-title', 'Plan Details')

@section('content')

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.plans.index') }}" class="text-primary hover:text-orange font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
        </svg>
        Back to Plans
    </a>
</div>

<!-- Plan Header Card -->
<div class="bg-white rounded-lg shadow-md p-8 mb-6 {{ $plan->is_popular ? 'ring-2 ring-orange' : '' }}">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            @if($plan->is_popular)
                <div class="inline-block bg-orange text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">
                    ⭐ Most Popular
                </div>
            @endif

            <h1 class="text-4xl font-bold text-primary mb-2">{{ $plan->name }}</h1>

            @if($plan->description)
                <p class="text-gray-600 mb-4">{{ $plan->description }}</p>
            @endif

            <!-- Price & Details -->
            <div class="flex flex-wrap items-center gap-6 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Price</p>
                    <p class="text-3xl font-bold text-orange">${{ number_format($plan->price, 2) }}</p>
                </div>

                <div class="h-12 w-px bg-gray-300"></div>

                <div>
                    <p class="text-sm text-gray-500">Duration</p>
                    <p class="text-2xl font-bold text-primary">{{ $plan->duration_days }} Days</p>
                </div>

                <div class="h-12 w-px bg-gray-300"></div>

                <div>
                    <p class="text-sm text-gray-500">Courses Limit</p>
                    <p class="text-2xl font-bold text-primary">{{ $plan->courses_limit }} Courses</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-2">
            <a href="{{ route('admin.plans.edit', $plan) }}" class="px-4 py-2 bg-orange hover:bg-orange-light text-white rounded-lg font-medium transition">
                Edit Plan
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <!-- Total Subscriptions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Subscriptions</p>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $plan->subscriptions->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Subscriptions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Active</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $plan->subscriptions->where('status', 'active')->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Expired Subscriptions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Expired</p>
                <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $plan->subscriptions->where('status', 'expired')->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                <h3 class="text-3xl font-bold text-orange mt-2">${{ number_format($plan->subscriptions->count() * $plan->price, 2) }}</h3>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Subscribers Table -->
<div class="bg-white rounded-lg shadow-md">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-primary">Subscribers</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Courses Enrolled</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($plan->subscriptions()->with('student')->latest()->get() as $subscription)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-3">
                                    @if($subscription->student->avatar)
                                        <img src="{{ Storage::url($subscription->student->avatar) }}" alt="{{ $subscription->student->name }}" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <span class="text-white font-bold text-sm">{{ substr($subscription->student->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $subscription->student->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $subscription->student->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $subscription->status == 'active' ? 'bg-green-100 text-green-600' : '' }}
                                {{ $subscription->status == 'expired' ? 'bg-red-100 text-red-600' : '' }}
                                {{ $subscription->status == 'cancelled' ? 'bg-gray-100 text-gray-600' : '' }}
                            ">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $subscription->start_date->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $subscription->end_date->format('Y-m-d') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-600">
                                {{ $subscription->student->enrollments()->where('subscription_id', $subscription->id)->count() }} / {{ $plan->courses_limit }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No subscribers yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
