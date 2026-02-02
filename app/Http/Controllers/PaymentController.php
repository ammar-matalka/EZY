<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Plan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Process payment.
     */
    public function process(Request $request)
    {
        $subscriptionId = $request->input('subscription');
        $subscription = Subscription::findOrFail($subscriptionId);

        // Ensure user owns this subscription
        if ($subscription->student_id !== auth()->id()) {
            abort(403);
        }

        // Check if upgrading
        $upgradeToId = $request->input('upgrade_to');
        $amount = $request->input('amount');

        if ($upgradeToId) {
            $newPlan = Plan::findOrFail($upgradeToId);
            $amount = $amount ?? $newPlan->price;
        } else {
            $amount = $subscription->plan->price;
        }

        // Create payment record
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'subscription_id' => $subscription->id,
            'amount' => $amount,
            'currency' => 'JOD',
            'payment_method' => 'razorpay',
            'status' => 'pending',
        ]);

        // Razorpay integration will be added here
        // For now, redirect to success (for testing)

        return view('payment.process', compact('payment', 'subscription', 'amount'));
    }

    /**
     * Payment success callback.
     */
    public function success(Request $request)
    {
        // Handle Razorpay success callback
        $paymentId = $request->input('payment_id');
        $transactionId = $request->input('razorpay_payment_id');

        $payment = Payment::findOrFail($paymentId);

        // Mark payment as completed
        $payment->markAsCompleted($transactionId);

        // Activate subscription if not already active
        if ($payment->subscription->status !== 'active') {
            $payment->subscription->update(['status' => 'active']);
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Payment completed successfully!');
    }

    /**
     * Payment cancel callback.
     */
    public function cancel(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $payment = Payment::findOrFail($paymentId);

        // Mark payment as failed
        $payment->markAsFailed();

        return redirect()->route('student.plans.choose')
            ->with('error', 'Payment was cancelled!');
    }
}
