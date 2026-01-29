<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Galeri') }}
            </h2>
            <a href="{{ route('admin.galleries.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                + Tambah Foto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6">
                    @if($galleries->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($galleries as $gallery)
                                <div class="group relative bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden">
                                    <!-- Image -->
                                    <div class="aspect-w-16 aspect-h-12 bg-gray-200">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                                             alt="{{ $gallery->title }}"
                                             class="w-full h-48 object-cover">
                                    </div>

                                    <!-- Content -->
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-900 mb-1 line-clamp-1">{{ $gallery->title }}</h3>
                                        <p class="text-xs text-gray-500 mb-2">
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">{{ ucfirst($gallery->category) }}</span>
                                        </p>
                                        @if($gallery->description)
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $gallery->description }}</p>
                                        @endif
                                        <div class="flex items-center text-xs text-gray-500 mb-3">
                                            <span class="mr-3">Order: {{ $gallery->order }}</span>
                                            <span class="px-2 py-1 rounded-full {{ $gallery->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $gallery->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.galleries.edit', $gallery) }}" 
                                               class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm font-medium text-center transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                                                  class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $galleries->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Foto</h3>
                            <p class="text-gray-600 mb-4">Mulai tambahkan foto ke galeri</p>
                            <a href="{{ route('admin.galleries.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                + Tambah Foto Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

