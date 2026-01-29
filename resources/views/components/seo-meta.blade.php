@props(['title', 'description' => null, 'image' => null, 'url' => null, 'type' => 'website'])

@php
    $seo = \App\Helpers\SeoHelper::meta($title, $description, $image, $url, $type);
    $og = \App\Helpers\SeoHelper::openGraph($title, $description, $image, $url, $type);
    $twitter = \App\Helpers\SeoHelper::twitterCard($title, $description, $image);
@endphp

<!-- Primary Meta Tags -->
<title>{{ $seo['title'] }}</title>
<meta name="title" content="{{ $seo['title'] }}">
<meta name="description" content="{{ $seo['description'] }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $og['og:type'] }}">
<meta property="og:url" content="{{ $og['og:url'] }}">
<meta property="og:title" content="{{ $og['og:title'] }}">
<meta property="og:description" content="{{ $og['og:description'] }}">
<meta property="og:image" content="{{ $og['og:image'] }}">
<meta property="og:site_name" content="{{ $og['og:site_name'] }}">

<!-- Twitter -->
<meta property="twitter:card" content="{{ $twitter['twitter:card'] }}">
<meta property="twitter:url" content="{{ $seo['url'] }}">
<meta property="twitter:title" content="{{ $twitter['twitter:title'] }}">
<meta property="twitter:description" content="{{ $twitter['twitter:description'] }}">
<meta property="twitter:image" content="{{ $twitter['twitter:image'] }}">

<!-- Additional Meta Tags -->
<meta name="robots" content="index, follow">
<meta name="language" content="Indonesian">
<meta name="author" content="{{ $seo['site_name'] }}">


