# 🏥 Sistem Antrian Klinik Berbasis Web

Sistem ini adalah aplikasi berbasis web untuk manajemen antrian poliklinik yang dirancang untuk memudahkan proses pendaftaran pasien dan pemantauan antrian oleh petugas. Proyek ini dibangun menggunakan pendekatan prosedural dengan antarmuka yang modern dan responsif.

## ✨ Fitur Utama
- **Sistem Multi-Role:** Akses dibedakan antara **Pasien (User)** dan **Petugas (Admin)**.
- **Autentikasi Aman:** Dilengkapi dengan fitur registrasi dan login menggunakan enkripsi password (`password_hash`).
- **Dashboard Pasien:** Pasien dapat mengambil nomor antrian secara *real-time* sesuai poliklinik yang dituju.
- **Dashboard Admin:** Petugas dapat memonitor jumlah antrian, melihat status pasien, dan mengelola jadwal dokter.
- **UI/UX Modern:** Tampilan *user-friendly* dengan animasi transisi menggunakan Bootstrap 5.

## 🛠️ Teknologi yang Digunakan
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5.3.2
- **Backend:** PHP Native
- **Database:** MySQL
- **Environment:** XAMPP / Laragon

---

## 🚀 Panduan Instalasi Lengkap

### Tahap 1: Persiapan File Proyek
1. Unduh proyek ini dengan mengklik tombol hijau **`<> Code`** lalu pilih **`Download ZIP`**.
2. Ekstrak file ZIP yang baru saja diunduh.
3. Ubah nama folder hasil ekstrak menjadi **`klinik_ilham`** (agar lebih mudah diakses).
4. Pindahkan folder tersebut ke dalam direktori *local server* Anda:
   - Pengguna **XAMPP**: Pindahkan ke `C:\xampp\htdocs\`
   - Pengguna **Laragon**: Pindahkan ke `C:\laragon\www\`

### Tahap 2: Menjalankan Server
1. Buka aplikasi **XAMPP Control Panel**.
2. Klik tombol **Start** pada modul **Apache** dan **MySQL** hingga indikator berwarna hijau.

---

## 🗄️ Tahap 3: Konfigurasi & Memasukkan Database (PENTING)

Agar aplikasi dapat berjalan dan menyimpan data, Anda wajib membuat database MySQL. Berikut adalah panduannya:

1. Buka web browser (Chrome/Edge) dan akses alamat: `http://localhost/phpmyadmin`
2. Di panel sebelah kiri, klik tulisan **New** (Baru).
3. Pada kolom *Database name* (Nama basis data), ketik persis: **`sistem_klinik`**
4. Klik tombol **Create** (Buat).

Setelah database terbuat, **Pilih salah satu dari 2 cara di bawah ini** untuk memasukkan struktur tabelnya:

**CARA A: Menggunakan Fitur Import (Sangat Disarankan)**
1. Pastikan Anda sudah mengklik/masuk ke dalam database `sistem_klinik` di phpMyAdmin.
2. Klik tab **Import** di deretan menu bagian atas.
3. Klik tombol **Choose File** (Pilih File).
4. Cari dan pilih file bernama **`sistem_klinik.sql`** yang ada di dalam folder proyek `klinik_ilham` yang Anda unduh tadi.
5. Gulir ke bagian paling bawah, lalu klik tombol **Import** (Kirim). Tunggu hingga muncul kotak hijau tanda sukses.

**CARA B: Menggunakan Copy-Paste SQL (Alternatif)**
1. Pastikan Anda sudah berada di dalam database `sistem_klinik`.
2. Klik tab **SQL** di deretan menu bagian atas.
3. *Copy* kode di bawah ini, dan *paste* ke dalam kotak putih yang tersedia:
   ```sql
   CREATE TABLE IF NOT EXISTS users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL,
       email VARCHAR(100) NOT NULL,
       password VARCHAR(255) NOT NULL,
       role ENUM('admin', 'user') DEFAULT 'user'
   );
