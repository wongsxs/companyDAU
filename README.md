# Website Company Profile & Katalog Alat Kebersihan (Sapu & Pel Lantai)
### PT Bersih Prima Nusantara (PrimaClean Nusantara)

Sistem website profil perusahaan manufaktur dan katalog interaktif alat kebersihan (spesialis aneka sapu dan pel lantai) yang dilengkapi fitur pemesanan WhatsApp otomatis, formulir penawaran B2B, Panel Admin (CRUD), dan dukungan **Cloudflare D1 Database**.

---

## 🌟 Fitur Utama
1. **Front-End Interaktif**:
   - Beranda (`index.php`), Profil Pabrik (`tentang.php`), Katalog Lengkap (`katalog.php`), Kemitraan (`kerjasama.php`), dan Kontak (`kontak.php`).
   - Kalkulator Order WhatsApp otomatis di halaman detail produk.
   - Filter pencarian, kategori, dan pengurutan harga grosir.
2. **Back-End Admin Panel (`/admin`)**:
   - Login: `admin` / `admin123`.
   - Dashboard statistik metrik.
   - CRUD Produk: Tambah, edit, hapus produk sapu & pel.
   - Pesan Masuk B2B dengan tombol 1-klik balas WhatsApp.
   - **Dashboard Integrasi Cloudflare D1 (`admin/cloudflare.php`)**: Uji koneksi dan migrasi otomatis.
3. **Pilihan 3 Mesin Database**:
   - **SQLite** (Default - Zero setup di lokal)
   - **MySQL** (XAMPP / cPanel phpMyAdmin)
   - **Cloudflare D1** (Serverless SQL Global Cloud)

---

## 🚀 Cara Menjalankan
Klik 2x file `start-server.bat` atau jalankan:
```bash
php -S localhost:8000
```
Buka browser di: `http://localhost:8000`