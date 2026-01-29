# Instruksi Install Laravel Breeze

Setelah menjalankan `composer install`, install Laravel Breeze dengan perintah:

```bash
php artisan breeze:install blade
```

Ini akan membuat:
- Auth controllers (Login, Register, dll)
- Auth views (login.blade.php, register.blade.php, dll)
- Profile views
- Middleware dan routes untuk autentikasi

Setelah install Breeze, pastikan:
1. Middleware `CheckRole` sudah terdaftar di `bootstrap/app.php` (sudah dibuat)
2. Routes admin sudah menggunakan middleware `role:admin` (sudah dibuat)
3. Views menggunakan layout yang benar (sudah dibuat)

## Catatan Penting

- Middleware `CheckRole` sudah dibuat di `app/Http/Middleware/CheckRole.php`
- Middleware sudah terdaftar dengan alias `role` di `bootstrap/app.php`
- Routes admin sudah dilindungi dengan middleware `role:admin`
- Dashboard dan CRUD views sudah menggunakan layout Breeze

Setelah install Breeze, struktur auth akan lengkap dan siap digunakan.

