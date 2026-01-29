<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20|unique:teachers,nip',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|url',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos/teachers', 'public');
        }

        // Handle media sosial JSON
        $mediaSosial = [];
        if ($request->filled('facebook')) $mediaSosial['facebook'] = $request->facebook;
        if ($request->filled('instagram')) $mediaSosial['instagram'] = $request->instagram;
        if ($request->filled('twitter')) $mediaSosial['twitter'] = $request->twitter;
        if ($request->filled('linkedin')) $mediaSosial['linkedin'] = $request->linkedin;
        
        $validated['media_sosial_json'] = !empty($mediaSosial) ? $mediaSosial : null;
        unset($validated['facebook'], $validated['instagram'], $validated['twitter'], $validated['linkedin']);

        // Default aktif jika tidak dicentang
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $validated['order'] ?? 0;

        Teacher::create($validated);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20|unique:teachers,nip,' . $teacher->id,
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|url',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $validated['photo'] = $request->file('photo')->store('photos/teachers', 'public');
        }

        // Handle media sosial JSON
        $mediaSosial = [];
        if ($request->filled('facebook')) $mediaSosial['facebook'] = $request->facebook;
        if ($request->filled('instagram')) $mediaSosial['instagram'] = $request->instagram;
        if ($request->filled('twitter')) $mediaSosial['twitter'] = $request->twitter;
        if ($request->filled('linkedin')) $mediaSosial['linkedin'] = $request->linkedin;
        
        $validated['media_sosial_json'] = !empty($mediaSosial) ? $mediaSosial : null;
        unset($validated['facebook'], $validated['instagram'], $validated['twitter'], $validated['linkedin']);

        // Default aktif jika tidak dicentang
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $validated['order'] ?? 0;

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // Delete photo if exists
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}

