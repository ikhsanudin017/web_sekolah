<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SchoolSetting::first();
        return view('pages.ppdb', compact('settings'));
    }
}
