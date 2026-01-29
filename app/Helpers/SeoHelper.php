<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate SEO meta tags
     */
    public static function meta($title, $description = null, $image = null, $url = null, $type = 'website')
    {
        $siteName = config('app.name', 'Website Sekolah');
        $defaultDescription = 'Website resmi sekolah - Informasi terbaru seputar kegiatan, berita, dan program sekolah.';
        
        return [
            'title' => $title . ' | ' . $siteName,
            'description' => $description ?? $defaultDescription,
            'image' => $image ?? asset('images/default-og.jpg'),
            'url' => $url ?? url()->current(),
            'type' => $type,
            'site_name' => $siteName,
        ];
    }

    /**
     * Generate Open Graph tags
     */
    public static function openGraph($title, $description = null, $image = null, $url = null, $type = 'article')
    {
        $meta = self::meta($title, $description, $image, $url, $type);
        
        return [
            'og:title' => $meta['title'],
            'og:description' => $meta['description'],
            'og:image' => $meta['image'],
            'og:url' => $meta['url'],
            'og:type' => $meta['type'],
            'og:site_name' => $meta['site_name'],
        ];
    }

    /**
     * Generate Twitter Card tags
     */
    public static function twitterCard($title, $description = null, $image = null)
    {
        $meta = self::meta($title, $description, $image);
        
        return [
            'twitter:card' => 'summary_large_image',
            'twitter:title' => $meta['title'],
            'twitter:description' => $meta['description'],
            'twitter:image' => $meta['image'],
        ];
    }
}


