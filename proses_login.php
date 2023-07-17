<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Memulai session
    // Lakukan operasi pengecekan login di database
    require_once 'connect.php';
    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    // Buat query untuk mengecek apakah terdapat user dengan email X dan password Y, jika ya maka login berhasil
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM tb_user WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // Login berhasil, simpan data pengguna ke dalam session
        $user = $result->fetch_assoc();
        // ISI_DISINI
        session_start(); // Memulai session
        // Ubah X, Y, Z dengan session agar menyimpan datayang tadi berhasil login kedalam session
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['no_hp'] = $user['no_hp'];
        $_SESSION['role'] = $user['role'];

        // Login berhasil, redirect ke halaman utama
        header("Location: index.php");
        exit();


    } else {

        session_start(); // Memulai session
        header("Location: login.php");
        $_SESSION['error'] = "Email atau password salah";
        exit();
    }
    // Tutup koneksi database
    $conn->close();
}