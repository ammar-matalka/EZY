<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EZY Skills</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .stat-card { transition: all 0.25s ease; }
        .stat-card:hover { transform: translateY(-4px); }

        .course-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        .course-card:hover { transform: translateY(-6px); box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12); }

        .progress-bar { transition: width 0.5s ease; }
    </style>
</head>

<body class="bg-gray-50">
@include('components.navbar')

<main class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Welcome -->
        <div class="mb-10">
            <p class="text-gray-600 text-lg">
                Keep learning and improving your skills
            </p>
        </div>

         <div>
                            <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-300">Instructor</p>
                        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-blue-100 text-sm mb-1">Enrolled Courses</p>
                        <h3 class="text-4xl font-extrabold leading-tight">{{ $stats['enrolled_courses'] }}</h3>
                    </div>

                    <div class="w-16 h-16 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-blue-100 text-sm">
                    <span>Keep learning</span>
                </div>
            </div>
        </div>

        <!-- My Courses -->
        <div class="mb-10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">My Courses</h3>

                <a href="{{ route('courses.index') }}"
                   class="text-orange-600 hover:text-orange-700 font-semibold transition">
                    Browse More
                </a>
            </div>

            @if($enrolledCourses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($enrolledCourses as $enrollment)
                        <div class="course-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">

                            <!-- Header -->
                            <div class="relative bg-gradient-to-br from-blue-700 to-blue-900 h-44">
                                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.35),transparent_55%)]"></div>

                                <div class="absolute top-4 right-4 bg-white/15 backdrop-blur px-3 py-1 rounded-full text-white text-xs font-semibold">
                                    {{ $enrollment->progress ?? 0 }}% Complete
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="p-5">
                                <h4 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                    {{ $enrollment->course->title }}
                                </h4>

                                <span class="text-sm text-gray-600">
                                    {{ $enrollment->course->teacher->name }}
                                </span>

                                <!-- Progress -->
                                <div class="mt-4">
                                    <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                        <span>Progress</span>
                                        <span>{{ $enrollment->progress ?? 0 }}%</span>
                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="progress-bar bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full"
                                             style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                    </div>
                                </div>

                                <!-- Meta -->
                                <div class="mt-4 flex items-center justify-between text-xs text-gray-600 pb-4 border-b">
                                    <span class="font-medium">{{ $enrollment->course->duration }} Hours</span>
                                    <span class="font-medium">{{ $enrollment->course->modules->count() }} Modules</span>
                                </div>

                                <!-- Button -->
                                <a href="{{ route('student.learn', $enrollment->id) }}"
                                   class="mt-4 block w-full py-3 bg-orange-500 text-white text-center rounded-xl hover:bg-orange-600 transition font-semibold shadow-sm">
                                    Continue Learning
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900">No Courses Yet</h3>
                    <p class="text-gray-600 mb-6">Start your learning journey now</p>

                    <a href="{{ route('courses.index') }}"
                       class="inline-block px-8 py-3 bg-orange-500 text-white rounded-xl hover:bg-orange-600 transition font-semibold shadow-sm">
                        Browse Courses
                    </a>
                </div>
            @endif
        </div>

    </div>
</main>

@include('components.footer')
</body>
</html>
