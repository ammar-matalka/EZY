<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========== Guest/Public Routes ==========

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// ========== Authentication Routes ==========

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Register (Students only)
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ========== Admin Routes ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('users/role/{role}', [\App\Http\Controllers\Admin\UserController::class, 'getByRole'])->name('users.by-role');

    // Course Management
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);

    // Plan Management
    Route::resource('plans', \App\Http\Controllers\Admin\PlanController::class);

    // Enrollment Management
    Route::get('enrollments', [\App\Http\Controllers\Admin\EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::delete('enrollments/{enrollment}', [\App\Http\Controllers\Admin\EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});

// ========== Teacher Routes ==========
Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('dashboard');

    // Course Management
    Route::resource('courses', \App\Http\Controllers\Teacher\CourseController::class);

    // Module Management
    Route::get('courses/{course}/modules/create', [\App\Http\Controllers\Teacher\ModuleController::class, 'create'])->name('modules.create');
    Route::post('courses/{course}/modules', [\App\Http\Controllers\Teacher\ModuleController::class, 'store'])->name('modules.store');
    Route::get('courses/{course}/modules/{module}/edit', [\App\Http\Controllers\Teacher\ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('courses/{course}/modules/{module}', [\App\Http\Controllers\Teacher\ModuleController::class, 'update'])->name('modules.update');
    Route::delete('courses/{course}/modules/{module}', [\App\Http\Controllers\Teacher\ModuleController::class, 'destroy'])->name('modules.destroy');

    // Project Management
    Route::get('courses/{course}/projects/create', [\App\Http\Controllers\Teacher\ProjectController::class, 'create'])->name('projects.create');
    Route::post('courses/{course}/projects', [\App\Http\Controllers\Teacher\ProjectController::class, 'store'])->name('projects.store');
    Route::get('courses/{course}/projects/{project}/edit', [\App\Http\Controllers\Teacher\ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('courses/{course}/projects/{project}', [\App\Http\Controllers\Teacher\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('courses/{course}/projects/{project}', [\App\Http\Controllers\Teacher\ProjectController::class, 'destroy'])->name('projects.destroy');

    // Students
    Route::get('students', [\App\Http\Controllers\Teacher\StudentController::class, 'index'])->name('students.index');
});

// ========== Student Routes ==========
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

    // Browse Courses
    Route::get('courses', [\App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses.index');
    Route::get('courses/{course}', [\App\Http\Controllers\Student\CourseController::class, 'show'])->name('courses.show');

    // Plans & Subscription
    Route::get('plans', [\App\Http\Controllers\Student\SubscriptionController::class, 'choosePlan'])->name('plans.choose');
    Route::post('subscribe/{plan}', [\App\Http\Controllers\Student\SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('upgrade', [\App\Http\Controllers\Student\SubscriptionController::class, 'upgrade'])->name('upgrade');

    // Enrollments
    Route::post('enroll/{course}', [\App\Http\Controllers\Student\EnrollmentController::class, 'enroll'])->name('enroll');
    Route::get('my-courses', [\App\Http\Controllers\Student\EnrollmentController::class, 'myCourses'])->name('my-courses');
    Route::get('learn/{enrollment}', [\App\Http\Controllers\Student\EnrollmentController::class, 'learn'])->name('learn');

    // Certificates
    Route::get('certificates', [\App\Http\Controllers\Student\CertificateController::class, 'index'])->name('certificates.index');
    Route::get('certificates/{certificate}/download', [\App\Http\Controllers\Student\CertificateController::class, 'download'])->name('certificates.download');
});


































//////////PROJECT-STRUCTURE//////////////////////////////////////////////////////////
Route::get('/project-structure', function () {
    function listFolderFiles($dir, $prefix = '')
    {
        $ffs = @scandir($dir);
        if (!$ffs)
            return '';

        $output = '';
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                $path = $dir . DIRECTORY_SEPARATOR . $ff;

                // Add icons based on file type
                $icon = is_dir($path) ? '📁' : '📄';
                if (!is_dir($path)) {
                    $ext = pathinfo($ff, PATHINFO_EXTENSION);
                    $icon = match ($ext) {
                        'php' => '🔷',
                        'js' => '📜',
                        'css' => '🎨',
                        'json' => '📋',
                        default => '📄'
                    };
                }

                $output .= $prefix . '├── ' . $icon . ' ' . $ff;

                if (is_dir($path)) {
                    $output .= "/\n" . listFolderFiles($path, $prefix . '│   ');
                } else {
                    $output .= "\n";
                }
            }
        }
        return $output;
    }

    $basePaths = [
        'app/Http/Controllers' => 'Controllers',
        'app/Models' => 'Models',
        'config' => 'Config',
        'database/migrations' => 'Migrations',
        'resources/views' => 'Views',
        'routes' => 'Routes',
    ];

    // Calculate statistics
    function countFiles($dir, $extension = null)
    {
        $count = 0;
        if (!is_dir($dir))
            return 0;

        $items = @scandir($dir);
        if (!$items)
            return 0;

        foreach ($items as $item) {
            if ($item != '.' && $item != '..') {
                $path = $dir . DIRECTORY_SEPARATOR . $item;
                if (is_dir($path)) {
                    $count += countFiles($path, $extension);
                } else {
                    if ($extension === null) {
                        $count++;
                    } else {
                        if (pathinfo($item, PATHINFO_EXTENSION) === $extension) {
                            $count++;
                        }
                    }
                }
            }
        }
        return $count;
    }

    $statistics = [
        'Controllers' => countFiles(base_path('app/Http/Controllers'), 'php'),
        'Models' => countFiles(base_path('app/Models'), 'php'),
        'Migrations' => countFiles(base_path('database/migrations'), 'php'),
        'Seeders' => countFiles(base_path('database/seeders'), 'php'),
        'Views' => countFiles(base_path('resources/views'), 'php'),
        'Routes' => countFiles(base_path('routes'), 'php'),
        'Middleware' => countFiles(base_path('app/Http/Middleware'), 'php'),
        'Config Files' => countFiles(base_path('config'), 'php'),
        'Total PHP Files' => countFiles(base_path('app'), 'php'),
        'CSS Files' => countFiles(base_path('public/css'), 'css') + countFiles(base_path('resources/css'), 'css'),
        'JS Files' => countFiles(base_path('public/js'), 'js') + countFiles(base_path('resources/js'), 'js'),
    ];

    // Get total routes count
    try {
        $routesCount = count(\Route::getRoutes());
        $statistics['Total Routes'] = $routesCount;
    } catch (\Exception $e) {
        $statistics['Total Routes'] = 0;
    }

    // Get database tables count
    try {
        $tables = \DB::select('SHOW TABLES');
        $statistics['Database Tables'] = count($tables);
    } catch (\Exception $e) {
        $statistics['Database Tables'] = 0;
    }

    $structure = '';
    foreach ($basePaths as $path => $label) {
        $structure .= "$label:\n";
        $structure .= listFolderFiles(base_path($path));
        $structure .= "\n\n";
    }

    // Get Laravel info
    $laravelVersion = app()->version();
    $phpVersion = phpversion();

    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>هيكل المشروع - mzrate</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 40px 20px;
                direction: rtl;
            }

            .container {
                max-width: 1400px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                overflow: hidden;
            }

            .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 40px;
                text-align: center;
            }

            .header h1 {
                font-size: 3em;
                margin-bottom: 10px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            }

            .header p {
                font-size: 1.2em;
                opacity: 0.9;
            }

            .info-bar {
                background: #f8f9fa;
                padding: 20px 40px;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                gap: 20px;
                border-bottom: 3px solid #667eea;
            }

            .info-item {
                text-align: center;
            }

            .info-item .label {
                font-size: 0.9em;
                color: #666;
                margin-bottom: 5px;
            }

            .info-item .value {
                font-size: 1.3em;
                font-weight: bold;
                color: #667eea;
            }

            .content {
                padding: 40px;
            }

            .section {
                margin-bottom: 40px;
                background: #f8f9fa;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .section-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 20px 30px;
                font-size: 1.5em;
                font-weight: bold;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .section-body {
                padding: 30px;
            }

            pre {
                background: #1e1e1e;
                color: #d4d4d4;
                padding: 25px;
                border-radius: 10px;
                overflow-x: auto;
                font-family: 'Courier New', Courier, monospace;
                font-size: 14px;
                line-height: 1.6;
                direction: ltr;
                text-align: left;
                box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
            }

            /* Scrollbar styling */
            pre::-webkit-scrollbar {
                height: 10px;
            }

            pre::-webkit-scrollbar-track {
                background: #2d2d2d;
                border-radius: 10px;
            }

            pre::-webkit-scrollbar-thumb {
                background: #667eea;
                border-radius: 10px;
            }

            pre::-webkit-scrollbar-thumb:hover {
                background: #764ba2;
            }

            .footer {
                text-align: center;
                padding: 30px;
                color: #666;
                font-size: 0.9em;
                border-top: 1px solid #eee;
            }

            .copy-btn {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 12px 30px;
                border-radius: 8px;
                font-size: 1em;
                font-weight: bold;
                cursor: pointer;
                margin: 10px 5px;
                transition: all 0.3s;
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }

            .copy-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
            }

            .copy-btn:active {
                transform: translateY(0);
            }

            .success-message {
                display: none;
                background: #4caf50;
                color: white;
                padding: 15px;
                border-radius: 10px;
                margin: 20px 0;
                text-align: center;
                font-weight: bold;
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .btn-group {
                text-align: center;
                margin: 20px 0;
            }

            .statistics {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin: 30px 0;
            }

            .stat-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 25px;
                border-radius: 15px;
                text-align: center;
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            }

            .stat-number {
                font-size: 3em;
                font-weight: bold;
                margin-bottom: 10px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            }

            .stat-label {
                font-size: 1em;
                opacity: 0.95;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .stats-section {
                background: #f8f9fa;
                padding: 40px;
                border-radius: 15px;
                margin-bottom: 40px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .stats-header {
                text-align: center;
                margin-bottom: 30px;
            }

            .stats-header h2 {
                font-size: 2em;
                color: #667eea;
                margin-bottom: 10px;
            }

            .stats-header p {
                color: #666;
                font-size: 1.1em;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- Header -->
            <div class="header">
                <h1>🏗️ هيكل المشروع</h1>
                <p>mzrate - Laravel Property Rental Platform</p>
            </div>

            <!-- Info Bar -->
            <div class="info-bar">
                <div class="info-item">
                    <div class="label">Laravel Version</div>
                    <div class="value"><?php echo $laravelVersion; ?></div>
                </div>
                <div class="info-item">
                    <div class="label">PHP Version</div>
                    <div class="value"><?php echo $phpVersion; ?></div>
                </div>
                <div class="info-item">
                    <div class="label">Environment</div>
                    <div class="value"><?php echo config('app.env'); ?></div>
                </div>
                <div class="info-item">
                    <div class="label">التاريخ</div>
                    <div class="value"><?php echo date('Y-m-d'); ?></div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Statistics Section -->
                <div class="stats-section">
                    <div class="stats-header">
                        <h2>📊 إحصائيات المشروع</h2>
                        <p>نظرة شاملة على عدد الملفات والمكونات</p>
                    </div>

                    <div class="statistics">
                        <?php foreach ($statistics as $label => $count): ?>
                            <div class="stat-card">
                                <div class="stat-number"><?php echo number_format($count); ?></div>
                                <div class="stat-label"><?php echo $label; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="success-message" id="successMessage">
                    ✅ تم النسخ بنجاح!
                </div>

                <div class="btn-group">
                    <button class="copy-btn" onclick="copyToClipboard()">
                        📋 نسخ كل الهيكل
                    </button>
                    <button class="copy-btn" onclick="downloadAsFile()">
                        💾 تحميل كملف
                    </button>
                </div>

                <?php foreach ($basePaths as $path => $label): ?>
                    <div class="section">
                        <div class="section-header">
                            📁 <?php echo $label; ?>
                        </div>
                        <div class="section-body">
                            <pre><?php
                            echo htmlspecialchars(listFolderFiles(base_path($path)));
                            ?></pre>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Generated at <?php echo now()->format('Y-m-d H:i:s'); ?></p>
                <p style="margin-top: 10px; color: #999;">Laravel <?php echo $laravelVersion; ?> | PHP
                    <?php echo $phpVersion; ?></p>
            </div>
        </div>

        <script>
            // Copy all structure to clipboard
            function copyToClipboard() {
                const structure = `<?php echo addslashes($structure); ?>`;

                navigator.clipboard.writeText(structure).then(() => {
                    const msg = document.getElementById('successMessage');
                    msg.style.display = 'block';
                    setTimeout(() => {
                        msg.style.display = 'none';
                    }, 3000);
                }).catch(err => {
                    alert('فشل النسخ: ' + err);
                });
            }

            // Download as text file
            function downloadAsFile() {
                const structure = `<?php echo addslashes($structure); ?>`;
                const blob = new Blob([structure], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'mzrate_structure_<?php echo date('Y-m-d_His'); ?>.txt';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }
        </script>
    </body>

    </html>
    <?php
    return ob_get_clean();
});
//////////////////////////////////////////////////////////////////////////////////////////////
