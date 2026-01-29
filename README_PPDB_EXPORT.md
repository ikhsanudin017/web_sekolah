# Fitur Export Data PPDB

## Deskripsi
Fitur ini memungkinkan admin untuk mendownload data pendaftaran PPDB dalam format Excel (.xlsx).

## Cara Menggunakan

### 1. Akses Halaman PPDB Admin
- Login sebagai admin
- Masuk ke menu **PPDB Management** di dashboard admin
- URL: `/admin/ppdb`

### 2. Download Data PPDB
Ada 2 cara untuk mendownload data:

#### Cara 1: Download Semua Data
1. Klik tombol **"Download Excel"** di bagian atas halaman (header)
2. File Excel akan terdownload otomatis dengan nama `ppdb-registrations-YYYY-MM-DD.xlsx`

#### Cara 2: Download dengan Filter
1. Gunakan fitur filter untuk menyaring data:
   - **Pencarian**: Masukkan nama, NISN, email, no HP, atau asal sekolah
   - **Status**: Pilih status (Pending, Proses, atau Diterima)
2. Klik tombol **"Filter"**
3. Klik tombol **"Download Excel"** atau **"Download Data"** di bagian bawah tabel
4. File Excel yang terdownload hanya berisi data sesuai filter yang aktif

### 3. Reset Filter
- Jika ingin menghapus filter dan menampilkan semua data, klik tombol **"Reset"**

## Data yang Diexport

File Excel yang terdownload berisi kolom-kolom berikut:
1. **No** - Nomor urut
2. **Nama Lengkap** - Nama lengkap calon siswa
3. **NISN** - Nomor Induk Siswa Nasional
4. **Tempat Lahir** - Tempat kelahiran siswa
5. **Tanggal Lahir** - Tanggal kelahiran siswa
6. **Jenis Kelamin** - Laki-laki/Perempuan
7. **Alamat Rumah** - Alamat tempat tinggal siswa
8. **Email** - Alamat email
9. **No. HP** - Nomor handphone
10. **Asal Sekolah** - Nama sekolah sebelumnya
11. **Alamat Sekolah Asal** - Alamat sekolah sebelumnya
12. **Tahun Lulus** - Tahun lulus dari sekolah sebelumnya
13. **Status** - Status pendaftaran (Pending/Proses/Diterima)
14. **Tanggal Daftar** - Tanggal dan waktu pendaftaran

## Format File

- **Format**: Excel 2007+ (.xlsx)
- **Nama File**: `ppdb-registrations-YYYY-MM-DD.xlsx`
  - Contoh: `ppdb-registrations-2026-01-12.xlsx`
- **Header**: Baris pertama dengan background biru dan teks putih tebal
- **Auto-size**: Lebar kolom menyesuaikan isi otomatis

## Fitur Tambahan

### Filter Otomatis
- Filter yang aktif di halaman web akan diterapkan pada data export
- Ini berguna untuk:
  - Download hanya data dengan status tertentu
  - Download data siswa dari sekolah tertentu
  - Download hasil pencarian spesifik

### Statistik
- Di bagian atas halaman terdapat statistik:
  - Total Pendaftar
  - Jumlah Pending
  - Jumlah Proses
  - Jumlah Diterima

## Tips Penggunaan

1. **Export Berkala**: Download data secara berkala untuk backup
2. **Filter Status**: Export berdasarkan status untuk mempermudah analisis
3. **Pencarian Spesifik**: Gunakan pencarian untuk menemukan dan export data siswa tertentu
4. **Olah Data**: File Excel dapat dibuka dan diolah menggunakan:
   - Microsoft Excel
   - Google Sheets
   - LibreOffice Calc
   - WPS Office

## Troubleshooting

### File Tidak Terdownload
- Pastikan browser tidak memblokir download
- Cek pengaturan download di browser
- Pastikan ada koneksi internet yang stabil

### File Kosong
- Pastikan ada data di database
- Cek apakah filter terlalu spesifik
- Reset filter dan coba lagi

### Error Saat Download
- Refresh halaman dan coba lagi
- Clear browser cache
- Hubungi developer jika masalah berlanjut

## Keamanan

- ✅ Hanya admin yang bisa mengakses fitur ini
- ✅ Memerlukan autentikasi
- ✅ Data sensitif siswa terlindungi
- ✅ File download langsung, tidak tersimpan di server

## Update Log

### Version 1.0 (2026-01-12)
- ✅ Export data PPDB ke Excel
- ✅ Filter data sebelum export
- ✅ Styling header dengan warna
- ✅ Auto-size kolom
- ✅ Include field catatan
- ✅ Format tanggal Indonesia (dd/mm/yyyy)
