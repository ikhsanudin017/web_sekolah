@extends('layouts.public')

@section('title', 'Berita Sekolah')

@section('content')
@php
    $postFallbacks = [
        asset('image/berita sekolah/juara loomba.jpg'),
        asset('image/berita sekolah/murid baru.jpg'),
        asset('image/berita sekolah/poersiapan UN.jpg'),
        asset('image/berita sekolah/wisuda.jpg'),
    ];
@endphp
<div class="pt-6">
    <!-- Page Header -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-800 via-blue-600 to-blue-400 text-white shadow-2xl mb-10">
        <div class="absolute inset-0" aria-hidden="true">
            <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/30"></div>
            <div class="absolute -left-24 -top-24 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-14 top-8 w-72 h-72 border border-white/25 rounded-full"></div>
            <div class="absolute -right-24 -bottom-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        </div>
        <div class="relative px-8 py-10">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-white/80 mb-3">Berita & Informasi</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-sm">Update Terbaru Sekolah</h1>
            <p class="text-lg text-white/85 max-w-3xl">Ikuti kabar terkini kegiatan, prestasi, dan informasi penting dari sekolah.</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 mb-8">
        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[250px]">
                <label class="sr-only" for="search">Cari berita</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                        placeholder="Cari berita, kata kunci, atau penulis..." 
                        class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-50">
                </div>
            </div>
            <div>
                <label class="sr-only" for="category">Kategori</label>
                <select id="category" name="category" class="px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow">
                    Cari
                </button>
                @if(request()->has('search') || request()->has('category'))
                    <a href="{{ route('posts.index') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200">
                        Reset
                    </a>
                @endif
            </div>
        </form>
        @if(request()->has('search') || request()->has('category'))
            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-slate-600">
                <span>Filter aktif:</span>
                @if(request('search'))
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-700 rounded-full border border-blue-100">
                        Kata kunci: "{{ request('search') }}"
                    </span>
                @endif
                @if(request('category'))
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-700 rounded-full border border-blue-100">
                        Kategori: {{ optional($categories->firstWhere('slug', request('category')))->name ?? request('category') }}
                    </span>
                @endif
            </div>
        @endif
    </div>

    <!-- Results Count -->
    @if(request()->has('search') || request()->has('category'))
        <div class="mb-4 text-gray-600">
            Menampilkan {{ $posts->total() }} hasil
            @if(request('search'))
                untuk "{{ request('search') }}"
            @endif
        </div>
    @endif

    <!-- Posts Grid -->
    @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($posts as $post)
                <article class="group bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="relative">
                        @php
                            $postFallback = $postFallbacks[$loop->index % count($postFallbacks)] ?? null;
                        @endphp
                        @if($post->image)
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $post->image) }}');"></div>
                            </a>
                        @elseif($postFallback)
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('{{ $postFallback }}');"></div>
                            </a>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                        @endif
                        <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-white/90 text-blue-700 text-xs font-semibold shadow">
                            {{ $post->created_at->format('d M Y') }}
                        </div>
                        <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-blue-600 text-white text-xs font-semibold shadow">
                            {{ $post->category->name }}
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <h2 class="text-xl font-bold text-gray-900 line-clamp-2">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                {{ $post->title }}
                            </a>
                        </h2>
                        @if($post->excerpt)
                            <p class="text-gray-600 text-sm line-clamp-3">{{ $post->excerpt }}</p>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Oleh {{ $post->user->name }}</span>
                            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-700">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <p class="text-gray-500 text-lg mb-4">Tidak ada berita ditemukan.</p>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">Lihat semua berita</a>
        </div>
    @endif
</div>
@endsection
