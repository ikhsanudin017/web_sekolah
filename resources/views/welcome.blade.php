<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->nama_sekolah ?? config('app.name', 'Website Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
@php
    $slidesData = ($heroSlides ?? collect())->filter(function($s) {
        return $s->title;
    })->map(function($s) {
        return [
            'title' => $s->title,
            'subtitle' => $s->subtitle,
            'image' => $s->image ? asset('storage/' . $s->image) : asset('image/carousle/54d57d87f7fd99d604ab0fb6fb5485d1.jpg')
        ];
    });

    if ($slidesData->isEmpty()) {
        $slidesData = collect([
            [
                'title' => $settings->nama_sekolah ?? 'SMA Negeri 1 Jakarta',
                'subtitle' => $settings->description ?? 'Membangun generasi unggul melalui pendidikan berkualitas dan karakter kuat.',
                'image' => asset('image/carousle/54d57d87f7fd99d604ab0fb6fb5485d1.jpg')
            ],
            [
                'title' => 'Fasilitas Modern & Nyaman',
                'subtitle' => 'Ruang belajar ber-AC, laboratorium sains, perpustakaan digital, serta area olahraga yang lengkap.',
                'image' => asset('image/carousle/52ded6c4ada62753d85842452d261e2d.jpg')
            ],
            [
                'title' => 'Guru Berprestasi',
                'subtitle' => 'Tenaga pendidik berpengalaman yang berkomitmen pada pembelajaran aktif dan inovatif.',
                'image' => asset('image/carousle/4ae2d1b582605aeaf5e70edaf78f714d.jpg')
            ],
        ]);
    }

    $teacherFallbacks = [
        asset('image/profile guru/014f6d0313bc5e8a9770823c9278f78b.jpg'),
        asset('image/profile guru/1c9dfa273d3c347716aa25a51e6b37d5.jpg'),
        asset('image/profile guru/2d0b7516d79dcdc10f811294574792ae.jpg'),
        asset('image/profile guru/396c741c3d37ad0199ac220d16169e3e.jpg'),
        asset('image/profile guru/60897dd68264f3220d1a128a00fec39b.jpg'),
        asset('image/profile guru/7a7868d0a50534f9759244b98d3f6535.jpg'),
        asset('image/profile guru/8244f61037a522a4911692b991d52890.jpg'),
        asset('image/profile guru/8711dd2abf3ed1f4fe7cbf6bb7ad3d00.jpg'),
        asset('image/profile guru/9b2d9c3dc2c1d8d9edd7b8e65d876032.jpg'),
        asset('image/profile guru/c24d0d7542ee6be66bf4270123c15df4.jpg'),
        asset('image/profile guru/d5efa4fc259e2af0ef4dd9ceb30637d2.jpg'),
        asset('image/profile guru/ddd48f1b5d91bb92553439ba28ebbecc.jpg'),
        asset('image/profile guru/ee174e22e4bc502ff6f40de9e21cc5fe.jpg'),
    ];

    $postFallbacks = [
        asset('image/berita sekolah/juara loomba.jpg'),
        asset('image/berita sekolah/murid baru.jpg'),
        asset('image/berita sekolah/poersiapan UN.jpg'),
        asset('image/berita sekolah/wisuda.jpg'),
    ];
@endphp

<body class="antialiased">
    <!-- Header & Sticky Navbar -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = window.scrollY > 50"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-white shadow-md' : 'bg-white/95 backdrop-blur-sm'">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        @if($settings && $settings->logo)
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->nama_sekolah }}" class="h-12 w-auto">
                        @else
                            <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xl">S</span>
                            </div>
                        @endif
                        <span class="text-2xl font-bold text-blue-600">{{ $settings->nama_sekolah ?? 'Sekolah' }}</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('about') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">Profil</a>
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('posts.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">Berita</a>
                    <a href="{{ route('teachers') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('teachers') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">Guru</a>
                    <a href="{{ route('gallery') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('gallery') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">Galeri</a>
                    <a href="{{ route('ppdb') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('ppdb*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">PPDB</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex md:items-center md:space-x-4">
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
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Daftar</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
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
                    <a href="{{ route('home') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Beranda</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Profil</a>
                    <a href="{{ route('posts.index') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Berita</a>
                    <a href="{{ route('teachers') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Guru</a>
                    <a href="{{ route('gallery') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">Galeri</a>
                    <a href="{{ route('ppdb') }}" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">PPDB</a>
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

    <!-- Hero Section with dual carousel (image + text) -->
    <section
        x-data="heroCarousel({{ $slidesData->count() }})"
        x-init="init(); $cleanup(() => stop())"
        @mouseenter="stop()"
        @mouseleave="start()"
        class="relative isolate min-h-[90vh] flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-blue-300 text-blue-900 overflow-hidden pt-28 pb-28">
        
        <!-- Background Image Layer -->
        <div class="absolute inset-0">
            @foreach($slidesData as $i => $slide)
                <div
                    x-show="active === {{ $i }}"
                    x-cloak
                    x-transition:enter="transition ease-in-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-[1.08]"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in-out duration-900"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 scale-[1.08]"
                    class="absolute inset-0 bg-cover bg-center transform-gpu"
                    style="background-image: url('{{ $slide['image'] }}'); filter: blur(2px);">
                </div>
            @endforeach
            <div class="absolute inset-0 bg-gradient-to-b from-blue-100/70 via-blue-400/50 to-blue-900/55"></div>
        </div>
        
        <!-- Floating orbs + pattern -->
        <div class="absolute -top-24 -left-16 h-72 w-72 rounded-full bg-blue-200/60 blur-3xl hero-orb"></div>
        <div class="absolute -bottom-28 -right-10 h-80 w-80 rounded-full bg-blue-400/50 blur-3xl hero-orb" style="animation-delay: -4s;"></div>
        <div class="absolute inset-0 hero-pattern opacity-70"></div>

        <!-- Gradient overlay for depth -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/60 via-blue-500/20 to-blue-900/35"></div>

        <!-- Content Carousel -->
        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/80 text-blue-800 border border-white/80 text-xs font-semibold mb-7 shadow-sm backdrop-blur hero-kicker">
                <span class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                Inspirasi Sekolah Unggul
            </div>

            <div class="hero-card rounded-[32px] overflow-hidden relative px-0 py-0 ring-1 ring-white/70">
                @foreach($slidesData as $i => $slide)
                    <div class="absolute inset-0 bg-cover bg-center transform-gpu"
                         x-show="active === {{ $i }}"
                         x-cloak
                         x-transition:enter="transition ease-in-out duration-900"
                         x-transition:enter-start="opacity-0 scale-[1.04]"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in-out duration-700"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-[1.04]"
                         style="background-image: url('{{ $slide['image'] }}');">
                    </div>
                @endforeach
                <div class="absolute inset-0 bg-gradient-to-br from-white/95 via-white/85 to-white/80"></div>

                <div class="relative px-6 sm:px-12 py-14 sm:py-16 text-center">
                    @foreach($slidesData as $i => $slide)
                        <div x-show="active === {{ $i }}"
                             x-cloak
                             x-transition:enter="transition ease-in-out duration-800"
                             x-transition:enter-start="opacity-0 translate-y-3"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in-out duration-650"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-3">
                            <h1 class="hero-title text-4xl md:text-6xl font-bold leading-tight tracking-tight mb-5 text-blue-900 max-w-4xl mx-auto">{{ $slide['title'] }}</h1>
                            <div class="mx-auto mb-5 h-1 w-20 rounded-full bg-gradient-to-r from-blue-300 via-blue-600 to-blue-300"></div>
                            <p class="hero-subtitle text-lg md:text-xl text-blue-700 mb-8 max-w-3xl mx-auto">{{ $slide['subtitle'] }}</p>
                        </div>
                    @endforeach

                    <div class="flex flex-wrap gap-4 justify-center mt-2">
                        <a href="{{ route('ppdb') }}" 
                           class="inline-flex items-center gap-2 bg-white text-blue-700 px-7 py-3 rounded-xl text-lg font-semibold hover:bg-blue-50 transition-all transform hover:scale-[1.03] shadow-lg shadow-blue-200/40 border border-blue-100">
                            Daftar PPDB
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}" 
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-7 py-3 rounded-xl text-lg font-semibold hover:from-blue-600 hover:to-blue-800 transition-all transform hover:scale-[1.03] shadow-lg shadow-blue-500/30">
                            Profil Sekolah
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Controls -->
                    <div class="flex items-center justify-center gap-4 mt-10">
                        <button @click="prev()" class="h-10 w-10 flex items-center justify-center rounded-full bg-white/90 hover:bg-white border border-blue-100 text-blue-700 transition shadow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <div class="flex gap-2">
                            @foreach($slidesData as $i => $slide)
                                <button @click="go({{ $i }})"
                                    class="w-3 h-3 rounded-full border border-blue-200 transition"
                                    :class="active === {{ $i }} ? 'bg-blue-600' : 'bg-white/70'"></button>
                            @endforeach
                        </div>
                        <button @click="next()" class="h-10 w-10 flex items-center justify-center rounded-full bg-white/90 hover:bg-white border border-blue-100 text-blue-700 transition shadow">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator + Running Text -->
        <div class="absolute bottom-6 inset-x-0 flex flex-col items-center gap-4 px-4 sm:px-10">
            <div class="w-full">
                <div class="overflow-hidden rounded-full hero-marquee">
                    <div class="marquee-track whitespace-nowrap">
                        @php
                            $marqueeItems = [
                                'Selamat datang di ' . ($settings->nama_sekolah ?? 'sekolah kami'),
                                'Pendaftaran PPDB dibuka!',
                                'Kunjungi profil sekolah untuk informasi lengkap',
                                'Prestasi siswa dan guru terbaru ada di halaman berita'
                            ];
                        @endphp
                        <div class="flex items-center gap-6 text-blue-700 font-semibold text-sm px-6 py-2 min-w-max">
                            @foreach($marqueeItems as $item)
                                <span>{{ $item }}</span>
                                @if(!$loop->last)<span aria-hidden="true" class="text-blue-300">|</span>@endif
                            @endforeach
                        </div>
                        <div aria-hidden="true" class="flex items-center gap-6 text-blue-700 font-semibold text-sm px-6 py-2 min-w-max">
                            @foreach($marqueeItems as $item)
                                <span>{{ $item }}</span>
                                @if(!$loop->last)<span aria-hidden="true" class="text-blue-300">|</span>@endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="animate-bounce">
                <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="pt-24 pb-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Prestasi & Statistik</h2>
                <p class="text-xl text-gray-600">Membangun kepercayaan melalui angka yang nyata</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-bold text-blue-600 mb-4">{{ $stats['total_students'] ?? 0 }}+</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Siswa Aktif</h3>
                    <p class="text-gray-600">Generasi penerus bangsa yang siap menghadapi masa depan</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-bold text-blue-500 mb-4">{{ $stats['total_teachers'] ?? 0 }}+</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Guru Berpengalaman</h3>
                    <p class="text-gray-600">Tenaga pendidik profesional dan berdedikasi tinggi</p>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center transform hover:scale-105 transition-transform">
                    <div class="text-5xl font-bold text-blue-400 mb-4">{{ $stats['total_posts'] ?? 0 }}+</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Berita & Informasi</h3>
                    <p class="text-gray-600">Update terbaru seputar kegiatan sekolah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Teacher Preview Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Guru & Tenaga Pendidik</h2>
                <p class="text-xl text-gray-600">Bertemu dengan tim pengajar profesional kami</p>
            </div>

            @if($latestTeachers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestTeachers as $teacher)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform">
                            <div class="relative h-64 bg-gradient-to-br from-blue-400 to-blue-600">
                                @php
                                    $teacherFallback = $teacherFallbacks[$loop->index % count($teacherFallbacks)] ?? null;
                                @endphp
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" 
                                         alt="{{ $teacher->name }}" 
                                         class="w-full h-full object-cover">
                                @elseif($teacherFallback)
                                    <img src="{{ $teacherFallback }}" 
                                         alt="{{ $teacher->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-white text-4xl font-bold">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $teacher->name }}</h3>
                                <p class="text-blue-600 font-semibold mb-3">{{ $teacher->position }}</p>
                                @if($teacher->bio)
                                    <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($teacher->bio, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View All Teachers -->
                <div class="text-center mt-12">
                    <a href="{{ route('teachers') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg">
                        Lihat Semua Guru ->
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Data guru sedang dalam proses update</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest News Preview Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita Terkini</h2>
                <p class="text-xl text-gray-600">Informasi dan update terbaru dari sekolah</p>
            </div>

            @if($latestPosts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($latestPosts as $post)
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform">
                            @php
                                $postFallback = $postFallbacks[$loop->index % count($postFallbacks)] ?? null;
                            @endphp
                            @if($post->image)
                                <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                            @elseif($postFallback)
                                <div class="h-48 bg-cover bg-center" style="background-image: url('{{ $postFallback }}');"></div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 text-xs font-semibold rounded-full">
                                        {{ $post->category->name }}
                                    </span>
                                    <time class="text-sm text-gray-500">
                                        {{ $post->created_at->format('d M Y') }}
                                    </time>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $post->title }}</h3>
                                @if($post->excerpt)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                                @endif
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    Baca Selengkapnya ->
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                
                <!-- View All News -->
                <div class="text-center mt-12">
                    <a href="{{ route('posts.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors shadow-lg">
                        Lihat Semua Berita ->
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada berita tersedia</p>
                </div>
            @endif
        </div>
    </section>

    <!-- PPDB CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Penerimaan Peserta Didik Baru</h2>
            <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                Bergabunglah dengan keluarga besar kami dan raih masa depan gemilang bersama kami
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('ppdb') }}" 
                   class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-50 transition-all transform hover:scale-105 shadow-lg">
                    Info PPDB
                </a>
                <a href="{{ route('ppdb.registration') }}" 
                   class="inline-block bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-800 transition-all transform hover:scale-105 shadow-lg">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative overflow-hidden bg-gradient-to-b from-white via-blue-50/30 to-white text-slate-700">
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
                            @if($settings && $settings->description)
                                <p class="text-slate-600 leading-relaxed max-w-md">
                                    {{ Str::limit($settings->description, 180) }}
                                </p>
                            @else
                                <p class="text-slate-600 leading-relaxed max-w-md">
                                    Portal informasi sekolah: berita, profil, galeri, dan layanan PPDB dalam satu tempat.
                                </p>
                            @endif
                            @if($settings && $settings->visi_misi)
                                <p class="text-slate-600 text-sm leading-relaxed max-w-md">
                                    <span class="font-semibold text-slate-900">Visi & Misi:</span>
                                    {{ Str::limit($settings->visi_misi, 140) }}
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
                        @if($settings && $settings->alamat)
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
                        @if($settings && $settings->email_kontak)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <a href="mailto:{{ $settings->email_kontak }}" class="hover:text-blue-700 transition-colors">{{ $settings->email_kontak }}</a>
                            </li>
                        @endif
                        @if($settings && $settings->phone)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white ring-1 ring-slate-200 shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </span>
                                <a href="tel:{{ $settings->phone }}" class="hover:text-blue-700 transition-colors">{{ $settings->phone }}</a>
                            </li>
                        @endif
                        @if($settings && $settings->website)
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
                        {{-- Intentionally no admin links on public pages --}}
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} {{ $settings->nama_sekolah ?? 'Sekolah' }}. All rights reserved.
                </p>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('about') }}" class="text-slate-500 hover:text-blue-700 transition-colors">Profil</a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('posts.index') }}" class="text-slate-500 hover:text-blue-700 transition-colors">Berita</a>
                    <span class="text-slate-300">|</span>
                    <a href="{{ route('ppdb') }}" class="text-slate-500 hover:text-blue-700 transition-colors">PPDB</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function heroCarousel(slidesOrCount) {
            const slidesCount = (() => {
                if (typeof slidesOrCount === 'number') return Math.max(0, slidesOrCount);
                if (Array.isArray(slidesOrCount)) return slidesOrCount.length;
                return 0;
            })();

            return {
                slidesCount,
                active: 0,
                timer: null,
                intervalMs: 5000,
                start() {
                    if (this.slidesCount <= 1) return;
                    this.stop();
                    this.timer = setInterval(() => this.next(), this.intervalMs);
                },
                stop() {
                    if (!this.timer) return;
                    clearInterval(this.timer);
                    this.timer = null;
                },
                go(index) {
                    if (this.slidesCount <= 0) return;
                    const safe = Math.max(0, Math.min(this.slidesCount - 1, Number(index) || 0));
                    this.active = safe;
                    this.start();
                },
                next() {
                    if (this.slidesCount <= 1) return;
                    this.active = (this.active + 1) % this.slidesCount;
                },
                prev() {
                    if (this.slidesCount <= 1) return;
                    this.active = (this.active - 1 + this.slidesCount) % this.slidesCount;
                },
                init() {
                    if (this.slidesCount <= 1) return;
                    this.start();
                    document.addEventListener('visibilitychange', () => {
                        if (document.hidden) this.stop();
                        else this.start();
                    });
                }
            }
        }
    </script>
</body>
</html>
