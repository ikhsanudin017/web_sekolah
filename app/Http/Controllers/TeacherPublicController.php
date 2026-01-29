<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherPublicController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SchoolSetting::first();
        $teachers = Teacher::where('is_active', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        return view('pages.teachers', compact('teachers', 'settings'));
    }
}
