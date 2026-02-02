<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display available plans for selection.
     */
    public function choosePlan()
    {
        $plans = Plan::where('is_active', true)
            ->orderBy('price')
            ->get();

        $student = auth()->user();
        $currentSubscription = $student->activeSubscription;

        return view('student.plans.choose', compact('plans', 'currentSubscription'));
    }

    /**
     * Subscribe to a plan.
     */
    public function subscribe(Request $request, Plan $plan)
    {
        $student = auth()->user();

        // Check if already has active subscription
        if ($student->activeSubscription) {
            return redirect()->back()
                ->with('error', 'You already have an active subscription!');
        }

        // Check if plan is active
        if (!$plan->isActive()) {
            return redirect()->back()
                ->with('error', 'This plan is not available!');
        }

        // Create subscription
        $subscription = Subscription::create([
            'student_id' => $student->id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'started_at' => now(),
        ]);

        // Redirect to payment (will be implemented with Razorpay)
        return redirect()->route('payment.process', ['subscription' => $subscription->id])
            ->with('success', 'Please complete your payment!');
    }

    /**
     * Upgrade subscription plan.
     */
    public function upgrade(Request $request)
    {
        $student = auth()->user();
        $currentSubscription = $student->activeSubscription;

        if (!$currentSubscription) {
            return redirect()->route('student.plans.choose')
                ->with('error', 'No active subscription found!');
        }

        $request->validate([
            'plan_id' => ['required', 'exists:plans,id'],
        ]);

        $newPlan = Plan::findOrFail($request->plan_id);

        // Check if new plan is better
        if ($newPlan->price <= $currentSubscription->plan->price) {
            return redirect()->back()
                ->with('error', 'Please select a higher plan!');
        }

        // Calculate price difference
        $priceDifference = $newPlan->price - $currentSubscription->plan->price;

        // Redirect to payment for upgrade
        return redirect()->route('payment.process', [
            'subscription' => $currentSubscription->id,
            'upgrade_to' => $newPlan->id,
            'amount' => $priceDifference
        ])->with('success', 'Please complete your payment for upgrade!');
    }
}
