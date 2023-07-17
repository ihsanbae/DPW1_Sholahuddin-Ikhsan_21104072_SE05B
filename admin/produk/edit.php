<?php

session_start();

include '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];


    $query = "UPDATE `tb_produk` SET `nama_produk` = '$nama_produk', `harga` = '$harga', `stok` = '$stok' WHERE `tb_produk`.`id` = $id";
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


?>