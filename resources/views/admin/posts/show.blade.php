<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Berita') }}
            </h2>
            <div>
                <a href="{{ route('admin.posts.edit', $post) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            
            <div class="mb-4 flex items-center space-x-4 text-sm text-gray-500">
                <span>Kategori: <span class="font-semibold text-gray-700">{{ $post->category->name }}</span></span>
                <span>•</span>
                <span>Penulis: <span class="font-semibold text-gray-700">{{ $post->user->name }}</span></span>
                <span>•</span>
                <span>Tanggal: <span class="font-semibold text-gray-700">{{ $post->created_at->format('d M Y H:i') }}</span></span>
                <span>•</span>
                @if($post->is_published)
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                @endif
            </div>

            @if($post->image)
                <div class="mb-6">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg">
                </div>
            @endif

            @if($post->excerpt)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <p class="text-lg text-gray-700 italic">{{ $post->excerpt }}</p>
                </div>
            @endif

            <div class="prose max-w-none">
                <p class="whitespace-pre-wrap text-gray-700">{{ $post->content }}</p>
            </div>
        </div>
    </div>
</x-app-layout>

