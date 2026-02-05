<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, Plan $plan)
    {
        $user = auth()->user();

        if (!$user->isStudent()) {
            return back()->with('error', 'Only students can subscribe.');
        }

        if ($user->activeSubscription()->exists()) {
            return back()->with('error', 'You already have an active subscription.');
        }

     $user->subscriptions()->create([
    'plan_id' => $plan->id,
    'courses_limit' => $plan->courses_limit,
    'courses_selected' => 0,
    'status' => 'active',
    'starts_at' => now(),
    'expires_at' => now()->addMonth(),
]);


        return redirect()->route('student.dashboard')->with('success', 'Plan activated successfully!');
    }
}
