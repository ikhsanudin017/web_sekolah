<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeacherPublicController;
use App\Http\Controllers\PpdbController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\HeroSlideController;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/guru', [TeacherPublicController::class, 'index'])->name('teachers');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb');

// Posts (Public)
Route::get('/berita', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{post:slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

// PPDB Registration Form
Route::get('/ppdb/daftar', function () {
    return view('ppdb.registration');
})->name('ppdb.registration');

// Admin Auth (login terpisah)
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Posts (Berita)
    Route::resource('posts', PostController::class);
    
    // Teachers (Data Guru)
    Route::resource('teachers', TeacherController::class);
    
    // Galleries (Galeri)
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);

    // Hero Slides
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    
    // School Settings (Pengaturan Sekolah)
    Route::get('/settings', [\App\Http\Controllers\Admin\SchoolSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [\App\Http\Controllers\Admin\SchoolSettingController::class, 'update'])->name('settings.update');
    
    // PPDB Management
    Route::get('/ppdb', [\App\Http\Controllers\Admin\PpdbController::class, 'index'])->name('ppdb.index');
    Route::put('/ppdb/{registration}/status', [\App\Http\Controllers\Admin\PpdbController::class, 'updateStatus'])->name('ppdb.updateStatus');
    Route::get('/ppdb/export', [\App\Http\Controllers\Admin\PpdbController::class, 'export'])->name('ppdb.export');
});

require __DIR__.'/auth.php';
