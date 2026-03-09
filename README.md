# Web Company Profile Platform

[![PHP Version](https://img.shields.io/badge/php-%5E8.0-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/mysql-%2300000f.svg?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/bootstrap-%23563d7c.svg?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

Platform ini adalah solusi **Web Company Profile** modern yang dirancang untuk membangun kredibilitas bisnis secara digital. Dilengkapi dengan pengelolaan konten mandiri, platform ini memungkinkan perusahaan untuk menampilkan profil, layanan, portofolio, dan artikel berita dengan antarmuka yang elegan dan profesional.

## 🌟 Fitur Utama

- **Sistem MVC Custom**: Arsitektur PHP mandiri yang ringan, cepat, dan mudah dipelihara.
- **Panel Admin (CMS)**: Dashboard eksklusif untuk manajemen konten artikel, layanan, portofolio, dan galeri secara dinamis.
- **Multi-bahasa**: Dukungan konten dalam dua bahasa (Indonesian & English) untuk audiens global.
- **Ekosistem Bisnis**: Halaman khusus untuk pilar bisnis utama, program edukasi, atau keterlibatan komunitas.
- **Statistik Dampak (Impact Counter)**: Menampilkan pencapaian atau statistik bisnis dengan animasi counter yang menarik.
- **Konversi Lead**: Fitur publikasi digital dan formulir kontak yang terintegrasi dengan email notifikasi melalui Brevo API.
- **Desain Responsif**: Optimal di berbagai perangkat (Mobile, Tablet, Desktop) menggunakan Bootstrap 5 dan Swiper.js.

## 🛠️ Tech Stack

- **Backend**: PHP (Native MVC)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3 (Custom), JavaScript (Vanilla & jQuery)
- **Library/Framework**:
  - Bootstrap 5
  - Swiper.js (Sliders)
  - Material Symbols & FontAwesome (Icons)
- **Integrasi**: Brevo API (SMTP/Transactional Email)

## 📁 Struktur Proyek

```text
company-profile_php/
├── app/                # Logika utama aplikasi (Core, Controllers, Models, Views)
│   ├── controllers/    # Alur logika setiap fitur
│   ├── core/           # Mesin inti sistem MVC
│   ├── models/         # Interaksi data (Database)
│   └── views/          # Antarmuka Pengguna (UI)
├── assets/             # File statis (CSS, JS, Images, Fonts)
├── public/             # Titik masuk aplikasi (index.php, .htaccess)
└── .env                # Pengaturan environment (DB, API Keys)
```

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.0
- MySQL/MariaDB
- Web Server (Apache/Nginx melalui XAMPP atau Laragon)

### Langkah-langkah
1. **Clone Repositori**
   ```bash
   git clone https://github.com/username/project-repo.git
   ```

2. **Konfigurasi Database**
   - Buat database baru di phpMyAdmin (misal: `db_company_profile`).
   - Import file SQL yang disediakan.

3. **Pengaturan Konfigurasi**
   - Sesuaikan file `app/config.php` untuk URL dasar:
     ```php
     define('BASE_URL', 'http://localhost/company-profile_php/');
     ```
   - Sesuaikan kredensial database di file `app/config.php` atau `.env`.

4. **Konfigurasi Email (Opsional)**
   - Masukkan `BREVO_API_KEY` di file `.env` untuk mengaktifkan fitur notifikasi email.

5. **Akses Platform**
   - Buka browser dan jalankan: `http://localhost/company-profile_php/`

## 🤝 Kontribusi

Saran dan kontribusi sangat dihargai. Silakan buka *issue* atau kirimkan *pull request* untuk meningkatkan performa atau menambahkan fitur baru.

---

Dikembangkan oleh **[Ari Khadnova]**

