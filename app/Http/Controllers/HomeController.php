<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get featured courses (opened courses)
        $featuredCourses = Course::where('status', 'opened')
            ->with('teacher')
            ->take(8)
            ->get();

        // Get top instructors (teachers with highest ratings)
        $topInstructors = User::where('role', 'teacher')
            ->where('rating', '>', 0)
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        // Statistics
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'courses' => Course::where('status', 'opened')->count(),
            'instructors' => User::where('role', 'teacher')->count(),
        ];

        return view('home.index', compact('featuredCourses', 'topInstructors', 'stats'));
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('home.about');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('home.contact');
    }

    /**
     * Display pricing page.
     */
    public function pricing()
    {
        return view('home.pricing');
    }

    /**
     * Display FAQ page.
     */
    public function faq()
    {
        return view('home.faq');
    }
}
