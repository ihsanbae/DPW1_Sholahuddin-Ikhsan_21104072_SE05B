<?php

session_start();


if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.c
ss">
</head>

<body>
    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Riwayat
                                Pembelian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Role</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h2>Riwayat Pembelian</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pemilik</th>
                                <th>Pembeli</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                        
                        include '../connect.php';

                        $query_trx = "SELECT * FROM tb_transaksi";
                        $result = $conn->query($query_trx);

                        foreach ($result as $daftar_tuku) {
                            ?>

                            <?php

                            $query_seng_tuku = "SELECT * FROM tb_user WHERE id = ".$daftar_tuku['id_user'];
                            $result_seng_tuku = $conn->query($query_seng_tuku);
                            $row_seng_tuku =  $result_seng_tuku->fetch_assoc();
                            


                            $query_seng_adol = "SELECT * FROM tb_user WHERE id = ".$daftar_tuku['id_penjual'];
                            $result_seng_adol = $conn->query($query_seng_adol);
                            $row_seng_adol =  $result_seng_adol->fetch_assoc();


                            $query_tuku_opo = "SELECT * FROM tb_produk WHERE id = ".$daftar_tuku['id_produk'];
                            $result_tuku_opo = $conn->query($query_tuku_opo);
                            $row_tuku_opo =  $result_tuku_opo->fetch_assoc();

                            ?>

                            <tr>

                                <td><?php echo $row_seng_adol['nama_lengkap']; ?></td>
                                <td><?php echo $row_seng_tuku['nama_lengkap']; ?></td>
                                <td><?php echo $row_tuku_opo['nama_produk']; ?></td>
                                <td><?php echo $row_tuku_opo['harga']; ?></td>
                                <td><?php echo $daftar_tuku['jumlah']; ?></td>
                                <td><?php echo $daftar_tuku['tanggal']; ?></td>
                                <td><?php echo $daftar_tuku['total_harga']; ?></td>
                            </tr>

                            <?php
}
                        ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>