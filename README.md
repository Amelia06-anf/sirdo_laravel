# SIRDO Pusakaratu - Laravel

Versi Laravel dari Sistem Registrasi Dokumen Keluar BRI Unit Pusakaratu.

## Cara menjalankan

1. Install Composer di Windows.
2. Extract project ini ke folder, misalnya:
   `C:\xampp\htdocs\sirdo_pusaka_laravel`
3. Buka terminal di folder project.
4. Jalankan:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

5. Buka:
   `http://127.0.0.1:8000/login`

Login awal:

- Username: `admin`
- Password: `admin123`

Jika ingin memakai database lama, set `.env`:

```env
DB_DATABASE=db_sirdo
DB_USERNAME=root
DB_PASSWORD=
```

Kalau tabel lama sudah ada, tidak perlu `php artisan migrate --seed`.

## Fitur

- Login petugas
- Dashboard
- Registrasi dokumen masuk
- Registrasi dokumen keluar
- Data dokumen
- Laporan riwayat dokumen
- Export Excel
- Export PDF via halaman cetak browser
