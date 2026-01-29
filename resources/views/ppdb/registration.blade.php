<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran PPDB - {{ config('app.name', 'Website Sekolah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme')
    @livewireStyles
</head>
<body class="bg-gray-50">
    <!-- Simple Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">← Kembali ke Beranda</a>
            </div>
        </div>
    </header>

    <!-- Livewire Component -->
    <div class="py-8">
        @livewire('ppdb-registration-form')
    </div>

    @livewireScripts
</body>
</html>

