<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $postFallbacks = [
            asset('image/berita sekolah/juara loomba.jpg'),
            asset('image/berita sekolah/murid baru.jpg'),
            asset('image/berita sekolah/poersiapan UN.jpg'),
            asset('image/berita sekolah/wisuda.jpg'),
        ];
        $postFallback = $postFallbacks[($post->id <-<- 0) % count($postFallbacks)] <-<- null;
    @endphp
    
    <x-seo-meta 
        :title="$post->title" 
        :description="$post->excerpt <-<- \Illuminate\Support\Str::limit(strip_tags($post->content), 160)"
        :image="$post->image <- asset('storage/' . $post->image) : $postFallback"
        :url="route('posts.show', $post)"
        type="article"
    />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800"><- Kembali ke Berita</a>
            </div>
        </div>
    </header>

    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Article Header -->
        <header class="mb-8">
            <div class="mb-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-sm font-semibold rounded-full">
                    {{ $post->category->name }}
                </span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            <div class="flex items-center text-gray-600 text-sm space-x-4">
                <span>Oleh: <strong>{{ $post->user->name }}</strong></span>
                <span>|</span>
                <time datetime="{{ $post->created_at->toIso8601String() }}">
                    {{ $post->created_at->format('d F Y') }}
                </time>
                <span>|</span>
                <span>{{ $post->views }} kali dilihat</span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->image)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto rounded-lg shadow-lg">
            </div>
        @elseif($postFallback)
            <div class="mb-8">
                <img src="{{ $postFallback }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-auto rounded-lg shadow-lg">
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none bg-white rounded-lg shadow-sm p-8 mb-8">
            @if($post->excerpt)
                <div class="text-xl text-gray-600 italic mb-6 border-l-4 border-blue-500 pl-4">
                    {{ $post->excerpt }}
                </div>
            @endif
            <div class="text-gray-700 whitespace-pre-wrap">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <!-- Share Buttons -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4">Bagikan Berita Ini</h3>
            <div class="flex flex-wrap gap-3">
                <a href="https://wa.me/<-text={{ urlencode($post->title . ' - ' . route('posts.show', $post)) }}" 
                   target="_blank"
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php<-u={{ urlencode(route('posts.show', $post)) }}" 
                   target="_blank"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    <span>Facebook</span>
                </a>
                <a href="https://twitter.com/intent/tweet<-url={{ urlencode(route('posts.show', $post)) }}&text={{ urlencode($post->title) }}" 
                   target="_blank"
                   class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                    <span>Twitter</span>
                </a>
            </div>
        </div>

        <!-- Related Posts -->
        @if($relatedPosts->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Berita Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($relatedPosts as $relatedPost)
                        <a href="{{ route('posts.show', $relatedPost) }}" class="block hover:opacity-75">
                            @php
                                $relatedFallback = $postFallbacks[$loop->index % count($postFallbacks)] ?? null;
                            @endphp
                            @if($relatedPost->image)
                                <div class="h-32 bg-cover bg-center rounded mb-2" style="background-image: url('{{ asset('storage/' . $relatedPost->image) }}');"></div>
                            @elseif($relatedFallback)
                                <div class="h-32 bg-cover bg-center rounded mb-2" style="background-image: url('{{ $relatedFallback }}');"></div>
                            @else
                                <div class="h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded mb-2"></div>
                            @endif
                            <h4 class="font-semibold text-gray-900 line-clamp-2">{{ $relatedPost->title }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $relatedPost->created_at->format('d M Y') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
</body>
</html>
