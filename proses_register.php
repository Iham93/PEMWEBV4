<?php
// 1. Panggil file koneksi database
include 'koneksi.php';

// 2. Cek apakah tombol 'register' sudah diklik
if (isset($_POST['register'])) {
    
    // 3. Ambil data dari form dan bersihkan (untuk menghindari SQL Injection)
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);
    
    // 4. Enkripsi password (Hashing) agar aman di database
    // Jangan pernah simpan password dalam bentuk teks asli (plain text)
    $password_raw = $_POST['password'];
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

    // 5. Query SQL untuk memasukkan data ke tabel 'users'
    $query = "INSERT INTO users (username, email, password, role) 
              VALUES ('$username', '$email', '$password_hashed', '$role')";
    
    // 6. Jalankan query dan cek hasilnya
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, munculkan alert dan pindah ke halaman login
        echo "<script>
                alert('Registrasi Berhasil! Silahkan Login sebagai " . $role . ".');
                window.location='login.php';
              </script>";
    } else {
        // Jika gagal (misal username sudah ada atau database error)
        echo "<script>
                alert('Registrasi Gagal: " . mysqli_error($conn) . "');
                window.history.back();
              </script>";
    }
} else {
    // Jika mencoba akses file ini tanpa melalui form register
    header("Location: register.php");
    exit();
}
?>