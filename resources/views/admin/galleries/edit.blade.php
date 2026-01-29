<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Foto Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Foto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $gallery->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror" 
                               placeholder="Masukkan judul foto"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror" 
                                  placeholder="Deskripsi foto (opsional)">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Foto Saat Ini
                        </label>
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="max-w-md h-auto rounded-lg shadow-md">
                    </div>

                    <!-- New Image -->
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ganti Foto (opsional)
                        </label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror"
                               onchange="previewImage(event)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @else
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB</p>
                        @enderror
                        
                        <!-- Preview -->
                        <div id="preview" class="mt-4 hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <img id="preview-image" src="" alt="Preview" class="max-w-full h-auto rounded-lg shadow-md">
                        </div>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" 
                                id="category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror"
                                required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $gallery->category) == $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                            Urutan Tampil
                        </label>
                        <input type="number" 
                               name="order" 
                               id="order" 
                               value="{{ old('order', $gallery->order) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror" 
                               placeholder="0">
                        <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin di depan</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="is_published" 
                                   value="1"
                                   {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}
                                   class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                            <span class="ml-3 text-sm font-medium text-gray-700">Publikasikan foto</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex space-x-3 pt-4 border-t">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Update
                        </button>
                        <a href="{{ route('admin.galleries.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-medium transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewImage = document.getElementById('preview-image');
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
    </script>
    @endpush
</x-app-layout>

