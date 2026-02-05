<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display pricing page with all plans
     */
    public function index()
    {
        // Get all plans ordered by price
        $plans = Plan::orderBy('price', 'asc')->get();

        return view('pricing', compact('plans'));
    }
}
