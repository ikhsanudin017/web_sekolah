<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\PpdbRegistration;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::where('is_published', true)->count(),
            'draft_posts' => Post::where('is_published', false)->count(),
            'total_teachers' => Teacher::count(),
            'active_teachers' => Teacher::where('is_active', true)->count(),
            'total_galleries' => Gallery::count(),
            'total_ppdb' => PpdbRegistration::count(),
            'ppdb_pending' => PpdbRegistration::where('status', 'pending')->count(),
            'ppdb_approved' => PpdbRegistration::where('status', 'diterima')->count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
        ];

        // Eager loading untuk recent posts
        $recent_posts = Post::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Eager loading untuk recent registrations
        $recent_registrations = PpdbRegistration::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_posts', 'recent_registrations'));
    }
}

