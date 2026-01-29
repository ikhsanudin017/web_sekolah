@php
    $setting = \App\Models\SchoolSetting::first();
    $primary = $setting?->primary_color;
    $primary = is_string($primary) && preg_match('/^#[0-9A-Fa-f]{6}$/', $primary) ? $primary : '#2563eb';
    $favicon = $setting?->logo ? asset('storage/' . $setting->logo) : null;
@endphp

<link rel="icon" href="{{ $favicon ?? asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ $favicon ?? asset('favicon.ico') }}">
<meta name="theme-color" content="{{ $primary }}">
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<style>
    :root { --theme-primary: {{ $primary }}; }
</style>
