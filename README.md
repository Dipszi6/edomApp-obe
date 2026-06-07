# 📚 EdomApp
 
> Platform rating & ulasan dosen dan mata kuliah untuk mahasiswa di Universitas Pancasakti Tegal.
 
![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38BDF8?style=flat&logo=tailwindcss&logoColor=white)
 
---
 
## 📌 Tentang Project
 
EdomApp adalah platform web yang memungkinkan mahasiswa memberikan **rating dan ulasan** terhadap dosen dan mata kuliah secara **anonim**. Project ini dibuat sebagai karya kelompok untuk **Gelar Karya** dengan studi kasus lingkungan di dalam Universitas Pancasakti Tegal.
 
---
 
## ✨ Fitur
 
### Fitur Wajib
- 🔐 **Autentikasi** — Login & registrasi dengan verifikasi role
- 🔍 **Search & Filter** — Cari dosen/matkul berdasarkan nama atau jurusan
- 👤 **Halaman Profil** — Tampilkan rating, ulasan, dan tag per dosen/matkul
- 💬 **Baca & Upvote Ulasan** — Lihat dan upvote ulasan yang helpful
- ⭐ **Form Penilaian** — Isi bintang (1–5), ulasan teks, dan tag
- 📊 **Kalkulasi Rating Otomatis** — Rata-rata rating diperbarui setiap ada ulasan baru
### Fitur Bonus
- 🏷️ **Tag Otomatis** — Seperti `komunikatif`, `tugas_banyak`, `nilai_adil`
- 📈 **Dashboard Statistik** — Admin & dosen dapat melihat statistik ulasan
---
 
## 👥 Role Pengguna
 
| Role | Akses |
|---|---|
| **Mahasiswa** | Lihat profil, beri rating, upvote ulasan |
| **Dosen** | Lihat statistik & ulasan tentang dirinya sendiri |
| **Admin** | Kelola semua data, moderasi ulasan |
 
---
 
## 🛠️ Tech Stack
 
| Layer | Teknologi |
|---|---|
| Frontend | Blade Template + Tailwind CSS |
| Backend | Laravel 11 |
| Database | MySQL |
| Auth | Laravel Breeze |
| Server Lokal | Laragon / XAMPP |
| Deploy | Railway / Render |
 
---
 
## ⚙️ Instalasi & Setup
 
### Prasyarat
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM
- Laragon / XAMPP
### Langkah Instalasi
 
**1. Clone repository**
```bash
git clone https://github.com/username/ratemyclass.git
cd ratemyclass
```
 
**2. Install dependencies**
```bash
composer install
npm install
```
 
**3. Konfigurasi environment**
```bash
cp .env.example .env
php artisan key:generate
```
 
Edit file `.env`:
```env
APP_NAME=RateMyClass
APP_URL=http://localhost:8000
 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ratemyclass
DB_USERNAME=root
DB_PASSWORD=
```
 
**4. Buat database**
```sql
CREATE DATABASE ratemyclass;
```
 
**5. Jalankan migration & seeder**
```bash
php artisan migrate:fresh --seed
```
 
**6. Build assets**
```bash
npm run dev
```
 
**7. Jalankan server**
```bash
php artisan serve
```
 
Buka browser → `http://localhost:8000`
 
---
 
## 🗄️ Struktur Database
 
```
jurusans
    id, kode, nama, fakultas
 
users
    id, name, email, password, nim, angkatan, jurusan_id, role, avatar, is_active
 
dosens
    id, user_id, nidn, nama, gelar, jurusan_id, foto, avg_rating, total_review
 
matkuls
    id, kode, nama, sks, semester, jurusan_id, avg_rating, total_review
 
reviews
    id, user_id, dosen_id, matkul_id, rating, ulasan, tags, upvotes, is_anonim, is_visible
 
review_upvotes
    id, user_id, review_id
```
 
### Relasi Antar Tabel
```
jurusans ──< users
jurusans ──< dosens ──< reviews >── users
jurusans ──< matkuls ──< reviews
dosens ──── users (via user_id)
reviews ──< review_upvotes >── users
```
 
---
 
## 🔗 Routes
 
### Public
| Method | URL | Keterangan |
|---|---|---|
| GET | `/` | Halaman utama |
| GET | `/search` | Pencarian dosen & matkul |
| GET | `/dosen/{id}` | Profil dosen |
| GET | `/matkul/{id}` | Profil matkul |
 
### Auth
| Method | URL | Keterangan |
|---|---|---|
| GET | `/login` | Halaman login |
| POST | `/login` | Proses login |
| GET | `/register` | Halaman registrasi |
| POST | `/register` | Proses registrasi |
| POST | `/logout` | Logout |
 
### Protected (Auth)
| Method | URL | Keterangan |
|---|---|---|
| GET | `/review/create` | Form beri ulasan |
| POST | `/review` | Simpan ulasan |
| PATCH | `/review/{id}/upvote` | Upvote ulasan |
 
### Dashboard
| Method | URL | Keterangan |
|---|---|---|
| GET | `/dashboard/dosen` | Dashboard dosen |
| GET | `/dashboard/admin` | Dashboard admin |
| PATCH | `/dashboard/admin/review/{id}/toggle` | Moderasi ulasan |
 
---
 
## 📁 Struktur Folder
 
```
EdomApp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── Dashboard/
│   │   │   │   ├── AdminDashboardController.php
│   │   │   │   └── DosenDashboardController.php
│   │   │   ├── HomeController.php
│   │   │   ├── SearchController.php
│   │   │   ├── DosenController.php
│   │   │   ├── MatkulController.php
│   │   │   └── ReviewController.php
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Jurusan.php
│       ├── Dosen.php
│       ├── Matkul.php
│       ├── Review.php
│       └── ReviewUpvote.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── JurusanSeeder.php
│       ├── UserSeeder.php
│       ├── DosenSeeder.php
│       ├── MatkulSeeder.php
│       └── ReviewSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard/
│       │   ├── dosen.blade.php
│       │   └── admin.blade.php
│       ├── dosen/
│       │   └── show.blade.php
│       ├── matkul/
│       │   └── show.blade.php
│       ├── review/
│       │   └── create.blade.php
│       ├── home.blade.php
│       └── search.blade.php
└── routes/
    └── web.php
```
 
---
 
## 🌱 Akun Default (Seeder)
 
| Role | Email | Password |
|---|---|---|
| Admin | admin@rmc.ac.id | password |
| Dosen | budi@dosen.ac.id | password |
| Dosen | siti@dosen.ac.id | password |
| Mahasiswa | andi@mhs.ac.id | password |
| Mahasiswa | dewi@mhs.ac.id | password |
 
---
 
## 🏷️ Daftar Tag Tersedia
 
```
komunikatif      tugas_banyak     tugas_wajar
nilai_adil       nilai_pelit      materi_jelas
materi_sulit     asik_orangnya    tepat_waktu
sering_absen     challenging      recommended
```
 
---
 
## 👥 Tim Pengembang
 
| Nama | Role | Tugas |
|---|---|---|
| [Pradipa Amanta] | Project Manager | Setup Laravel, Auth, Koordinasi | QA, Search & Testing |
| [Heru Satrio] | Backend Dev | Controller & Model Dosen, Matkul |
| [Bony Setiawan S.] | Backend Dev | Controller & Model Review, Upvote |
| [Alif Setiawan] | Frontend Dev | Blade Views, Tailwind UI |
| [Daafiq Alfaruq] | Frontend Dev | Blade Views, Tailwind UI |
 
---
 
## 📋 Progress Development
 
- [x] Migration & database
- [x] Models & relasi
- [x] Seeder & data dummy
- [x] Controllers & routes
- [ ] Blade Views
- [ ] Auth Controllers
- [ ] Middleware role
- [ ] Testing
- [ ] Deploy
---
 
## 📄 Lisensi
 
Project ini dibuat untuk keperluan akademik — **OBE Gelar Karya 2026**.
 
---
 
> Dibuat dengan laravel oleh Kelompok 3
