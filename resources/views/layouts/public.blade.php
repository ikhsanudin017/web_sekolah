<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $settings = $settings ?? \App\Models\SchoolSetting::first();
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Website Sekolah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <!-- Navbar -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = window.scrollY > 50"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-white shadow-lg' : 'bg-white/95 backdrop-blur-sm shadow-md'">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        @if(isset($settings) && $settings && $settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->nama_sekolah }}" class="h-12 w-auto">
                            <span class="text-xl font-bold text-blue-600">{{ $settings->nama_sekolah ?? 'Sekolah' }}</span>
                        @else
                            <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xl">S</span>
                            </div>
                            <span class="text-xl font-bold text-blue-600">{{ $settings->nama_sekolah ?? 'Sekolah' }}</span>
                        @endif
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:space-x-1">
                    <a href="{{ route('home') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('about') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Profil
                    </a>
                    <a href="{{ route('posts.index') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('posts.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Berita
                    </a>
                    <a href="{{ route('teachers') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('teachers') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Guru
                    </a>
                    <a href="{{ route('gallery') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('gallery') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        Galeri
                    </a>
                    <a href="{{ route('ppdb') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('ppdb*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                        PPDB
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex md:items-center md:space-x-3">
                    <div x-data="{
                            time: '',
                            date: '',
                            tick() {
                                const now = new Date();
                                const hh = String(now.getHours()).padStart(2, '0');
                                const mm = String(now.getMinutes()).padStart(2, '0');
                                const ss = String(now.getSeconds()).padStart(2, '0');
                                this.time = `${hh}:${mm}:${ss}`;
                                this.date = now.toLocaleDateString('id-ID', { weekday: 'short', day: '2-digit', month: 'short' });
                            },
                            init() {
                                this.tick();
                                setInterval(() => this.tick(), 1000);
                            }
                        }"
                        class="hidden lg:flex items-center gap-3 px-4 py-2 rounded-2xl bg-white/70 backdrop-blur border border-slate-200 shadow-sm shadow-slate-200/60 ring-1 ring-white/60">
                        <div class="h-10 w-10 rounded-2xl bg-gradient-to-br from-blue-50 to-white text-blue-600 flex items-center justify-center border border-blue-100 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="leading-tight">
                            <div class="text-sm font-extrabold text-slate-900 tabular-nums tracking-wide" x-text="time"></div>
                            <div class="text-xs font-medium text-slate-500" x-text="date"></div>
                        </div>
                    </div>
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Logout</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="open" x-transition class="md:hidden pb-4" style="display: none;">
                <div class="flex flex-col space-y-1">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : '' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : '' }}">Profil</a>
                    <a href="{{ route('posts.index') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('posts.*') ? 'bg-blue-50 text-blue-600' : '' }}">Berita</a>
                    <a href="{{ route('teachers') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('teachers') ? 'bg-blue-50 text-blue-600' : '' }}">Guru</a>
                    <a href="{{ route('gallery') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('gallery') ? 'bg-blue-50 text-blue-600' : '' }}">Galeri</a>
                    <a href="{{ route('ppdb') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('ppdb*') ? 'bg-blue-50 text-blue-600' : '' }}">PPDB</a>
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Logout</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium text-center transition-colors">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative mt-20 overflow-hidden bg-gradient-to-b from-white via-blue-50/30 to-white text-slate-700">
        <div class="absolute inset-0" aria-hidden="true">
            <div class="absolute -top-28 -left-24 w-[30rem] h-[30rem] bg-blue-200/40 blur-[72px] rounded-full"></div>
            <div class="absolute -bottom-36 -right-24 w-[34rem] h-[34rem] bg-blue-100/60 blur-[80px] rounded-full"></div>
            <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-slate-200/70 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <!-- Brand -->
                <div class="md:col-span-5">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/20 ring-1 ring-black/5">
                            <span class="text-xl font-extrabold">{{ strtoupper(substr($settings->nama_sekolah ?? 'S', 0, 1)) }}</span>
                        </div>
                        <div class="space-y-3">
                            <h3 class="text-slate-900 text-xl font-bold leading-tight">
                                {{ $settings->nama_sekolah ?? 'Sekolah' }}
                            </h3>
                            @if(isset($settings) && $settings && $settings->description)
                                <p class="text-slate-600 leading-relaxed max-w-md">
                                    {{ Str::limit($settings->description, 180) }}
                                </p>
                            @else
                                <p class="text-slate-600 leading-relaxed max-w-md">
                                    Portal informasi sekolah: berita, profil, galeri, dan layanan PPDB dalam satu tempat.
                                </p>
                            @endif

                            <div class="flex flex-wrap gap-3 pt-2">
                                <a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 border border-blue-600/10 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/15 transition">
                                    <svg class="w-4 h-4 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Daftar PPDB
                                </a>
                                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8L13 15M11 17H6a2 2 0 01-2-2V6a2 2 0 012-2h9a2 2 0 012 2v5"></path>
                                    </svg>
                                    Baca Berita
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="md:col-span-4">
                    <h3 class="text-slate-900 text-lg font-bold mb-4">Kontak</h3>
                    <ul class="space-y-3 text-slate-700">
                        @if(isset($settings) && $settings && $settings->alamat)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                <span class="leading-relaxed">{{ $settings->alamat }}</span>
                            </li>
                        @endif
                        @if(isset($settings) && $settings && $settings->email_kontak)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <a href="mailto:{{ $settings->email_kontak }}" class="hover:text-blue-700 transition-colors">{{ $settings->email_kontak }}</a>
                            </li>
                        @endif
                        @if(isset($settings) && $settings && $settings->phone)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </span>
                                <a href="tel:{{ $settings->phone }}" class="hover:text-blue-700 transition-colors">{{ $settings->phone }}</a>
                            </li>
                        @endif
                        @if(isset($settings) && $settings && $settings->website)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c4.418 0 8-4.03 8-9s-3.582-9-8-9-8 4.03-8 9 3.582 9 8 9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12h20"></path>
                                    </svg>
                                </span>
                                <a href="{{ $settings->website }}" target="_blank" class="hover:text-blue-700 transition-colors break-all">{{ $settings->website }}</a>
                            </li>
                        @endif
                        @if(isset($settings) && $settings && $settings->map_url)
                            <li class="pt-2">
                                <a href="{{ $settings->map_url }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.382V6.618a2 2 0 011.553-1.894L9 2m0 18l6-3m-6 3V2m6 15l5.447 2.724A2 2 0 0021 17.382V8.618a2 2 0 00-1.553-1.894L15 4m0 13V4m0 0L9 2"></path>
                                    </svg>
                                    Lihat lokasi di peta
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="md:col-span-3">
                    <h3 class="text-slate-900 text-lg font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2.5 text-slate-700">
                        <li><a href="{{ route('home') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Profil Sekolah</a></li>
                        <li><a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Berita</a></li>
                        <li><a href="{{ route('teachers') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Guru & Staf</a></li>
                        <li><a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>Galeri</a></li>
                        <li><a href="{{ route('ppdb') }}" class="inline-flex items-center gap-2 hover:text-blue-700 transition-colors"><span class="h-1 w-1 rounded-full bg-blue-500"></span>PPDB</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} {{ $settings->nama_sekolah ?? 'Sekolah' }}. All rights reserved.
                </p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('about') }}" class="text-slate-500 hover:text-blue-700 transition-colors">Profil</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('posts.index') }}" class="text-slate-500 hover:text-blue-700 transition-colors">Berita</a>
                    <span class="text-slate-300">•</span>
                    <a href="{{ route('ppdb') }}" class="text-slate-500 hover:text-blue-700 transition-colors">PPDB</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

