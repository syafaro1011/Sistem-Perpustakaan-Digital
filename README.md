# Sistem Perpustakaan Digital

Sistem Perpustakaan Digital adalah aplikasi berbasis web yang dibangun menggunakan framework **Laravel 11** dan **Bootstrap 5**. Aplikasi ini dirancang untuk memudahkan pengelolaan administrasi perpustakaan, mulai dari manajemen buku, anggota, hingga pencatatan transaksi peminjaman, pengembalian, dan perhitungan denda keterlambatan secara otomatis.

---

## 🚀 Fitur Utama

- **Dashboard Statistik Dinamis**
    - Ringkasan total judul & stok buku, jumlah anggota, dan kategori.
    - Statistik transaksi: peminjaman aktif, selesai, terlambat, serta rekap denda (lunas & belum lunas).
    - Grafik tren peminjaman bulanan menggunakan **Chart.js**.
    - Visualisasi distribusi kategori buku (doughnut chart).
    - List Top 5 Buku Terpopuler (paling sering dipinjam).
    - Daftar peminjaman terbaru dan daftar anggota dengan peminjaman yang terlambat.

- **Manajemen Buku & Kategori**
    - Kelola data buku: Judul, Kode Buku, Penulis, Penerbit, Tahun Terbit, Stok, ISBN, Sinopsis, dan unggah Cover Buku.
    - Relasi Many-to-Many antara Buku dan Kategori.

- **Manajemen Anggota**
    - Pencatatan data anggota (Nama, No. Anggota, Email, No. HP, Alamat).
    - Pengaturan status keaktifan anggota (Aktif / Nonaktif).

- **Transaksi Peminjaman & Pengembalian**
    - Pencatatan tanggal pinjam dan batas waktu pengembalian.
    - Pencatatan pengembalian buku beserta kondisi buku saat dikembalikan (Baik / Rusak / Hilang).
    - Perhitungan hari keterlambatan secara otomatis.

- **Sistem Denda Otomatis**
    - Otomatis menghitung akumulasi denda keterlambatan berdasarkan jumlah hari terlambat.
    - Pencatatan riwayat pembayaran denda (Belum Bayar / Lunas).

- **Log Aktivitas (Audit Trail)**
    - Pencatatan riwayat aktivitas CRUD sistem secara otomatis menggunakan package `spatie/laravel-activitylog`.

- **Multi-Role Autentikasi**
    - **Admin**: Memiliki akses penuh terhadap seluruh fitur termasuk manajemen kategori buku dan log aktivitas.
    - **Petugas**: Memiliki akses ke manajemen buku, anggota, peminjaman, pengembalian, dan denda.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP 8.2+ & Laravel 11
- **Database**: MySQL / MariaDB
- **Frontend**: Bootstrap 5, Bootstrap Icons, & Chart.js (via CDN)
- **Library/Package**:
    - `laravel/breeze` (Autentikasi starter kit)
    - `spatie/laravel-activitylog` (Pencatatan log aktivitas)

---

## ⚙️ Cara Instalasi & Menjalankan Projek

Ikuti langkah-langkah di bawah ini untuk menjalankan projek di lingkungan lokal Anda:

### 1. Clone Repository

```bash
git clone https://github.com/username/Sistem-Perpustakaan-Digital.git
cd Sistem-Perpustakaan-Digital
```

### 2. Install Dependensi Composer

```bash
composer install
```

### 3. Konfigurasi Environment File

Salin file `.env.example` menjadi `.env`:

```bash
copy .env.example .env
```

Buka file `.env` yang baru dibuat dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3006
DB_DATABASE=sistem_perpustakaan_digital
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi dan Seeder

Jalankan perintah ini untuk membuat tabel beserta data awal (seeders):

```bash
php artisan migrate --seed
```

### 6. Hubungkan Storage Link

Gunakan perintah ini untuk membuat symlink agar cover buku yang diunggah dapat diakses publik:

```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal

```bash
php artisan serve
```

Buka peramban (browser) Anda dan akses `http://127.0.0.1:8000`.

---

<!-- ## 🔑 Kredensial Akun Default

Berikut adalah kredensial default yang dibuat oleh seeder untuk uji coba:

### 1. Akun Admin
- **Email**: `admin@perpustakaan.com`
- **Password**: `password`

### 2. Akun Petugas
- **Email**: `petugas@perpustakaan.com`
- **Password**: `password` -->
