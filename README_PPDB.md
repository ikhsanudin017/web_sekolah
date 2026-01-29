# Fitur PPDB Online

## Instalasi

1. Install dependencies:
```bash
composer install
npm install
```

2. Install Laravel Excel (untuk export):
```bash
composer require maatwebsite/excel
```

3. Publish config Livewire (opsional):
```bash
php artisan vendor:publish --tag=livewire:config
```

4. Pastikan storage link sudah dibuat:
```bash
php artisan storage:link
```

## Fitur Formulir PPDB

### Steppers (3 Tahap)

1. **Tahap 1: Data Diri**
   - Nama Lengkap
   - NISN (10 digit angka, validasi real-time)
   - Email (validasi format email, real-time)
   - No. HP
   - Tempat & Tanggal Lahir
   - Jenis Kelamin
   - Alamat Lengkap

2. **Tahap 2: Data Sekolah Asal**
   - Nama Sekolah Asal
   - Alamat Sekolah Asal
   - Tahun Lulus

3. **Tahap 3: Upload Berkas**
   - Foto Dokumen (wajib, maksimal 2MB, format JPG/PNG)
   - Ijazah (opsional, maksimal 2MB)
   - KTP Orang Tua (opsional, maksimal 2MB)

### Validasi Real-time

- NISN: Hanya menerima angka, maksimal 10 digit
- Email: Validasi format email
- File upload: Validasi ukuran maksimal 2MB
- Semua field wajib divalidasi sebelum bisa lanjut ke step berikutnya

### Notifikasi

Setelah submit berhasil, akan muncul notifikasi sukses dan data tersimpan di database.

## Dashboard Admin PPDB

### Fitur

1. **List Pendaftar**
   - Menampilkan semua pendaftar dengan pagination
   - Filter berdasarkan status (pending/proses/diterima)
   - Search berdasarkan nama, NISN, email, no HP, atau asal sekolah

2. **Statistik**
   - Total pendaftar
   - Jumlah pending
   - Jumlah proses
   - Jumlah diterima

3. **Ubah Status**
   - Tombol "Ubah Status" di setiap baris
   - Modal untuk mengubah status pendaftar
   - Status: pending, proses, diterima

4. **Export to Excel**
   - Tombol "Export Excel" di header
   - Export semua data atau sesuai filter
   - Format: .xlsx
   - Kolom: No, Nama Lengkap, NISN, Email, No. HP, Asal Sekolah, Status, Tanggal Daftar

## Routes

- `/ppdb/registration` - Formulir pendaftaran PPDB (public)
- `/admin/ppdb` - List pendaftar (admin only)
- `/admin/ppdb/{id}/status` - Update status (admin only, PUT)
- `/admin/ppdb/export` - Export Excel (admin only)

## File Storage

File upload disimpan di:
- `storage/app/public/ppdb/documents/` - Semua dokumen PPDB

Pastikan symbolic link sudah dibuat dengan:
```bash
php artisan storage:link
```

## Model & Database

Data tersimpan di tabel `ppdb_registrations`:
- Field utama: nama_lengkap, nisn, email, no_hp, asal_sekolah, status
- Field notes (JSON): menyimpan data tambahan seperti tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, alamat_sekolah, tahun_lulus, dan path file upload

## Catatan

- NISN harus unik (tidak boleh duplikat)
- Email harus unik (tidak boleh duplikat)
- File upload maksimal 2MB per file
- Status default: pending

