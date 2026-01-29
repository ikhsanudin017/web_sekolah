<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('order')->orderBy('created_at')->paginate(10);
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/hero', 'public');
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil ditambahkan.');
    }

    public function edit(HeroSlide $hero_slide)
    {
        return view('admin.hero-slides.edit', ['slide' => $hero_slide]);
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($hero_slide->image) {
                Storage::disk('public')->delete($hero_slide->image);
            }
            $validated['image'] = $request->file('image')->store('images/hero', 'public');
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        $hero_slide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil diperbarui.');
    }

    public function destroy(HeroSlide $hero_slide)
    {
        if ($hero_slide->image) {
            Storage::disk('public')->delete($hero_slide->image);
        }

        $hero_slide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide hero berhasil dihapus.');
    }
}
