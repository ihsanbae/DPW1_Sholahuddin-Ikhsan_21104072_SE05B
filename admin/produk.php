<?php
session_start();

include '../connect.php';

if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'penjual') {
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Produk</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                        Tambah Data
                    </button>
                    <!-- Modal tambah data -->
                    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog"
                        aria-labelledby="tambahDataModalLabel" ariahidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pengguna</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="produk/tambah.php" method="POST">
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="id" value="<?=$row['id']?>"
                                            name="id" hidden>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input required type="text" class="form-control" id="nama_produk"
                                                name="nama_produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input required type="number" class="form-control" id="harga" name="harga">
                                        </div>
                                        <div class="form-group">
                                            <label for="number">Stok</label>
                                            <input required type="number" class="form-control" id="stok" name="stok">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btnsecondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btnprimary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Email Pengguna</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

$query = "SELECT `tb_produk`.`id`, `tb_user`.`email`, `tb_produk`.`stok`, `tb_produk`.`harga`, `tb_produk`.`nama_produk`
                            FROM `tb_user`
                            LEFT JOIN `tb_produk` ON `tb_user`.`id` = `tb_produk`.`id_user`";
$data = $conn->query($query);

foreach ($data as $row) {
    ?>
                            <tr>
                                <td><?=$row['email']?></td>
                                <td><?=$row['nama_produk']?></td>
                                <td><?=$row['harga']?></td>
                                <td><?=$row['stok']?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btnsm" data-toggle="modal"
                                        data-target="#editDataModal<?=$row['id']?>">Edit</button>
                                    <button type="button" class="btn btn-danger btnsm" data-toggle="modal"
                                        data-target="#hapusDataModal<?=$row['id']?>">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal ubah data -->
                            <div class="modal fade" id="editDataModal<?=$row['id']?>" tabindex="-1" role="dialog"
                                aria-labelledby="editDataModalLabel" ariahidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel">Edit Data Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="produk/edit.php" method="POST">
                                            <div class="modal-body">
                                                <input type="text" class="form-control" id="id" value="<?=$row['id']?>"
                                                    name="id" hidden>
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input required type="text" class="form-control" id="nama_produk"
                                                        value="<?=$row['nama_produk']?>" name="nama_produk">
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input required type="number" class="form-control" id="harga"
                                                        value="<?=$row['harga']?>" name="harga">
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Stok</label>
                                                    <input required type="number" class="form-control" id="stok"
                                                        value="<?=$row['stok']?>" name="stok">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btnsecondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btnprimary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus Data -->
                            <div class="modal fade" id="hapusDataModal<?=$row['id']?>" tabindex="-1" role="dialog"
                                aria-labelledby="hapusDataModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusDataModalLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data pengguna ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                datadismiss="modal">Batal</button>
                                            <a href="produk/hapus.php?id=<?=$row['id']?>"
                                                class="btn btn-danger">Hapus</a>

                                        </div>
                                    </div>
                                </div>
                            </div>



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