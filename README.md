# 🏢 Recruitment PT. SURVIOUS

Aplikasi Web Open Recruitment PT. SURVIOUS — dibangun dengan Laravel 10, MySQL, Blade, dan Bootstrap 5.

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Konfigurasi `.env`
Buka file `.env` dan sesuaikan pengaturan database MySQL Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recruitment_survious   # ← Buat database ini di MySQL
DB_USERNAME=root                    # ← Sesuaikan username MySQL Anda
DB_PASSWORD=                        # ← Sesuaikan password MySQL Anda
```

### 2. Buat Database di MySQL
Jalankan perintah berikut di MySQL/phpMyAdmin:

```sql
CREATE DATABASE recruitment_survious CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Jalankan Perintah Artisan

```bash
# Migrasi tabel dan isi data awal
php artisan migrate --seed

# Buat symbolic link untuk storage (upload file)
php artisan storage:link

# Jalankan server development
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## 👤 Akun Login

| Role     | Kredensial                                         |
|----------|----------------------------------------------------|
| Admin    | Username: `admin` / Password: `admin123`           |
| HRD 1    | Email: `hrd1@surviouss.co.id` / Password: `hrd12345` |
| HRD 2    | Email: `hrd2@surviouss.co.id` / Password: `hrd12345` |
| Pelamar 1 | Email: `ahmad.rizki@gmail.com` / Password: `pelamar123` |
| Pelamar 2 | Email: `dewi.rahayu@gmail.com` / Password: `pelamar123` |
| Pelamar 3 | Email: `fajar.nugroho@yahoo.com` / Password: `pelamar123` |

---

## 🗺️ URL Halaman

| Halaman                    | URL                          |
|----------------------------|------------------------------|
| Beranda Publik             | `/`                          |
| Daftar Lowongan (publik)   | `/lowongan`                  |
| Login Admin                | `/admin/login`               |
| Dashboard Admin            | `/admin/dashboard`           |
| Login HRD                  | `/hrd/login`                 |
| Dashboard HRD              | `/hrd/dashboard`             |
| Login Pelamar              | `/pelamar/login`             |
| Daftar Akun Pelamar        | `/pelamar/daftar`            |
| Dashboard Pelamar          | `/pelamar/dashboard`         |

---

## 🗄️ Struktur Database (9 Tabel)

1. **admin** — Data akun administrator
2. **hrd** — Data akun HRD (FK ke admin)
3. **pelamar** — Data akun pelamar
4. **profil_perusahaan** — Profil PT. SURVIOUS (1 baris)
5. **departemen** — Daftar departemen
6. **lowongan** — Posting lowongan (FK ke hrd, departemen)
7. **lamaran** — Pengajuan lamaran (FK ke pelamar, lowongan)
8. **dokumen_lamaran** — File dokumen lamaran (FK ke lamaran)
9. **wawancara** — Jadwal dan hasil wawancara (FK ke lamaran)

---

## 📁 Struktur File Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/          ← Login/Logout/Register
│   │   ├── Admin/         ← Panel Admin
│   │   ├── Hrd/           ← Panel HRD
│   │   ├── Pelamar/       ← Panel Pelamar
│   │   └── PublicController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       ├── HrdMiddleware.php
│       └── PelamarMiddleware.php
└── Models/
    ├── Admin.php, Hrd.php, Pelamar.php
    ├── ProfilPerusahaan.php, Departemen.php
    ├── Lowongan.php, Lamaran.php
    ├── DokumenLamaran.php, Wawancara.php

resources/views/
├── layouts/
│   ├── public.blade.php   ← Layout halaman publik
│   ├── admin.blade.php    ← Layout panel Admin
│   ├── hrd.blade.php      ← Layout panel HRD
│   └── pelamar.blade.php  ← Layout portal Pelamar
├── auth/                  ← Halaman login/register
├── public/                ← Beranda, lowongan, detail
├── admin/                 ← Semua view Admin
├── hrd/                   ← Semua view HRD
└── pelamar/               ← Semua view Pelamar
```

---

## ✨ Fitur Lengkap

### Publik (tanpa login)
- Halaman beranda dengan hero, tentang perusahaan, keunggulan, lowongan terbaru, kontak
- Daftar lowongan aktif dengan pencarian dan filter (departemen, kategori, lokasi)
- Halaman detail lowongan dengan tombol "Lamar Sekarang"

### Admin
- Dashboard: ringkasan statistik (HRD, Lowongan, Pelamar, Lamaran)
- CRUD Akun HRD
- CRUD Departemen
- Edit Profil Perusahaan (termasuk upload logo)

### HRD
- Dashboard: statistik lowongan dan lamaran miliknya
- CRUD Lowongan (hanya miliknya sendiri)
- Melihat daftar pelamar per lowongan
- Melihat dokumen lamaran
- Update status lamaran + catatan HRD
- Tambah jadwal wawancara & isi hasil wawancara

### Pelamar
- Registrasi mandiri + login
- Edit profil & upload CV (PDF maks 2 MB)
- Melamar lowongan dengan upload dokumen (PDF maks 2 MB)
- Proteksi lamaran ganda (tidak bisa melamar 2x ke lowongan yang sama)
- Riwayat lamaran, status, dan jadwal wawancara

---

*Dibuat dengan Laravel 10 | Bootstrap 5 | MySQL*
