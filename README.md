# KaryaSI - Karya Anak Sistem Informasi ITK

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Supabase-316192?style=flat&logo=postgresql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=flat&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

KaryaSI (Karya Anak Sistem Informasi) merupakan sebuah aplikasi berbasis web yang berfungsi sebagai wadah publikasi resmi
karya mahasiswa Sistem Informasi ITK. Aplikasi ini dirancang untuk menampung berbagai
jenis karya, baik yang dihasilkan melalui kegiatan akademik maupun non-akademik, seperti artikel ilmiah, laporan penelitian, prototype aplikasi, desain UI/UX, project mobile app, hingga proyek inovatif lainnya.


KaryaSI hadir sebagai solusi untuk:

📌 Meningkatkan dokumentasi digital karya mahasiswa

📌 Mendukung *academic branding* Program Studi Sistem Informasi ITK

📌 Menyediakan portofolio akademik yang mudah diakses mahasiswa

📌 Memudahkan dosen memantau, mengevaluasi, dan mengarsipkan karya mahasiswa

📌 Memperkuat pengetahuan digital yang berkelanjutan

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Role & Permissions](#role--permissions)
- [Fitur Berdasarkan Role](#fitur-berdasarkan-role)
- [Screenshot](#screenshot)
- [Struktur Database](#struktur-database)
- [User Flow](#user-flow)
- [Penggunaan](#penggunaan)
- [Deployment](#deployment)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Fitur Utama

### Manajemen Karya Mahasiswa

- ✅ **Unggah Karya Mahasiswa** – Pengguna dapat mengunggah berbagai jenis karya seperti artikel ilmiah, penelitian, prototype aplikasi, desain UI/UX, Business Model Canvas, dan inovasi lainnya

- ✅ **Draft & Publikasi** – Karya dapat disimpan sebagai draft untuk penyempurnaan atau dipublikasikan langsung (Author)
- ✅ **Verifikasi Karya** – Unggahan dari Visitor harus melewati proses verifikasi Admin sebelum dipublikasikan guna menjaga kualitas dan kredibilitas konten
- ✅ **Detail Karya Lengkap** – Setiap karya memuat judul, slug, konten rich text, kategori, tag, thumbnail, status publikasi, fitur komentar, jumlah views, serta profil pembuat karya
- ✅ **Showcase Publik** – Karya yang lolos verifikasi ditampilkan di halaman showcase sebagai portofolio digital mahasiswa Sistem Informasi ITK
- ✅ **Soft Delete** – Menyediakan portofolio akademik yang mudah diakses mahasiswa  

### Sistem Interaksi

- ✅ **Komentar & Diskusi** – Pengunjung dapat memberikan komentar sebagai bentuk diskusi dan apresiasi  
- ✅ **Moderasi Komentar** – Admin dapat memoderasi komentar untuk menjaga etika akademik  
- ✅ **Enable/Disable Comments** – Penulis dapat mengatur apakah komentar diizinkan untuk setiap karya  
- ✅ **Status Komentar** – Status komentar (active/inactive) untuk mengontrol visibilitas di frontend  


### Manajemen Konten

- ✅ **CRUD Posts** – Manajemen penuh terhadap karya: create, read, update, delete, termasuk opsi *featured post*  
- ✅ **CRUD Categories** – Manajemen kategori dengan judul, slug, deskripsi, dan gambar ilustrasi  
- ✅ **CRUD Tags** – Sistem tagging fleksibel untuk pengelompokan lintas tema/topik  
- ✅ **CRUD Comments** – Pengelolaan komentar dengan dukungan *soft delete* dan *restore*  
- ✅ **CRUD Users (Admin Only)** – Admin dapat menambah, mengubah, dan menonaktifkan akun pengguna  


### Dashboard & Analytics

- ✅ **Dashboard Admin** – Statistik lengkap: total posts, comments, users, categories
- ✅ **Dashboard Author** – Ringkasan karya dan komentar pribadi

- ✅ **Real-time Statistics** – Tracking views dan interaksi real-time

### Fitur Modern
- ✅ **Responsive Design** – *Mobile-first* design yang nyaman diakses dari berbagai perangkat 
- ✅ **Two Mode** - Memiliki tema gelap dan terang dengan switching dinamis
- ✅ **Clean UI/UX** – Antarmuka sederhana dan intuitif baik di sisi publik maupun admin  
- ✅ **Search & Filter** – Pencarian karya berdasarkan judul, kategori, dan tag  
- ✅ **SEO Friendly** – Menggunakan slug pada URL untuk mendukung SEO  
- ✅ **Profile Management** – Pengguna dapat mengatur profil dan menambahkan tautan media sosial  
- ✅ **Password Security** – Fitur ganti password dengan validasi yang aman 

## Tech Stack

### Backend

- **Laravel 12.35.1** - PHP Framework modern dengan fitur terbaru
- **Laravel Sanctum 4.2.0** - API authentication
- **Laravel Tinker 2.10.1** - REPL untuk debugging
- **PostgreSQL** - Database (via Supabase)
- **Spatie Laravel Permission (planned)** - Role dan permission management

### Frontend

- **Tailwind CSS 4.0.0** - Utility-first CSS framework
- **Vite 7.0.7** - Modern build tool dan dev server
- **Alpine.js** - Lightweight JavaScript framework
- **Axios 1.11** - HTTP client untuk AJAX requests

### Development Tools

- **Composer 2.0** - PHP dependency manager
- **NPM** - Node package manager
- **Laravel Pint 1.24** - PHP code style fixer
- **Laravel Sail 1.41** - Docker development environment
- **PHP Unit 11.5** - Testing framework
- **Faker PHP 1.24** - Fake data generator untuk testing

### Libraries & Packages

- **Guzzle HTTP 7.10** - HTTP client
- **Monolog 3.9** - Logging library
- **Carbon 3.10** - Date and time library
- **Symfony Components** - Various Symfony packages
- **League Flysystem 3.30** - Filesystem abstraction
- **Laravel Pail 1.2** - Log viewer

## Persyaratan Sistem

- PHP >= 8.2
- PostgreSQL >= 12 atau MySQL >= 8.0
- Composer
- Node.js >= 18.0 & NPM
- Web Server (Apache/Nginx)
- Extension PHP yang dibutuhkan:
  - pdo_pgsql / pdo_mysql
  - mbstring
  - openssl
  - xml
  - ctype
  - json
  - bcmath
  - fileinfo
  - hash
  - session

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/karyasi.git
cd karyasi
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=pgsql
DB_HOST=aws-1-ap-southeast-2.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres.jnfqlslqqfgcpxwdyirr
DB_PASSWORD="KaryaSI_app"
PGSQL_ATTR_SSLMODE=require
```

### 5. Migrasi Database

```bash
# Jalankan migrasi dan seeder
php artisan migrate --seed

# Atau jika ingin fresh install
php artisan migrate:fresh --seed
```

### 6. Setup Storage

```bash
# Create symbolic link untuk storage
php artisan storage:link
```

### 7. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Konfigurasi

### Application Configuration

Edit konfigurasi aplikasi di file `.env`:

```env
APP_NAME=KaryaSI
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US
```

### Session Configuration

```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

### Cache Configuration

```env
CACHE_STORE=file
CACHE_DRIVER=file
```

### Mail Configuration (Optional)

Edit konfigurasi email di file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@karyasi.itk.ac.id
MAIL_FROM_NAME="KaryaSI"
```

## Role & Permissions

Sistem menggunakan 3 role utama dengan permission berbeda:
| Role | Deskripsi |
| ---------- | ------------------------------------------------------------------- |
| **Admin** | Pengelola sistem dengan akses penuh |
| **Author** | Mahasiswa & Pengunjung yang dapat mengelola karya dengan verifikasi hasil dari admin |

## Fitur Berdasarkan Role

### Admin

#### Dashboard

- 📊 Melihat statistik: total posts, comments, users, categories

- 📈 Akses cepat ke modul manajemen melalui click-through

- 📋 Monitoring aktivitas sistem secara umum

#### Manajemen Posts

- ✅ View semua posts dari semua users
- ✅ Create post baru dengan featured option
- ✅ Edit semua posts (termasuk milik user lain)
- ✅ Delete posts (soft delete)
- ✅ Restore posts dari trash
- ✅ menglakukan approve posts dari Visitor
- ✅ Mengubah status posts (draft/published)
- ✅ Manage featured posts
- ✅ Enable/disable comments per post

#### Manajemen Comments

- ✅ View semua comments dari semua posts
- ✅ Delete comments yang tidak sesuai
- ✅ Restore comments dari trash
- ✅ Moderasi diskusi untuk menjaga etika akademik

#### Manajemen Categories

- ✅ Create kategori baru dengan gambar dan deskripsi
- ✅ Edit kategori (title, slug, description, image)
- ✅ Delete kategori (soft delete)
- ✅ Restore kategori dari trash
- ✅ Set status kategori (active/inactive)
- ✅ View total posts per kategori

#### Manajemen Tags

- ✅ Create tag baru
- ✅ Edit tag (name)
- ✅ Delete tag (soft delete)
- ✅ Restore tag dari trash
- ✅ View total posts per tag

#### Activity Logs
- ✅ Melihat semua aktivitas yang dilakukan seluruh role

#### Manajemen Tags
- ✅ Create tag baru
- ✅ Delete tag (soft delete)
- ✅ View total posts per tag

#### Manajemen Users
- ✅ Menambah user baru dengan role tertentu
- ✅ Mengedit data user (name, username, email, role, status)
-✅ Menonaktifkan / menghapus akun user

- ✅ View user statistics (post count, role, status)
- ✅ Manage user profiles dan permissions

#### Settings
- 🔧 Update profile (photo, name, username, about)
- 🔗 Manage social media links (Facebook, Twitter, Instagram, LinkedIn, YouTube)
- 🔒 Mengganti password dengan verifikasi



### Author

#### Dashboard

- 📊 Lihat ringkasan Posts dan Comments
- 📈 View statistik karya per kategori

#### Manajemen Posts

- ✅ View posts yang dipublikasikan
- ✅ Create post baru (masuk ke draft, butuh approval admin)
- ✅ Edit posts pribadi yang masih draft
- ✅ Delete posts pribadi (soft delete)
- ✅ Restore posts dari trash
- ⏳ Posts harus diverifikasi admin sebelum published

#### Manajemen Comments

- ✅ View comments pada posts
- ✅ Create comments pada posts yang dipublikasikan
- ✅ View comments pribadi
- ✅ Delete comments pribadi
- ✅ Restore comments dari trash

#### Categories & Tags

- 👁️ View only
- 📋 Dapat memilih kategori saat membuat post
- 🏷️ Dapat menambahkan tags saat membuat post

#### Settings

- 🔧 Update profile (photo, name, username, about)
- 🔗 Manage social media links
- 🔒 Change password

## Screenshot

### 1. Halaman Login

Halaman login dengan form email dan password untuk masuk ke sistem KaryaSI
#### Login Desktop Light Mode
![Login Desktop Light Mode](screenshoots/loginp.png)

#### Login Desktop dark Mode
![Login Desktop](screenshoots/loginh.png)

### 2. Dashboard Admin

Dashboard admin dengan statistik lengkap: total posts, comments, users, categories, dan massage untuk dapat melakukan akses cepat ke pengelolaan data
![dokumentasi](screenshoots/dashboardadmin.png)

### 3. Posts (Admin)
#### 3.1 All Posts (Admin)

Halaman manajemen semua posts dengan informasi lengkap: title, author, category, tags, status, featured, comment status, views, dan comment count
![dokumentasi](screenshoots/allpostsadmin.png)

#### 3.2 Create New Post
Form pembuatan post baru dengan rich text editor, upload thumbnail, pilihan kategori, tags, dan pengaturan publikasi
![dokumentasi](screenshoots/newpostsadmin.png)
##### Status saat melakukan create posts
![dokumentasi](screenshoots/statusposts.png)

#### 3.3 Trashed Posts
Halaman posts yang telah dihapus dengan opsi restore atau delete permanent
![dokumentasi](screenshoots/trashpostsadmin.png)

##### Notifikasi setelah delete posts yang bersifat permanen
![dokumentasi](screenshoots/statusdeletedpostsfix.png)

### 4. Comments
#### 4.1 All Comments

Daftar semua komentar dengan informasi commenter, tags terkait, isi komentar, tanggal submit, dan status
![dokumentasi](screenshoots/commentsadmin.png)

#### 4.1 Trashed Comments
###### 4.1.1 Notifikasi soft delete comments
![dokumentasi](screenshoots/verifikasideleteposts.png)
##### 4.1.2 Trashed Comments
![dokumentasi](screenshoots/trashedcommentsadmin.png)

### 5. Categories
#### 5.1 All Categories
Manajemen kategori dengan gambar representatif, jumlah posts, status, dan aksi CRUD
![dokumentasi](screenshoots/allcategoryadmin.png)

#### 5.2 New Categories
Melakukan penambahan category dengan mengisi data seperti title, slug, deskripsi, image, dan status. 
![dokumentasi](screenshoots/newcategory.png)

#### 5.3 Trashed Categories
Terdapat tabel yang mempresentasekan daftar category yang dihapus, namun bisa di restore category ataupun delete permanent
![dokumentasi](screenshoots/trashedcategory.png)
Notifikasi sukses saat category pada soft delete dilakukan restore
![dokumentasi](screenshoots/restorecategory.png)

### 6. Tags
Daftar semua tags dengan total posts terkait dan opsi manajemen dengan melakukan view untuk melihat daftar posts yang terdaftar dan delete untuk menghapus tags
![dokumentasi](screenshoots/tags.png)


### 7. Users (Admin Only)
#### 7.1 All Users 
Manajemen users dengan informasi name, profile, email, role, post count, status, dan aksi CRUD
![dokumentasi](screenshoots/alluser.png)

#### 7.2 New Users 
Melakukan penambahan user dengan mengisi data name, username, email, password, about, profile, role, dan satus
![dokumentasi](screenshoots/newuser.png)


### 8. Message
Halaman berisikan pesan masuk
![dokumentasi](screenshoots/massage.png)

### 9. Activity Log
Tabel berisikan histories aktivitas yang dilakukan pengguna
![dokumentasi](screenshoots/activitylog.png)

### 10. Setting

#### 10.1 Setting Profile
![dokumentasi](screenshoots/settingprofile.png)

#### 10.1 Setting Password
Form change password dengan verifikasi current password
![dokumentasi](screenshoots/changepw.png)

### 11. Blog Showcase

Halaman publik showcase karya dengan filter kategori dan tags, card posts dengan thumbnail, title, excerpt, author info, dan view count
#### 11.1 Blog Showcase (Dark Mode)
![dokumentasi](screenshoots/blog1.png)
![dokumentasi](screenshoots/blog2.png)
![dokumentasi](screenshoots/blog3.png)
![dokumentasi](screenshoots/blog4.png)

#### 11.2 Blog Showcase (Light Mode)
![dokumentasi](screenshoots/blog5.png)
![dokumentasi](screenshoots/blog6.png)
![dokumentasi](screenshoots/blog7.png)
![dokumentasi](screenshoots/blog8.png)

## Struktur Database

### Entity Relationship Diagram

![dokumentasi](screenshoots/erd.png)

### Tabel Database

#### 1. users

Tabel untuk menyimpan data semua pengguna aplikasi.

| Field      | Type         | Keterangan                              |
| ---------- | ------------ | --------------------------------------- |
| id         | BIGINT (PK)  | Primary key, auto increment             |
| name       | VARCHAR(100) | Nama lengkap pengguna                   |
| email      | VARCHAR(100) | Email unik untuk login                  |
| username   | VARCHAR(20)  | Username unik untuk identifikasi publik |
| password   | VARCHAR(255) | Password terenkripsi                    |
| role       | ENUM         | Peran: admin, author, visitor           |
| status     | ENUM         | Status akun: active, inactive           |
| created_at | TIMESTAMP    | Waktu pembuatan akun                    |
| updated_at | TIMESTAMP    | Waktu update akun                       |

#### 2. posts

Tabel untuk menyimpan semua karya mahasiswa.

| Field          | Type         | Keterangan                          |
| -------------- | ------------ | ----------------------------------- |
| id             | BIGINT (PK)  | Primary key, auto increment         |
| user_id        | BIGINT (FK)  | Foreign key ke users                |
| category_id    | BIGINT (FK)  | Foreign key ke categories           |
| title          | VARCHAR(255) | Judul karya                         |
| slug           | VARCHAR(255) | URL-friendly identifier             |
| content        | TEXT         | Konten karya (rich text)            |
| thumbnail      | VARCHAR(255) | Path gambar thumbnail               |
| status         | ENUM         | Status: draft, published            |
| views          | INTEGER      | Jumlah tampilan karya               |
| featured       | BOOLEAN      | Apakah ditampilkan sebagai featured |
| enable_comment | BOOLEAN      | Apakah komentar diaktifkan          |
| deleted_at     | TIMESTAMP    | Soft delete timestamp               |
| created_at     | TIMESTAMP    | Waktu pembuatan                     |
| updated_at     | TIMESTAMP    | Waktu update                        |

#### 3. categories

Tabel untuk menyimpan kategori karya.

| Field       | Type         | Keterangan                  |
| ----------- | ------------ | --------------------------- |
| id          | BIGINT (PK)  | Primary key, auto increment |
| title       | VARCHAR(100) | Nama kategori               |
| slug        | VARCHAR(100) | URL-friendly identifier     |
| description | TEXT         | Deskripsi kategori          |
| image       | VARCHAR(255) | Path gambar ilustrasi       |
| status      | ENUM         | Status: active, inactive    |
| deleted_at  | TIMESTAMP    | Soft delete timestamp       |
| created_at  | TIMESTAMP    | Waktu pembuatan             |
| updated_at  | TIMESTAMP    | Waktu update                |

#### 4. tags

Tabel untuk menyimpan tags/label karya.

| Field      | Type        | Keterangan                  |
| ---------- | ----------- | --------------------------- |
| id         | BIGINT (PK) | Primary key, auto increment |
| name       | VARCHAR(50) | Nama tag                    |
| deleted_at | TIMESTAMP   | Soft delete timestamp       |
| created_at | TIMESTAMP   | Waktu pembuatan             |
| updated_at | TIMESTAMP   | Waktu update                |

#### 5. post_tag (Pivot Table)

Tabel penghubung untuk relasi many-to-many antara posts dan tags.

| Field      | Type        | Keterangan                  |
| ---------- | ----------- | --------------------------- |
| id         | BIGINT (PK) | Primary key, auto increment |
| post_id    | BIGINT (FK) | Foreign key ke posts        |
| tag_id     | BIGINT (FK) | Foreign key ke tags         |
| created_at | TIMESTAMP   | Waktu pembuatan relasi      |
| updated_at | TIMESTAMP   | Waktu update relasi         |

#### 6. comments

Tabel untuk menyimpan komentar pada karya.

| Field      | Type         | Keterangan                  |
| ---------- | ------------ | --------------------------- |
| id         | BIGINT (PK)  | Primary key, auto increment |
| post_id    | BIGINT (FK)  | Foreign key ke posts        |
| user_id    | BIGINT (FK)  | Foreign key ke users        |
| name       | VARCHAR(255) | Nama komentator             |
| email      | VARCHAR(255) | Email komentator            |
| comment    | TEXT         | Isi komentar                |
| status     | ENUM         | Status: active, inactive    |
| deleted_at | TIMESTAMP    | Soft delete timestamp       |
| created_at | TIMESTAMP    | Waktu pembuatan komentar    |
| updated_at | TIMESTAMP    | Waktu update komentar       |

### Relasi Database

| Relasi             | Jenis        | Deskripsi                                       |
| ------------------ | ------------ | ----------------------------------------------- |
| users → posts      | One-to-Many  | Satu user dapat membuat banyak posts            |
| categories → posts | One-to-Many  | Satu kategori dapat berisi banyak posts         |
| posts → comments   | One-to-Many  | Satu post dapat memiliki banyak comments        |
| users → comments   | One-to-Many  | Satu user dapat membuat banyak comments         |
| posts ↔ tags       | Many-to-Many | Posts dan tags memiliki relasi banyak ke banyak |

## Penggunaan

### Login Pertama Kali

Setelah instalasi dan seeding database, Anda dapat login dengan akun default:
**Admin:**

- Email: (lihat di `database/seeders/DatabaseSeeder.php`)
- Password: (lihat di seeder)

**Author:**

- Email: (lihat di seeder)
- Password: (lihat di seeder)

### Workflow Umum

![dokumentasi](screenshoots/workfloww.png)

#### Alur Author

1. **Login** ke sistem sebagai Author
2. **View Dashboard** dengan statistik pribadi
3. **Create post** baru dengan opsi:
   - Save as **draft** untuk dikerjakan nanti
   - **Publish** langsung tanpa approval
4. **Manage posts** pribadi:
   - Edit konten
   - Update thumbnail
   - Ubah kategori/tags
   - Set sebagai featured
   - Enable/disable comments
5. **Moderate comments** pada posts pribadi
6. **Interact** dengan karya lain via comments
7. **Updateprofile** dan settings

#### Alur Admin

1. **Login** sebagai Admin
2. **Monitor statistik** di dashboard:
   - Total posts, comments, users, categories
   - Click-through untuk detail management
3. **Verify posts** dari Visitor:
   - Review konten
   - Approve → publish
   - Reject → tetap draft
4. **Manage** all content:
   - CRUD posts dari semua users
   - Moderate semua comments
   - Organize categories dan tags
   - Manage users dan roles
5. **Maintain** quality:
   - Delete inappropriate content
   - Restore dari trash jika diperlukan
   - Set featured posts
6. **System administration**:
   - Create new users
   - Assign roles
   - Manage permissions

#### Deployment

**Requirements Production**

- PHP 8.2 atau lebih tinggi
- PostgreSQL 12+ atau MySQL 8+
- Composer
- Node.js 18+ & NPM
- Web server dengan SSL certificate
- Minimum 512MB RAM
- 2GB storage space

## Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## Credits

Laravel Framework - https://laravel.com

Tailwind CSS - https://tailwindcss.com

Supabase - https://supabase.com


Material Design Icons - https://materialdesignicons.com

## Support

Jika terdapat pertanyaan atau issues, mengenai website ini silhakan:

- Buat issue di GitHub repository
- Hubungi kami tim development

---

**Developed with ❤️ for student Sistem Informasi Institut Teknologi Kalimantan**

_Last updated: December 2025_

```

```
