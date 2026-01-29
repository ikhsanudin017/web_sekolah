# Website Sekolah - Laravel Monolith

Website sekolah profesional menggunakan Laravel dengan Tailwind CSS dan Livewire.

## Fitur

- ✅ Sistem autentikasi dengan Laravel Breeze (Blade)
- ✅ Role-Based Access Control (RBAC) untuk admin
- ✅ Dashboard Admin
- ✅ CRUD Berita dengan upload gambar
- ✅ CRUD Data Guru dengan upload foto
- ✅ Laravel Storage untuk file management

## Instalasi

1. Install dependencies:
```bash
composer install
npm install
```

2. Setup environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Setup database di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

4. Jalankan migrasi:
```bash
php artisan migrate
```

5. Buat storage link:
```bash
php artisan storage:link
```

Atau gunakan script:
```bash
php setup-storage-link.php
```

6. Build assets:
```bash
npm run dev
# atau untuk production
npm run build
```

7. Jalankan server:
```bash
php artisan serve
```

## Struktur Database

### Users
- Role: admin, guru, siswa
- Autentikasi lengkap dengan Breeze

### Categories
- Kategori berita

### Posts
- Judul, slug, konten, image
- Relasi dengan category dan user
- Status published/draft

### Teachers
- Nama, NIP, jabatan, foto, bio
- Media sosial (JSON)
- Status aktif/tidak aktif

### PPDB Registrations
- Data pendaftaran siswa baru
- Status: pending/proses/diterima

### School Settings
- Pengaturan sekolah
- Logo, visi misi, alamat, kontak

## Routes

### Admin Routes (memerlukan role admin)
- `/admin/dashboard` - Dashboard admin
- `/admin/posts` - CRUD Berita
- `/admin/teachers` - CRUD Data Guru

### Auth Routes
- `/login` - Login
- `/register` - Register
- `/logout` - Logout

## Middleware

- `role:admin` - Membatasi akses hanya untuk admin

## Storage

File upload disimpan di:
- `storage/app/public/images/posts` - Gambar berita
- `storage/app/public/photos/teachers` - Foto guru

Pastikan symbolic link sudah dibuat dengan `php artisan storage:link`

