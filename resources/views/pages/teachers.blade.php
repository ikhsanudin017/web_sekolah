@extends('layouts.public')

@section('title', 'Guru & Tenaga Pendidik - ' . ($settings->nama_sekolah ?? 'Website Sekolah'))

@section('content')
@php
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
@endphp
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Guru & Tenaga Pendidik</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
            Bertemu dengan tim pengajar profesional dan berdedikasi tinggi
        </p>
    </div>
</section>

<!-- Teachers Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($teachers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($teachers as $teacher)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
                        <div class="relative h-72 bg-gradient-to-br from-blue-400 to-blue-600">
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
                                <div class="w-full h-full flex items-center justify-center text-white">
                                    <span class="text-6xl font-bold">{{ substr($teacher->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $teacher->name }}</h3>
                            @if($teacher->nip)
                                <p class="text-sm text-gray-500 mb-2">NIP: {{ $teacher->nip }}</p>
                            @endif
                            <p class="text-blue-600 font-semibold mb-3">{{ $teacher->position }}</p>
                            @if($teacher->bio)
                                <p class="text-gray-600 text-sm line-clamp-3">{{ $teacher->bio }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Data Guru Sedang Diperbarui</h3>
                <p class="text-gray-600">Informasi guru dan tenaga pendidik akan segera ditampilkan.</p>
            </div>
        @endif
    </div>
</section>
@endsection

