📋 Website Absensi Karyawan - Laravel
Sistem absensi digital untuk karyawan dengan fitur upload foto dan panel admin.
🚀 Fitur Utama
👥 Untuk Karyawan:

✅ Registrasi dan login
✅ Absensi harian dengan upload foto
✅ Riwayat absensi pribadi
✅ Pembatasan absen (1x per hari)

👨‍💼 Untuk Admin:

✅ Dashboard dengan statistik
✅ Monitoring semua absensi karyawan
✅ Filter data berdasarkan tanggal dan karyawan
✅ Kelola data karyawan

🛠️ Requirement

PHP >= 8.1
Composer
MySQL/MariaDB
Web Server (Apache/Nginx/XAMPP)
Node.js & NPM (optional)

📦 Instalasi
1. Clone/Download Project
bash# Clone project (jika menggunakan git)
git clone <repository-url>
cd web-absensi

# Atau download ZIP dan extract
2. Install Dependencies
bash# Install PHP dependencies
composer install

# Install package tambahan
composer require intervention/image
3. Konfigurasi Environment
bash# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
4. Setup Database
Edit file .env dan sesuaikan konfigurasi database:
envDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi_karyawan
DB_USERNAME=root
DB_PASSWORD=
5. Buat Database
sql-- Login ke MySQL dan buat database
CREATE DATABASE absensi_karyawan;
6. Migrasi Database
bash# Jalankan migration
php artisan migrate

# Jalankan seeder untuk admin
php artisan db:seed --class=AdminSeeder
7. Setup Storage
bash# Buat folder untuk upload foto
mkdir -p public/uploads/absensi

# Set permission (untuk Linux/Mac)
chmod 755 public/uploads/absensi
8. Jalankan Server
bash# Development server
php artisan serve

# Server akan berjalan di: http://localhost:8000
📁 Struktur File
web-absensi/
├── app/
│   ├── Http/Controllers/
│   │   ├── AbsensiController.php
│   │   ├── AdminController.php
│   │   └── AuthController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Absensi.php
│   └── Http/Middleware/
│       └── AdminMiddleware.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   └── guest.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── absensi/
│   └── admin/
├── routes/
│   └── web.php
└── public/uploads/absensi/
🔐 Login Information
Admin:

Email: admin@admin.com
Password: password

Karyawan:

Registrasi melalui form register
Role otomatis sebagai "karyawan"

🌐 URL Akses

Homepage: http://localhost:8000
Login: http://localhost:8000/login
Register: http://localhost:8000/register
Dashboard Karyawan: http://localhost:8000/dashboard
Admin Panel: http://localhost:8000/admin/dashboard

💻 Penggunaan
Untuk Karyawan:

Registrasi akun baru atau login
Akses dashboard karyawan
Klik "Absen Sekarang" untuk absensi
Upload foto dan isi keterangan
Lihat riwayat absensi di menu

Untuk Admin:

Login dengan akun admin
Akses admin dashboard
Lihat statistik absensi
Monitor data absensi karyawan
Filter berdasarkan tanggal/karyawan

🐛 Troubleshooting
Error: "Class 'Intervention\Image\ImageManager' not found"
bashcomposer require intervention/image
Error: "Permission denied" saat upload foto
bashchmod 755 public/uploads/absensi
Error: "SQLSTATE[HY000] [2002] Connection refused"
bash# Pastikan MySQL/MariaDB running
# Periksa konfigurasi database di file .env
Error: "Route [login] not defined"
bashphp artisan route:clear
php artisan config:clear
Error: "Class 'App\Http\Controllers\AuthController' not found"
bashphp artisan make:controller AuthController
composer dump-autoload
🔧 Konfigurasi Tambahan
Setup untuk Production:
bash# Optimize aplikasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set environment
APP_ENV=production
APP_DEBUG=false
Setup Email (Optional):
envMAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
🎨 Customization
Mengubah Logo/Branding:

Edit file resources/views/layouts/app.blade.php
Ganti "Absensi Karyawan" dengan nama perusahaan

Mengubah Tema Warna:

Edit CSS di file layout atau tambahkan custom CSS

Menambah Field Absensi:

Buat migration: php artisan make:migration add_field_to_absensis_table
Edit model Absensi.php
Update form dan view

🔄 Update & Maintenance
Backup Database:
bashmysqldump -u root -p absensi_karyawan > backup.sql
Update Dependencies:
bashcomposer update
Clear Cache:
bashphp artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear