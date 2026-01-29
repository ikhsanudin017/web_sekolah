@extends('layouts.public')

@section('title', 'Profil Sekolah - ' . ($settings->nama_sekolah ?? 'Website Sekolah'))

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-blue-100 via-blue-50 to-blue-200 text-blue-900 py-20">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -left-16 -top-16 w-80 h-80 bg-blue-300/30 blur-3xl rounded-full"></div>
        <div class="absolute right-10 top-10 w-72 h-72 bg-blue-500/25 blur-3xl rounded-full"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-center relative z-10">
        <div class="space-y-4">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-700/80">Profil Sekolah</p>
            <h1 class="text-4xl md:text-5xl font-bold text-blue-900">{{ $settings->nama_sekolah ?? 'Profil Sekolah' }}</h1>
            <p class="text-lg text-blue-800/80">
                {{ $settings->description ?? 'Mengenal lebih dekat sekolah kami yang berkomitmen pada pendidikan unggul dan karakter kuat.' }}
            </p>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('ppdb') }}" class="px-5 py-3 bg-white text-blue-700 rounded-xl font-semibold shadow hover:shadow-lg transition">
                    Lihat PPDB
                </a>
                <a href="{{ route('posts.index') }}" class="px-5 py-3 bg-blue-600 text-white rounded-xl font-semibold shadow hover:bg-blue-700 transition">
                    Berita Terbaru
                </a>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-tr from-blue-200 via-blue-300 to-blue-100 blur-3xl opacity-60 rounded-3xl"></div>
            <div class="relative bg-white/70 backdrop-blur-xl border border-white/60 shadow-xl rounded-3xl overflow-hidden">
                @if($settings && $settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->nama_sekolah }}" class="w-full h-full object-contain p-10">
                @else
                    <div class="bg-gradient-to-br from-blue-400 to-blue-600 h-64 flex items-center justify-center">
                        <span class="text-white text-6xl font-bold">{{ substr($settings->nama_sekolah ?? 'S', 0, 1) }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-start mb-16">
            <!-- Highlights -->
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">Mengapa Memilih Kami?</h2>
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 shadow-sm">
                        <p class="text-sm font-semibold text-blue-700 mb-1">Fasilitas Modern</p>
                        <p class="text-gray-700">Laboratorium sains, perpustakaan digital, ruang kelas nyaman, dan area olahraga lengkap.</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 shadow-sm">
                        <p class="text-sm font-semibold text-blue-700 mb-1">Guru Berprestasi</p>
                        <p class="text-gray-700">Tenaga pendidik berpengalaman dengan metode pembelajaran aktif dan inovatif.</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 shadow-sm">
                        <p class="text-sm font-semibold text-blue-700 mb-1">Lingkungan Nyaman</p>
                        <p class="text-gray-700">Budaya sekolah yang inklusif, suportif, dan berfokus pada pengembangan karakter.</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 shadow-sm">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang Kami</h2>
                @if($settings && $settings->description)
                    <p class="text-gray-700 text-lg leading-relaxed">
                        {{ $settings->description }}
                    </p>
                @else
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Sekolah kami berkomitmen untuk memberikan pendidikan berkualitas dan membentuk karakter siswa yang unggul melalui kurikulum yang relevan dan kegiatan ekstrakurikuler yang beragam.
                    </p>
                @endif
            </div>
        </div>

        <!-- Visi Misi -->
        @if($settings && $settings->visi_misi)
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-800 via-blue-600 to-blue-400 rounded-3xl p-10 md:p-12 mb-16 shadow-2xl">
            <div class="absolute inset-0" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/30"></div>
                <div class="absolute -left-24 -top-24 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-12 top-10 w-72 h-72 border border-white/25 rounded-full"></div>
                <div class="absolute -right-20 -bottom-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            </div>
            <div class="relative">
                <h2 class="text-3xl font-bold text-white mb-6 text-center drop-shadow-sm">Visi & Misi</h2>
                <div class="prose prose-lg max-w-none text-white/90 prose-headings:text-white prose-strong:text-white prose-li:text-white/90">
                    {!! nl2br(e($settings->visi_misi)) !!}
                </div>
            </div>
        </div>
        @endif

        <!-- Contact Info -->
        <div class="bg-white border border-blue-100 rounded-3xl p-8 md:p-12 shadow-xl">
            <h2 class="text-3xl font-bold mb-8 text-center text-blue-900">Informasi Kontak</h2>
            <div class="grid md:grid-cols-2 gap-8 text-blue-800">
                @if($settings && $settings->alamat)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 bg-blue-50 p-3 rounded-xl border border-blue-100">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1 text-blue-900">Alamat</h3>
                        <p class="text-blue-800/80">{{ $settings->alamat }}</p>
                    </div>
                </div>
                @endif

                @if($settings && $settings->email_kontak)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 bg-blue-50 p-3 rounded-xl border border-blue-100">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1 text-blue-900">Email</h3>
                        <a href="mailto:{{ $settings->email_kontak }}" class="text-blue-700 hover:text-blue-900 transition-colors">
                            {{ $settings->email_kontak }}
                        </a>
                    </div>
                </div>
                @endif

                @if($settings && $settings->phone)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 bg-blue-50 p-3 rounded-xl border border-blue-100">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1 text-blue-900">Telepon</h3>
                        <a href="tel:{{ $settings->phone }}" class="text-blue-700 hover:text-blue-900 transition-colors">
                            {{ $settings->phone }}
                        </a>
                    </div>
                </div>
                @endif

                @if($settings && $settings->website)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 bg-blue-50 p-3 rounded-xl border border-blue-100">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-1 text-blue-900">Website</h3>
                        <a href="{{ $settings->website }}" target="_blank" class="text-blue-700 hover:text-blue-900 transition-colors">
                            {{ $settings->website }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

