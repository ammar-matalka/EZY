<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display student's certificates.
     */
    public function index()
    {
        $student = auth()->user();

        $certificates = $student->certificates()
            ->with('course')
            ->latest()
            ->paginate(12);

        return view('student.certificates.index', compact('certificates'));
    }

    /**
     * Download certificate.
     */
    public function download(Certificate $certificate)
    {
        // Ensure student owns this certificate
        if ($certificate->student_id !== auth()->id()) {
            abort(403);
        }

        // Generate PDF (will be implemented later)
        // For now, redirect back
        return redirect()->back()
            ->with('info', 'Certificate download feature coming soon!');
    }
}
