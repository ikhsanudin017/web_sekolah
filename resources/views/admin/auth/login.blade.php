<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - {{ config('app.name', 'Website Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
</head>
<body class="min-h-screen bg-slate-950 text-white flex items-center justify-center px-4 py-10 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -left-16 -top-20 w-96 h-96 bg-indigo-600/25 blur-3xl rounded-full"></div>
        <div class="absolute right-0 top-10 w-80 h-80 bg-blue-500/25 blur-3xl rounded-full"></div>
        <div class="absolute -right-16 bottom-0 w-[28rem] h-[28rem] bg-cyan-400/20 blur-3xl rounded-full"></div>
    </div>

    <div class="relative w-full max-w-5xl grid lg:grid-cols-2 bg-white/5 border border-white/10 rounded-[28px] shadow-2xl overflow-hidden backdrop-blur-xl">
        <div class="p-10 bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-500 text-white">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-white/75">Panel Admin</p>
                    <h1 class="text-3xl font-bold mt-2">Kelola Website Sekolah</h1>
                </div>
                <div class="h-12 w-12 flex items-center justify-center bg-white/15 rounded-2xl border border-white/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 19a6 6 0 0112 0"></path>
                    </svg>
                </div>
            </div>
            <p class="text-white/90 mb-6">Masuk dengan akun admin untuk mengatur berita, guru, galeri, dan data PPDB.</p>
            <div class="space-y-3">
                <div class="p-4 rounded-2xl bg-white/10 border border-white/15 flex gap-3 items-start">
                    <div class="h-9 w-9 rounded-xl bg-white/20 flex items-center justify-center text-white font-semibold">1</div>
                    <div>
                        <p class="font-semibold">Kontrol penuh</p>
                        <p class="text-sm text-white/85">Semua modul manajemen konten dalam satu dashboard.</p>
                    </div>
                </div>
                <div class="p-4 rounded-2xl bg-white/10 border border-white/15 flex gap-3 items-start">
                    <div class="h-9 w-9 rounded-xl bg-white/20 flex items-center justify-center text-white font-semibold">2</div>
                    <div>
                        <p class="font-semibold">Akses terproteksi</p>
                        <p class="text-sm text-white/85">Hanya akun ber-role admin yang bisa masuk.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 bg-slate-900/80 backdrop-blur-lg">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm font-semibold text-indigo-300">Login Admin</p>
                    <h2 class="text-2xl font-bold text-white mt-1">Masuk dashboard</h2>
                </div>
                <div class="h-12 w-12 rounded-2xl bg-indigo-500/15 text-indigo-200 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-red-400/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    <div class="flex items-center gap-2 font-semibold mb-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Gagal login</span>
                    </div>
                    <ul class="space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-200 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            class="block w-full pl-10 pr-4 py-3 border border-slate-700/80 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-900/70 text-white placeholder:text-slate-500 @error('email') border-red-500 focus:ring-red-500 @enderror"
                            placeholder="admin@sekolah.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-200 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="block w-full pl-10 pr-4 py-3 border border-slate-700/80 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-900/70 text-white placeholder:text-slate-500 @error('password') border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan password">
                    </div>
                </div>

                <label class="inline-flex items-center gap-2 text-sm text-slate-200 cursor-pointer">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-indigo-500 focus:ring-indigo-500 border-slate-600 rounded bg-slate-800/70">
                    <span>Ingat saya</span>
                </label>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 hover:from-indigo-600 hover:via-blue-600 hover:to-cyan-600 text-white font-bold py-3 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-900 shadow-lg hover:shadow-indigo-500/30">
                    Masuk Dashboard Admin
                </button>

                <p class="text-sm text-slate-300 text-center">
                    Bukan admin? <a href="{{ route('login') }}" class="text-indigo-300 hover:text-indigo-200 font-semibold">Login umum</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
