Panduan Lengkap Instalasi & Integrasi Database: Sistem Antrian Klinik
Deskripsi Singkat:
Sistem ini adalah aplikasi berbasis web untuk manajemen antrian klinik, dilengkapi dengan fitur multi-role (Admin dan Pasien/User). Proyek ini dibangun menggunakan PHP Native, MySQL, dan Bootstrap 5.

🛠️ Persyaratan Sistem (Prerequisites)
Sebelum menjalankan aplikasi ini, pastikan komputer Anda sudah terinstal:

Web Server lokal seperti XAMPP, Laragon, atau WAMP.

Web Browser (Google Chrome, Mozilla Firefox, dll).

🚀 Langkah-Langkah Instalasi
Tahap 1: Menyiapkan File Project

Silakan unduh proyek ini dari GitHub dengan cara klik tombol hijau <> Code lalu pilih Download ZIP.

Ekstrak file ZIP yang sudah diunduh.

Ubah nama folder hasil ekstrak menjadi lebih singkat (misalnya: klinik_ilham).

Pindahkan folder tersebut ke dalam direktori server lokal Anda:

Pengguna XAMPP: Pindahkan ke folder C:\xampp\htdocs\

Pengguna Laragon: Pindahkan ke folder C:\laragon\www\

Tahap 2: Konfigurasi Database MySQL
Agar aplikasi dapat menyimpan data registrasi dan login, kita perlu menghubungkannya ke database.

Buka aplikasi XAMPP Control Panel (atau Laragon).

Klik tombol Start pada modul Apache dan MySQL.

Buka web browser dan akses alamat: http://localhost/phpmyadmin

Buat database baru:

Klik menu New (Baru) di panel sebelah kiri.

Pada kolom nama database, ketikkan persis: sistem_klinik

Klik tombol Create (Buat).

Import struktur tabel:

Pastikan Anda sedang berada di dalam database sistem_klinik.

Klik tab Import di deretan menu atas.

Klik tombol Choose File (Pilih File) lalu cari dan pilih file bernama sistem_klinik.sql yang berada di dalam folder project yang Anda unduh tadi.

Gulir ke bawah dan klik tombol Import (Kirim) di pojok kanan bawah. Tunggu hingga muncul notifikasi sukses berwarna hijau.

Tahap 3: Pengecekan Koneksi (Opsional / Jika Ada Eror)
Secara default, file koneksi.php sudah disetting untuk MySQL standar (Port 3306).
Jika MySQL di laptop Anda menggunakan port berbeda (misalnya 3307), Anda harus membuka file koneksi.php dan menyesuaikan baris kodenya menjadi:

PHP
$host = "127.0.0.1"; 
$user = "root";
$pass = "";
$db   = "sistem_klinik";
$port = 3307; // Sesuaikan dengan port MySQL Anda

$conn = mysqli_connect($host, $user, $pass, $db, $port);
Tahap 4: Menjalankan Aplikasi

Buka tab baru di web browser Anda.

Ketikkan alamat berikut di address bar:
http://localhost/klinik_ilham/login.php
(Catatan: Ganti tulisan klinik_ilham dengan nama folder yang Anda buat pada Tahap 1).

Mulai Testing! * Silakan masuk ke halaman Registrasi terlebih dahulu.

Coba buat akun baru dan pilih Role sebagai Pasien (User), lalu coba login.

Logout, lalu buat akun baru lagi dan pilih Role sebagai Petugas (Admin), lalu coba login. Sistem akan otomatis memisahkan halaman dashboard sesuai peran masing-masing.
