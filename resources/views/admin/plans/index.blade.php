@extends('admin.layouts.app')

@section('title', 'Plans Management')
@section('page-title', 'Plans Management')

@section('content')

<!-- Header with Add Button -->
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-primary">Subscription Plans</h2>
        <p class="text-gray-600 mt-1">Manage all subscription plans</p>
    </div>
    <a href="{{ route('admin.plans.create') }}" class="bg-orange hover:bg-orange-light text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Add New Plan
    </a>
</div>

<!-- Plans Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($plans as $plan)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition {{ $plan->is_popular ? 'ring-2 ring-orange' : '' }}">

            <!-- Popular Badge -->
            @if($plan->is_popular)
                <div class="bg-orange text-white text-center py-2 font-semibold text-sm">
                    ⭐ Most Popular
                </div>
            @endif

            <!-- Plan Header -->
            <div class="p-6 text-center {{ $plan->is_popular ? 'bg-gradient-to-br from-orange-50 to-orange-100' : 'bg-gray-50' }}">
                <h3 class="text-2xl font-bold text-primary mb-2">{{ $plan->name }}</h3>
                <div class="text-4xl font-bold text-orange mb-2">
                    ${{ number_format($plan->price, 2) }}
                    <span class="text-lg text-gray-600 font-normal">/ {{ $plan->duration_days }} days</span>
                </div>
                <p class="text-gray-600 text-sm">{{ $plan->courses_limit }} Courses Limit</p>
            </div>

            <!-- Plan Features -->
            <div class="p-6">
                @if($plan->description)
                    <p class="text-gray-600 text-sm mb-4">{{ $plan->description }}</p>
                @endif

                <!-- Features List -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Access to {{ $plan->courses_limit }} courses</span>
                    </div>

                    <div class="flex items-center text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $plan->duration_days }} days access</span>
                    </div>

                    <div class="flex items-center text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Certificate of completion</span>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="border-t border-gray-200 pt-4 mb-4">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Active Subscriptions:</span>
                        <span class="font-semibold text-primary">{{ $plan->subscriptions->where('status', 'active')->count() }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('admin.plans.show', $plan) }}" class="flex-1 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-600 text-center rounded-lg font-medium transition text-sm">
                        View
                    </a>
                    <a href="{{ route('admin.plans.edit', $plan) }}" class="flex-1 px-4 py-2 bg-orange-100 hover:bg-orange-200 text-orange text-center rounded-lg font-medium transition text-sm">
                        Edit
                    </a>
                    <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this plan? All active subscriptions will be affected!')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg font-medium transition text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-3 bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
            </svg>
            <p class="text-gray-500 mb-4">No plans created yet</p>
            <a href="{{ route('admin.plans.create') }}" class="text-orange hover:text-orange-light font-medium">
                Create your first plan →
            </a>
        </div>
    @endforelse
</div>

<!-- Plans Table (Alternative View) -->
@if($plans->count() > 0)
    <div class="bg-white rounded-lg shadow-md mt-8 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-primary">Plans Overview</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Courses Limit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Active Subscriptions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Popular</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($plans as $plan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="font-semibold text-gray-900">{{ $plan->name }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-lg font-bold text-orange">${{ number_format($plan->price, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $plan->duration_days }} days</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $plan->courses_limit }} courses</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                                    {{ $plan->subscriptions->where('status', 'active')->count() }} Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($plan->is_popular)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange">
                                        ⭐ Popular
                                    </span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection
