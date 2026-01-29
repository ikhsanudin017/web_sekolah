<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - {{ config('app.name', 'Website Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
</head>
<body class="relative min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-50 text-gray-800">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -left-16 w-72 h-72 bg-blue-200 rounded-full blur-3xl opacity-45"></div>
        <div class="absolute bottom-10 right-0 w-[26rem] h-[26rem] bg-blue-100 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute top-1/3 right-1/4 w-56 h-56 bg-blue-50 rounded-full blur-2xl opacity-80"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-5xl">
            <div class="grid lg:grid-cols-2 gap-8 items-stretch">
                <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-blue-800 via-blue-600 to-blue-400 text-white rounded-3xl shadow-2xl p-10 relative overflow-hidden">
                    <div class="absolute inset-0" aria-hidden="true">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/30"></div>
                        <div class="absolute -right-10 -top-8 w-52 h-52 border border-white/40 rounded-full"></div>
                        <div class="absolute -left-14 bottom-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-12 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                    <div class="relative space-y-4">
                        <p class="text-sm uppercase tracking-[0.2em] font-semibold text-white/85">Mulai Bergabung</p>
                        <h1 class="text-3xl font-bold leading-tight">Buat Akun Baru</h1>
                        <p class="text-white/90">Akses portal sekolah untuk mengelola konten, memantau PPDB, dan mendapatkan notifikasi terbaru.</p>
                    </div>
                    <div class="relative grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-white/10 p-4 shadow-inner">
                            <p class="text-sm font-semibold">Daftar kilat</p>
                            <p class="text-xs text-white/85">Isi data singkat, langsung siap pakai.</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 p-4 shadow-inner">
                            <p class="text-sm font-semibold">Dukungan admin</p>
                            <p class="text-xs text-white/85">Tim siap membantu bila ada kendala.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur rounded-3xl shadow-2xl border border-slate-100 p-8 sm:p-10 flex flex-col gap-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-blue-600">Registrasi Akun</p>
                            <h2 class="text-2xl font-bold text-gray-900 mt-1">Lengkapi data Anda</h2>
                        </div>
                        <div class="h-11 w-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
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

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-800">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    value="{{ old('name') }}"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('name') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Nama lengkap Anda">
                            </div>
                            @error('name')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-800">
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
                                    autocomplete="email"
                                    value="{{ old('email') }}"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('email') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-800">
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
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('password') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            @error('password')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @else
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    Password minimal 8 karakter
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-800">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white @error('password_confirmation') border-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Ulangi password">
                            </div>
                            @error('password_confirmation')
                                <p class="text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex items-center h-5 mt-0.5">
                                <input
                                    id="terms"
                                    name="terms"
                                    type="checkbox"
                                    required
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                            </div>
                            <label for="terms" class="block text-sm text-gray-700 cursor-pointer leading-relaxed">
                                Saya menyetujui
                                <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors underline decoration-1 underline-offset-2">syarat dan ketentuan</a>.
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-800 via-blue-600 to-blue-400 hover:from-blue-900 hover:via-blue-700 hover:to-blue-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg hover:shadow-2xl transform hover:scale-[1.01] active:scale-[0.99]">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Daftar Sekarang
                            </span>
                        </button>

                        <p class="text-sm text-gray-600 text-center">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                                Masuk di sini
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
