<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin dengan validasi role.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->withInput();
        }

        // Pastikan role admin
        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return back()
                ->withErrors(['email' => 'Akun ini tidak memiliki akses admin.'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}
