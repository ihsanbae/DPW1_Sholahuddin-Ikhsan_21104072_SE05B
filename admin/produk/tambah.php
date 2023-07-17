<?php

session_start();

include '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_user = $_SESSION['id'];

    $query = "INSERT INTO `tb_produk` (`id`, `nama_produk`, `stok`, `harga`, `id_user`) VALUES (NULL, '$nama_produk', '$stok', '$harga', '$id_user')";
    if ($conn->query($query) === true) {
        header("Location: ../produk.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
// Tutup koneksi database
    $conn->close();
} else {
    return [
        'error' => 'Method not allowed'
    ];
}