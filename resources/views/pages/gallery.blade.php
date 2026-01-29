@extends('layouts.public')

@section('title', 'Galeri - ' . ($settings->nama_sekolah ?? 'Website Sekolah'))

@section('content')
@php
    $galleryFallbacks = [
        asset('image/galeri sekolah/18f7e7fb14dc7df8a2d659d6942ce3a1.jpg'),
        asset('image/galeri sekolah/1d1d9547cb9b041531def1c36672ae5c.jpg'),
        asset('image/galeri sekolah/5a0cb997b4c4515cd66268a0950e6670.jpg'),
        asset('image/galeri sekolah/8ed5288f66ec2d3665757c1d99dfe087.jpg'),
        asset('image/galeri sekolah/984d7b5981ad2c1b7501ac45ab7c66ef.jpg'),
        asset('image/galeri sekolah/a06af96f4e23ac25ee1829be978092e7.jpg'),
        asset('image/galeri sekolah/d14f51476c74f59d5d34a682e22c9d04.jpg'),
        asset('image/galeri sekolah/e5b40d0e4c902b505cbb1eac0846925c.jpg'),
    ];
@endphp
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Sekolah</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
            Dokumentasi kegiatan dan momen berharga di sekolah kami
        </p>
    </div>
</section>

<!-- Gallery Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleries->isEmpty())
            <!-- Empty State -->
            <div class="text-center py-20">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Galeri Sedang Kosong</h3>
                <p class="text-gray-600">Foto dan dokumentasi akan segera ditambahkan.</p>
            </div>
        @else
            <!-- Gallery Categories -->
            @foreach($galleries as $category => $items)
                <div class="mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 capitalize">
                        {{ ucfirst($category) }}
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($items as $gallery)
                            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                                    @php
                                        $galleryFallback = $galleryFallbacks[$loop->index % count($galleryFallbacks)] ?? null;
                                    @endphp
                                    <img 
                                        src="{{ $gallery->image ? asset('storage/' . $gallery->image) : ($galleryFallback ?? '') }}" 
                                        alt="{{ $gallery->title }}"
                                        class="w-full h-72 object-cover transition-transform duration-300 group-hover:scale-110"
                                        loading="lazy">
                                </div>
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                        <h3 class="text-xl font-bold mb-2">{{ $gallery->title }}</h3>
                                        @if($gallery->description)
                                            <p class="text-sm text-gray-200">{{ Str::limit($gallery->description, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection

