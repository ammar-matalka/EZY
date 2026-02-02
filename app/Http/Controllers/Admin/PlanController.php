<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of plans.
     */
    public function index()
    {
        $plans = Plan::withCount('subscriptions')
            ->orderBy('price')
            ->get();

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'courses_limit' => ['required', 'integer', 'min:1'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ]);

        Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'courses_limit' => $request->courses_limit,
            'features' => $request->features ?? [],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully!');
    }

    /**
     * Display the specified plan.
     */
    public function show(Plan $plan)
    {
        $plan->load(['subscriptions.student']);

        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'courses_limit' => ['required', 'integer', 'min:1'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ]);

        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'courses_limit' => $request->courses_limit,
            'features' => $request->features ?? [],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully!');
    }

    /**
     * Remove the specified plan from storage.
     */
    public function destroy(Plan $plan)
    {
        // Check if plan has active subscriptions
        if ($plan->subscriptions()->where('status', 'active')->exists()) {
            return redirect()->route('admin.plans.index')
                ->with('error', 'Cannot delete plan with active subscriptions!');
        }

        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully!');
    }
}
