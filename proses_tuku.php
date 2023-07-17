<?php

session_start();

include 'connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk = $_POST['id_produk'];
    $jumlah_tuku = $_POST['quantity'];

    $jupuk_stock_awal = "SELECT tb_produk.stok, tb_produk.harga, tb_produk.id_user FROM tb_produk WHERE tb_produk.id = $id_produk";
    $result = $conn->query($jupuk_stock_awal);
    $row = $result->fetch_assoc();
    $stock_awal = $row['stok'];
    $regane = $row['harga'];
    $seng_due_toko = $row['id_user'];

    $stock_saiki = $stock_awal - $jumlah_tuku;

    $query = "UPDATE `tb_produk` SET `stok` = '$stock_saiki' WHERE `tb_produk`.`id` = $id_produk";
    if ($conn->query($query) === true) {

        $id_user = $_SESSION['id'];

        $total_regane = $regane * $jumlah_tuku;

        
        $query = "INSERT INTO `tb_transaksi` (`id`, `id_user`, `id_penjual`, `jumlah`, `total_harga`, `tanggal`, `id_produk`) VALUES (NULL, '$id_user', '$seng_due_toko', '$jumlah_tuku', '$total_regane', CURRENT_TIMESTAMP, '$id_produk')";
        if ($conn->query($query) === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }

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