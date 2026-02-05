<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Certification;
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

        // Get certifications
        $certifications = Certification::all();

        // Statistics
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'courses' => Course::where('status', 'opened')->count(),
            'instructors' => User::where('role', 'teacher')->count(),
        ];

        return view('home.index', compact(
            'featuredCourses',
            'topInstructors',
            'stats',
            'certifications'
        ));
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

    /**
     * Display courses page (public).
     */
    public function courses(Request $request)
    {
        $query = Course::with('teacher');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'opened');
        }

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $courses = $query->paginate(12);

        // Get categories for filter
        $categories = Course::where('status', 'opened')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('home.courses', compact('courses', 'categories'));
    }
}
