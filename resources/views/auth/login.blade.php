<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Website Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
</head>
<body class="relative min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 text-gray-800">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-16 -left-20 w-80 h-80 bg-blue-200 rounded-full blur-3xl opacity-45"></div>
        <div class="absolute -bottom-16 right-0 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute top-1/3 right-1/4 w-56 h-56 bg-blue-50 rounded-full blur-2xl opacity-80"></div>
    </div>

    <div class="relative z-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div class="bg-gradient-to-br from-blue-800 via-blue-600 to-blue-400 text-white rounded-3xl shadow-2xl p-8 sm:p-10 relative overflow-hidden">
                    <div class="absolute inset-0" aria-hidden="true">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/30"></div>
                        <div class="absolute -right-6 -top-10 w-44 h-44 border border-white/40 rounded-full"></div>
                        <div class="absolute -left-10 bottom-2 w-56 h-56 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-14 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                    <div class="relative">
                        <p class="text-sm uppercase tracking-[0.2em] font-semibold text-white/80 mb-3">Website Sekolah</p>
                        <h1 class="text-3xl sm:text-4xl font-bold leading-tight mb-4">Selamat Datang Kembali</h1>
                        <p class="text-white/90 mb-6">Masuk ke akun Anda untuk mengelola informasi sekolah, melihat berita, dan memantau data PPDB.</p>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/15 text-white text-sm font-semibold">1</span>
                                <div>
                                    <p class="font-semibold">Akses cepat</p>
                                    <p class="text-sm text-white/80">Informasi terbaru tersaji ringkas setiap kali Anda login.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/15 text-white text-sm font-semibold">2</span>
                                <div>
                                    <p class="font-semibold">Data aman</p>
                                    <p class="text-sm text-white/80">Keamanan berlapis dengan proteksi CSRF dan validasi ketat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl border border-slate-100 p-8 sm:p-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-sm font-semibold text-blue-600">Masuk Akun</p>
                            <h2 class="text-2xl font-bold text-gray-900 mt-1">Silakan login</h2>
                        </div>
                        <div class="h-12 w-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 flex items-start gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                            <svg class="w-5 h-5 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <div>{{ session('status') }}</div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            <div class="flex items-center gap-2 font-semibold mb-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Terjadi kesalahan</span>
                            </div>
                            <ul class="space-y-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    value="{{ old('email') }}"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('email') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('password') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Masukkan password">
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-1 flex-wrap gap-3">
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input
                                    id="remember"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                                <span>Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-800 via-blue-600 to-blue-400 hover:from-blue-900 hover:via-blue-700 hover:to-blue-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg hover:shadow-2xl transform hover:scale-[1.01] active:scale-[0.99]">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Masuk
                            </span>
                        </button>

                        <p class="text-sm text-gray-600 text-center">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                                Daftar sekarang
                            </a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors group">
                    <svg class="w-4 h-4 mr-1.5 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
