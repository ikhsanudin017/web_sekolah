@extends('layouts.public')

@section('title', 'PPDB - ' . ($settings->nama_sekolah ?? 'Website Sekolah'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Penerimaan Peserta Didik Baru</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
            Bergabunglah dengan keluarga besar kami dan raih masa depan gemilang
        </p>
    </div>
</section>

<!-- PPDB Info -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 rounded-3xl p-12 text-center text-white mb-16 shadow-2xl">
            <h2 class="text-3xl font-bold mb-4">Siap Bergabung?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Daftarkan diri Anda sekarang dan jadilah bagian dari keluarga besar kami
            </p>
            <a href="{{ route('ppdb.registration') }}" 
               class="inline-block bg-white text-blue-600 px-8 py-4 rounded-xl text-lg font-bold hover:bg-blue-50 transition-all transform hover:scale-105 shadow-lg">
                Daftar Sekarang
            </a>
        </div>

        <!-- Info Grid -->
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="bg-blue-50 rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pendaftaran Online</h3>
                <p class="text-gray-600">Daftar kapan saja, di mana saja dengan sistem online yang mudah</p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Proses Cepat</h3>
                <p class="text-gray-600">Verifikasi dan pengumuman hasil dalam waktu singkat</p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Dukungan Penuh</h3>
                <p class="text-gray-600">Tim kami siap membantu sepanjang proses pendaftaran</p>
            </div>
        </div>

        <!-- Persyaratan -->
        <div class="bg-gray-50 rounded-2xl p-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Persyaratan Pendaftaran</h2>
            <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Fotocopy Ijazah/SKHUN</h4>
                        <p class="text-sm text-gray-600">Yang telah dilegalisir</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Fotocopy Akta Kelahiran</h4>
                        <p class="text-sm text-gray-600">Sebanyak 2 lembar</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Fotocopy Kartu Keluarga</h4>
                        <p class="text-sm text-gray-600">Sebanyak 2 lembar</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Pas Foto Terbaru</h4>
                        <p class="text-sm text-gray-600">Ukuran 3x4 sebanyak 4 lembar</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Surat Keterangan Sehat</h4>
                        <p class="text-sm text-gray-600">Dari dokter</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Surat Keterangan Kelakuan Baik</h4>
                        <p class="text-sm text-gray-600">Dari sekolah asal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

