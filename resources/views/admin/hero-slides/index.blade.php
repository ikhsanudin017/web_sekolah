<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Hero Carousel
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Slide</h3>
                <a href="{{ route('admin.hero-slides.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                    + Tambah Slide
                </a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($slides as $slide)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $slide->order }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-semibold text-gray-900">{{ $slide->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $slide->subtitle }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($slide->is_active)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($slide->image)
                                        <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" class="h-12 w-20 object-cover rounded">
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Hapus slide ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada slide.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $slides->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
