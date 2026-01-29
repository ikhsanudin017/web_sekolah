<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SchoolSetting::first();
        $galleries = Gallery::where('is_published', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('category');
        
        return view('pages.gallery', compact('galleries', 'settings'));
    }
}
