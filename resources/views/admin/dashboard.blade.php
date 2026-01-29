<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <style>
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .animate-slideInDown {
            animation: slideInDown 0.6s ease-out;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-fadeInUp-delay-1 {
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .animate-fadeInUp-delay-2 {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .animate-fadeInUp-delay-3 {
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

    <div class="py-12 bg-gradient-to-br from-gray-50 via-blue-50 to-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-blue-700 rounded-2xl shadow-2xl p-8 mb-8 text-white animate-slideInDown">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="relative">
                    <h3 class="text-3xl font-extrabold mb-2 flex items-center gap-2">
                        Selamat Datang, {{ Auth::user()->name }}! 
                        <span class="animate-pulse">👋</span>
                    </h3>
                    <p class="text-blue-100 text-lg">Kelola semua konten dan data sekolah dari sini dengan mudah</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Berita -->
                <div class="card-hover bg-white overflow-hidden shadow-xl rounded-2xl border-l-4 border-blue-500 animate-fadeInUp">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Berita</div>
                            <div class="p-4 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $stats['total_posts'] }}</div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                📢 {{ $stats['published_posts'] }}
                            </span>
                            <span class="text-gray-400">|</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                📝 {{ $stats['draft_posts'] }} draft
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Guru -->
                <div class="card-hover bg-white overflow-hidden shadow-xl rounded-2xl border-l-4 border-green-500 animate-fadeInUp-delay-1">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Guru</div>
                            <div class="p-4 bg-gradient-to-br from-green-400 to-green-600 rounded-xl shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $stats['total_teachers'] }}</div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                ✅ {{ $stats['active_teachers'] }} aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Galeri -->
                <div class="card-hover bg-white overflow-hidden shadow-xl rounded-2xl border-l-4 border-purple-500 animate-fadeInUp-delay-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Galeri</div>
                            <div class="p-4 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $stats['total_galleries'] }}</div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 text-purple-800">
                                📸 Foto terupload
                            </span>
                        </div>
                    </div>
                </div>

                <!-- PPDB -->
                <div class="card-hover bg-white overflow-hidden shadow-xl rounded-2xl border-l-4 border-orange-500 animate-fadeInUp-delay-3">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">PPDB</div>
                            <div class="p-4 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="text-4xl font-extrabold text-gray-900 mb-2">{{ $stats['total_ppdb'] }}</div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">
                                ⏳ {{ $stats['ppdb_pending'] }}
                            </span>
                            <span class="text-gray-400">|</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                ✓ {{ $stats['ppdb_approved'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="card-hover bg-gradient-to-br from-indigo-50 to-indigo-100 overflow-hidden shadow-xl rounded-2xl p-6 border border-indigo-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-indigo-600 uppercase tracking-wide mb-1">Kategori</div>
                            <div class="text-3xl font-extrabold text-indigo-900">{{ $stats['total_categories'] }}</div>
                            <div class="text-xs text-indigo-600 mt-1">🏷️ Label berita</div>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-gradient-to-br from-pink-50 to-pink-100 overflow-hidden shadow-xl rounded-2xl p-6 border border-pink-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-pink-600 uppercase tracking-wide mb-1">Total Users</div>
                            <div class="text-3xl font-extrabold text-pink-900">{{ $stats['total_users'] }}</div>
                            <div class="text-xs text-pink-600 mt-1">👥 Pengguna terdaftar</div>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-pink-500 to-pink-700 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-xl rounded-2xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-1">Status Sistem</div>
                            <div class="text-2xl font-extrabold text-green-900 flex items-center gap-2">
                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                Normal
                            </div>
                            <div class="text-xs text-green-600 mt-1">✨ Berjalan lancar</div>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Posts -->
                <div class="card-hover bg-white overflow-hidden shadow-2xl rounded-2xl border-t-4 border-blue-500">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Berita Terbaru</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recent_posts->count() > 0)
                            <div class="space-y-3">
                                @foreach($recent_posts as $post)
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-blue-50 transition-colors border border-gray-100">
                                        <div class="flex-1">
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600 transition-colors">
                                                {{ Str::limit($post->title, 45) }}
                                            </a>
                                            <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                                <span>🕒 {{ $post->created_at->diffForHumans() }}</span>
                                                <span>•</span>
                                                <span class="px-2 py-0.5 bg-gray-100 rounded-full">{{ $post->category->name }}</span>
                                            </div>
                                        </div>
                                        <span class="ml-3 px-3 py-1 text-xs font-bold rounded-full shadow-sm {{ $post->is_published ? 'bg-green-100 text-green-700 border border-green-300' : 'bg-yellow-100 text-yellow-700 border border-yellow-300' }}">
                                            {{ $post->is_published ? '✓ Published' : '📝 Draft' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 font-bold transition-colors">
                                    <span>Lihat Semua Berita</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-4xl mb-2">📰</div>
                                <p class="text-gray-500 text-sm">Belum ada berita</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent PPDB -->
                <div class="card-hover bg-white overflow-hidden shadow-2xl rounded-2xl border-t-4 border-orange-500">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-6">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white">Pendaftaran PPDB Terbaru</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recent_registrations->count() > 0)
                            <div class="space-y-3">
                                @foreach($recent_registrations as $registration)
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-orange-50 transition-colors border border-gray-100">
                                        <div class="flex-1">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $registration->nama_lengkap }}
                                            </div>
                                            <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                                <span>🕒 {{ $registration->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <span class="ml-3 px-3 py-1 text-xs font-bold rounded-full shadow-sm
                                            @if($registration->status === 'pending') bg-yellow-100 text-yellow-700 border border-yellow-300
                                            @elseif($registration->status === 'diterima') bg-green-100 text-green-700 border border-green-300
                                            @else bg-blue-100 text-blue-700 border border-blue-300
                                            @endif">
                                            @if($registration->status === 'pending') ⏳ Pending
                                            @elseif($registration->status === 'diterima') ✓ Diterima
                                            @else 🔄 {{ ucfirst($registration->status) }}
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6">
                                <a href="{{ route('admin.ppdb.index') }}" class="inline-flex items-center gap-2 text-sm text-orange-600 hover:text-orange-800 font-bold transition-colors">
                                    <span>Lihat Semua Pendaftaran</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-4xl mb-2">📝</div>
                                <p class="text-gray-500 text-sm">Belum ada pendaftaran</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
