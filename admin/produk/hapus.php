<?php

session_start();

include '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $query = "DELETE FROM `tb_produk` WHERE `tb_produk`.`id` = $id";
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