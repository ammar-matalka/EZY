<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::all();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image')->store('certifications', 'public');

        Certification::create([
            'title' => $request->title,
            'image' => $image
        ]);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification added!');
    }

    public function destroy($id)
    {
        $cert = Certification::findOrFail($id);
        $cert->delete();

        return back()->with('success', 'Certification deleted!');
    }
}
