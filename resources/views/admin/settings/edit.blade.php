<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Pengaturan Tampilan</h3>
                    <p class="text-sm text-gray-600 mb-4">Atur konten yang tampil di halaman depan.</p>

                    <a href="{{ route('admin.hero-slides.index') }}"
                       class="group flex items-center justify-between rounded-xl border border-gray-100 bg-gradient-to-r from-blue-50 to-white px-5 py-4 hover:border-blue-200 hover:shadow-md transition">
                        <div class="flex items-center gap-4">
                            <div class="h-11 w-11 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Hero Carousel</div>
                                <div class="text-sm text-gray-600">Atur teks & gambar utama</div>
                            </div>
                        </div>
                        <div class="text-blue-600 font-semibold group-hover:translate-x-0.5 transition">
                            Kelola
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Informasi Dasar -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                        
                        <!-- Nama Sekolah -->
                        <div class="mb-6">
                            <label for="nama_sekolah" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_sekolah" 
                                   id="nama_sekolah" 
                                   value="{{ old('nama_sekolah', $setting->nama_sekolah) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_sekolah') border-red-500 @enderror" 
                                   placeholder="Contoh: SMA Negeri 1 Jakarta"
                                   required>
                            @error('nama_sekolah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Singkat
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror" 
                                      placeholder="Deskripsi singkat tentang sekolah">{{ old('description', $setting->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Warna Dasar -->
                        <div class="mb-6">
                            <label for="primary_color" class="block text-sm font-semibold text-gray-700 mb-2">
                                Warna Dasar Website
                            </label>
                            <div class="flex items-center gap-4">
                                <input type="color"
                                       name="primary_color"
                                       id="primary_color"
                                       value="{{ old('primary_color', $setting->primary_color ?? '#2563eb') }}"
                                       class="h-12 w-16 rounded-lg border border-gray-300 bg-white p-1 @error('primary_color') border-red-500 @enderror">
                                <div class="flex-1">
                                    <input type="text"
                                           id="primary_color_text"
                                           value="{{ old('primary_color', $setting->primary_color ?? '#2563eb') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('primary_color') border-red-500 @enderror"
                                           placeholder="#2563eb">
                                    <p class="mt-1 text-xs text-gray-500">Format hex, contoh: #2563eb</p>
                                </div>
                            </div>
                            @error('primary_color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div>
                            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                                Logo Sekolah
                            </label>
                            
                            @if($setting->logo)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $setting->logo) }}" 
                                         alt="Logo"
                                         class="h-24 w-auto rounded-lg shadow-md">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   name="logo" 
                                   id="logo" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('logo') border-red-500 @enderror"
                                   onchange="previewLogo(event)">
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                            @enderror
                            
                            <div id="logo-preview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img id="logo-preview-image" src="" alt="Preview" class="h-24 w-auto rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>

                    <!-- Visi & Misi -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Visi & Misi</h3>
                        
                        <div>
                            <label for="visi_misi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Visi & Misi Sekolah
                            </label>
                            <textarea name="visi_misi" 
                                      id="visi_misi" 
                                      rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('visi_misi') border-red-500 @enderror" 
                                      placeholder="Tuliskan visi dan misi sekolah...">{{ old('visi_misi', $setting->visi_misi) }}</textarea>
                            @error('visi_misi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Informasi Kontak -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                        
                        <!-- Alamat -->
                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Lengkap
                            </label>
                            <textarea name="alamat" 
                                      id="alamat" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('alamat') border-red-500 @enderror" 
                                      placeholder="Jl. Contoh No. 123, Kota">{{ old('alamat', $setting->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email_kontak" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Kontak
                            </label>
                            <input type="email" 
                                   name="email_kontak" 
                                   id="email_kontak" 
                                   value="{{ old('email_kontak', $setting->email_kontak) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email_kontak') border-red-500 @enderror" 
                                   placeholder="info@sekolah.com">
                            @error('email_kontak')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone" 
                                   value="{{ old('phone', $setting->phone) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror" 
                                   placeholder="(021) 1234567">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div class="mb-6">
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                                Website URL
                            </label>
                            <input type="url" 
                                   name="website" 
                                   id="website" 
                                   value="{{ old('website', $setting->website) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('website') border-red-500 @enderror" 
                                   placeholder="https://sekolah.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Map URL -->
                        <div>
                            <label for="map_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                Google Maps Embed URL
                            </label>
                            <input type="url" 
                                   name="map_url" 
                                   id="map_url" 
                                   value="{{ old('map_url', $setting->map_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('map_url') border-red-500 @enderror" 
                                   placeholder="https://maps.google.com/...">
                            @error('map_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-1 text-xs text-gray-500">URL embed dari Google Maps</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors shadow-lg">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-lg font-medium transition-colors">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logo-preview');
            const previewImage = document.getElementById('logo-preview-image');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const primaryColor = document.getElementById('primary_color');
            const primaryColorText = document.getElementById('primary_color_text');

            if (!primaryColor || !primaryColorText) return;

            const normalizeHex = (value) => {
                if (!value) return null;
                const trimmed = value.trim();
                return /^#[0-9A-Fa-f]{6}$/.test(trimmed) ? trimmed : null;
            };

            primaryColor.addEventListener('input', () => {
                primaryColorText.value = primaryColor.value;
            });

            primaryColorText.addEventListener('input', () => {
                const hex = normalizeHex(primaryColorText.value);
                if (hex) primaryColor.value = hex;
            });
        });
    </script>
    @endpush
</x-app-layout>

