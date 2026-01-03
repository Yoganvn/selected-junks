# 👟 Selected Junks - Walk With Stories.

**Selected Junks** adalah platform E-Commerce Thrift Shop modern yang dikhususkan untuk penjualan sepatu second branded berkualitas (curated). Dibangun dengan fokus pada *storytelling*, estetika visual, dan pengalaman belanja yang seamless.

![Project Preview](public/img/hero-bg.jpg)
*(Pastikan ada gambar preview di folder public/img atau ganti link ini nanti)*

## 🌟 Fitur Unggulan

* **🎨 Aesthetic UI/UX**: Desain modern dengan nuansa *premium dark/light mode*, tipografi yang kuat, dan layout responsif.
* **🛒 Smart Cart System**: Fitur keranjang belanja yang dinamis (tambah, hapus, dan hitung total otomatis).
* **⚡ Instant Checkout Flow**: Alur checkout ringkas: Cart -> Input Data Pengiriman -> Order Summary -> Success Page.
* **🔒 Real-time Inventory**: Sistem stok otomatis. Barang yang sudah di-checkout otomatis berubah status menjadi **"SOLD OUT"** dan tidak bisa dibeli user lain.
* **📱 Responsive Mobile-First**: Tampilan optimal di Smartphone, Tablet, maupun Desktop.

## 🛠️ Teknologi yang Digunakan

Project ini dibangun menggunakan stack modern untuk performa dan skalabilitas:

* **Framework**: [Laravel 11](https://laravel.com/)
* **Language**: PHP 8.2+
* **Styling**: [Tailwind CSS](https://tailwindcss.com/)
* **Database**: MySQL / SQLite
* **Templating**: Blade Engine
* **Icons**: Heroicons / SVGs

## 🚀 Cara Menjalankan Project (Installation)

Ikuti langkah ini untuk menjalankan project di komputer lokal Anda:

### 1. Prasyarat
Pastikan sudah terinstall:
* PHP & Composer
* Node.js & NPM
* Database (MySQL/MariaDB atau SQLite)

### 2. Instalasi

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/USERNAME_GITHUB/selected-junks.git](https://github.com/USERNAME_GITHUB/selected-junks.git)
    cd selected-junks
    ```

2.  **Install Dependensi PHP & JS**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    * Copy file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    * Buka file `.env`, atur koneksi database (DB_DATABASE, DB_USERNAME, dll).

4.  **Generate Key & Migrasi**
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```

5.  **Setup Storage Gambar** (PENTING: Agar gambar sepatu muncul)
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan Server**
    Buka dua terminal berbeda:
    * Terminal 1 (Laravel): `php artisan serve`
    * Terminal 2 (Tailwind): `npm run dev`

7.  **Selesai!**
    Buka browser dan kunjungi: `http://127.0.0.1:8000`

## 🤝 Kontribusi & Workflow

1.  Lakukan `git pull` sebelum mulai coding untuk update terbaru.
2.  Buat branch baru jika membuat fitur besar.
3.  Jangan lupa commit perubahan dengan pesan yang jelas.

---
© 2026 Selected Junks. Created with ❤️ by Yoga & Team.