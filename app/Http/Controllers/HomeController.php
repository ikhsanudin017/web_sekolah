<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Teacher;
use App\Models\SchoolSetting;
use App\Models\User;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SchoolSetting::first();
        
        // Latest posts untuk preview
        $latestPosts = Post::where('is_published', true)
            ->with(['category', 'user'])
            ->latest()
            ->take(3)
            ->get();

        // Latest teachers untuk preview
        $latestTeachers = Teacher::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->take(3)
            ->get();

        $stats = [
            'total_students' => User::where('role', 'siswa')->count(),
            'total_teachers' => Teacher::where('is_active', true)->count(),
            'total_posts' => Post::where('is_published', true)->count(),
        ];

        $heroSlides = HeroSlide::where('is_active', true)
            ->orderBy('order')
            ->orderBy('created_at')
            ->take(5)
            ->get();

        return view('welcome', compact('settings', 'latestPosts', 'latestTeachers', 'stats', 'heroSlides'));
    }
}
