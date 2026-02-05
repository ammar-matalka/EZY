<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Course;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    // Subscribe to a plan
    public function subscribe(Plan $plan)
    {
        $user = auth()->user();

        // Check if user already has active subscription
        if ($user->hasActiveSubscription()) {
            return back()->with('error', 'You already have an active subscription.');
        }

        // Create subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'courses_limit' => $plan->courses_limit,
            'courses_selected' => 0,
            'starts_at' => now(),
            'expires_at' => now()->addYear(), // 1 year subscription
            'status' => 'active',
        ]);

        // Redirect to course selection page
        return redirect()->route('subscription.select-courses')
                         ->with('success', "You've subscribed to {$plan->name}! Now select your courses.");
    }

    // Show course selection page
    public function selectCourses(Request $request)
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription;

        if (!$subscription) {
            return redirect()->route('pricing')
                             ->with('error', 'Please subscribe to a plan first.');
        }

        // Get filter parameters
        $status = $request->get('status');
        $search = $request->get('search');
        $sort = $request->get('sort', 'popular');

        // Build courses query
        $query = Course::query();

        // Apply status filter
        if ($status) {
            $query->where('status', $status);
        }

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('title');
                break;
            default: // popular
                $query->orderBy('enrollments_count', 'desc');
        }

        $courses = $query->paginate(12);

        // Get selected course IDs for this subscription
        $selectedCourseIds = $subscription->courses()->pluck('courses.id')->toArray();

        return view('subscription.select-courses', compact(
            'subscription',
            'courses',
            'selectedCourseIds'
        ));
    }

    // Add course to subscription (AJAX) - Cannot be removed once added
    // Add course (AJAX)
public function addCourse(Request $request, $id)
{
    try {
        $user = auth()->user();
        $subscription = $user->activeSubscription;

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'No active subscription found.'
            ], 403);
        }

        // Find the course manually
        $course = \App\Models\Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found.'
            ], 404);
        }

        if ($subscription->hasCourse($course->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You have already enrolled in this course.'
            ], 400);
        }

        if (!$subscription->canSelectMore()) {
            return response()->json([
                'success' => false,
                'message' => "You've reached your limit of {$subscription->courses_limit} courses."
            ], 403);
        }

        $subscription->courses()->attach($course->id, ['enrolled_at' => now()]);
        $subscription->increment('courses_selected');

        return response()->json([
            'success' => true,
            'remaining' => $subscription->fresh()->remainingSlots(),
            'selected' => $subscription->fresh()->courses_selected,
            'message' => 'Course added successfully!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}

    // Confirm course selection
    public function confirmSelection()
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription;

        if (!$subscription || $subscription->courses_selected === 0) {
            return back()->with('error', 'Please select at least one course.');
        }

        return redirect()->route('my-courses')
                         ->with('success', 'Your courses have been confirmed!');
    }

    // View my enrolled courses
    public function myCourses()
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription;

        if (!$subscription) {
            return redirect()->route('pricing')
                             ->with('error', 'Please subscribe to a plan first.');
        }

        $courses = $subscription->courses;

        return view('subscription.my-courses', compact('subscription', 'courses'));
    }
}
