<?php

/**
 * Script untuk membuat symbolic link storage
 * 
 * Jalankan dengan: php setup-storage-link.php
 * atau gunakan: php artisan storage:link
 */

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "Storage link sudah ada.\n";
    exit(0);
}

if (!is_dir($target)) {
    mkdir($target, 0755, true);
    mkdir($target . '/images', 0755, true);
    mkdir($target . '/photos', 0755, true);
}

if (PHP_OS_FAMILY === 'Windows') {
    // Windows menggunakan junction
    exec("mklink /J \"$link\" \"$target\"", $output, $return);
} else {
    // Unix/Linux/Mac menggunakan symlink
    symlink($target, $link);
}

if (file_exists($link)) {
    echo "Storage link berhasil dibuat!\n";
    echo "Target: $target\n";
    echo "Link: $link\n";
} else {
    echo "Gagal membuat storage link. Silakan jalankan: php artisan storage:link\n";
}

