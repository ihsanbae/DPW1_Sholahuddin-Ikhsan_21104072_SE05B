<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan operasi penyimpanan data ke database
    require_once 'connect.php';
    // Query untuk menyimpan data pengguna baru ke tabel pengguna
    // Buat query untuk memasukan data user yang tadi diinputkan

    $email = $_POST['email'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $role = 'admin';


    $query = "INSERT INTO `tb_user` (`id`, `nama_lengkap`, `role`, `no_hp`, `email`, `password`) VALUES (NULL, '$nama_lengkap', 'admin', '$no_hp', '$email', '$password')";
    if ($conn->query($query) === true) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
// Tutup koneksi database
    $conn->close();
}