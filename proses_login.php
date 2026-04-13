<?php
session_start(); // Wajib ada untuk menyimpan data login user
include 'koneksi.php';

if (isset($_POST['login'])) {
    // Ambil data dari form dan amankan
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // 1. Cari user di database berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // 2. Cek apakah usernamenya ada
    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);

        // 3. Verifikasi password (karena di database tadi di-hash)
        if (password_verify($password, $data['password'])) {
            
            // 4. Jika password benar, buat session untuk user tersebut
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            // 5. REDIRECT BERDASARKAN ROLE
            if ($data['role'] == 'admin') {
                echo "<script>alert('Login Berhasil sebagai Admin!'); window.location='dashboard_admin.php';</script>";
            } else {
                echo "<script>alert('Login Berhasil sebagai User!'); window.location='dashboard_user.php';</script>";
            }
            exit;

        } else {
            // Password salah
            echo "<script>alert('Password salah!'); window.location='login.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak terdaftar!'); window.location='login.php';</script>";
    }
} else {
    header("Location: login.php");
    exit;
}
?>