# Optimasi Laravel - SEO & Performance

## Fitur yang Telah Diimplementasikan

### 1. SEO Metadata Dinamis

#### Komponen SEO Meta Tags
- File: `resources/views/components/seo-meta.blade.php`
- Helper: `app/Helpers/SeoHelper.php`
- Mendukung:
  - Title tag dinamis
  - Meta description
  - Open Graph tags (Facebook, WhatsApp)
  - Twitter Card tags
  - Custom image untuk sharing

#### Penggunaan
```blade
<x-seo-meta 
    title="Judul Halaman" 
    description="Deskripsi halaman"
    image="{{ asset('path/to/image.jpg') }}"
    url="{{ route('posts.show', $post) }}"
    type="article"
/>
```

### 2. URL SEO-Friendly dengan Spatie Sluggable

#### Model yang Menggunakan Sluggable
- **Post**: URL format `/berita/juara-1-lomba-sains`
- **Category**: URL format `/berita?category=prestasi`

#### Implementasi
- Package: `spatie/laravel-sluggable`
- Auto-generate slug dari title/name
- Route model binding menggunakan slug

#### Routes
```php
Route::get('/berita/{post:slug}', [PostController::class, 'show']);
```

### 3. Fitur Pencarian Berita

#### Halaman Berita
- Route: `/berita`
- Fitur:
  - Search berdasarkan judul, excerpt, content, atau kategori
  - Filter berdasarkan kategori
  - Pagination
  - Responsive design

#### Controller
- File: `app/Http/Controllers/PostController.php`
- Search menggunakan LIKE query dengan OR conditions

### 4. Eager Loading untuk Mencegah N+1 Query

#### Query yang Dioptimasi
- **HomeController**: Posts dengan category & user
- **PostController**: Posts dengan category & user
- **DashboardController**: Posts dengan category & user
- **Admin/PostController**: Semua query menggunakan `with()`

#### Contoh Implementasi
```php
// Sebelum (N+1 Query)
$posts = Post::all(); // 1 query
foreach($posts as $post) {
    $post->category; // N queries
    $post->user; // N queries
}

// Sesudah (3 queries total)
$posts = Post::with(['category', 'user'])->get(); // 3 queries total
```

### 5. Database Seeder Lengkap

#### Data yang Disediakan
- **1 Admin User**: admin@sekolah.com / password
- **5 Guru Users**: Role guru
- **50 Siswa Users**: Role siswa
- **5 Categories**: Berita Sekolah, Prestasi, Kegiatan, Pengumuman, Pendidikan
- **20 Posts**: Dengan berbagai kategori dan status
- **12 Teachers**: Dengan berbagai jabatan
- **1 School Setting**: Data sekolah lengkap
- **15 PPDB Registrations**: Dengan berbagai status

#### Cara Menjalankan Seeder
```bash
php artisan migrate:fresh --seed
# atau
php artisan db:seed
```

## Instalasi Package Baru

1. Install Spatie Sluggable:
```bash
composer require spatie/laravel-sluggable
```

2. Publish config (opsional):
```bash
php artisan vendor:publish --provider="Spatie\Sluggable\SluggableServiceProvider"
```

3. Update autoload:
```bash
composer dump-autoload
```

## Routes Baru

- `/berita` - List semua berita dengan search & filter
- `/berita/{slug}` - Detail berita dengan SEO-friendly URL

## File yang Dibuat/Diupdate

1. `app/Models/Post.php` - Menambahkan HasSlug trait
2. `app/Models/Category.php` - Menambahkan HasSlug trait
3. `app/Helpers/SeoHelper.php` - Helper untuk SEO meta tags
4. `resources/views/components/seo-meta.blade.php` - Component SEO
5. `app/Http/Controllers/PostController.php` - Controller untuk public berita
6. `resources/views/posts/index.blade.php` - Halaman list berita
7. `resources/views/posts/show.blade.php` - Halaman detail berita
8. `database/seeders/DatabaseSeeder.php` - Seeder lengkap
9. `composer.json` - Menambahkan Spatie Sluggable & autoload helpers
10. Semua controller - Update dengan eager loading

## Optimasi Performance

### Query Optimization
- Semua query yang membutuhkan relasi menggunakan `with()`
- Mencegah N+1 query problem
- Pagination untuk data besar

### SEO Optimization
- URL SEO-friendly dengan slug
- Meta tags lengkap untuk social sharing
- Open Graph untuk WhatsApp/Facebook
- Twitter Card support

### User Experience
- Search functionality di halaman berita
- Filter berdasarkan kategori
- Related posts di detail berita
- Share buttons untuk social media

## Testing

Setelah menjalankan seeder, website akan memiliki:
- Data lengkap untuk demo
- Admin login: admin@sekolah.com / password
- Berita dengan berbagai kategori
- Guru dengan berbagai jabatan
- Pendaftar PPDB dengan berbagai status

## Catatan Penting

1. Pastikan menjalankan `composer dump-autoload` setelah update composer.json
2. Slug akan auto-generate saat membuat post/category baru
3. SEO meta tags otomatis ter-generate di setiap halaman
4. Eager loading sudah diterapkan di semua controller yang membutuhkan


