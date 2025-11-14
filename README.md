<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

# Showcase Products

Showcase Products adalah aplikasi katalog produk berbasis Laravel yang mendukung sistem multi-role (Admin, Seller, dan User).  
Penjual dapat membuat toko sendiri (sub-domain/username store), mengunggah produk, dan menampilkan katalog secara publik.  
Admin dapat melakukan verifikasi penjual dan memoderasi seluruh aktivitas dalam sistem.

---

## 🚀 Features
- Authentication (email + OTP verification)
- Seller verification (admin approval)
- Product showcase dengan gambar
- Subdomain/username store system
- Dashboard untuk Seller dan Admin
- CRUD Produk & Manajemen Kategori
- Database PostgreSQL

---

## 📦 Installation & Usage

### 1. Clone Repository

```bash
git clone https://github.com/iwaklele45/showcase_products.git
```

### 2. Masuk ke Folder Project

```bash
cd showcase_products
```

### 3. Install Dependencies Composer

```bash
composer update
```

### 4. Instal NPM Dependencies

```bash
npm install
```

### 5. Copy File Environment

```bash
cp .env.example .env
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Sesuaikan Konfigurasi Database
*Pastikan ```.env``` sudah diset untuk PostgreSQL.

```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=showcase_db
DB_USERNAME=postgres
DB_PASSWORD=yourpassword
```

### 8. Migrasi Database

```bash
php artisan migrate
```

### 9. Run Development Server

```bash
php artisan serve
```

### 10. Jalankan Vite/NPM

```bash
npm run dev
```

---

## 🛠 Tech Stack
- Laravel 12
- PostgreSQL
- Blade / Tailwind / Vite / Bootstrap
- Laravel Breeze
- Composer & NPM

## 📄 License
Project ini dirilis secara open-source.
