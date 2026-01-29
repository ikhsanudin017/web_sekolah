<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $settings = SchoolSetting::first();
        
        return view('pages.about', compact('settings'));
    }
}
