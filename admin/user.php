<?php

session_start();

include '../connect.php';
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'penjual') {
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
                    <h2>Pengguna</h2>
                    <button type="button" class="btn btn-primary" datatoggle="modal" data-target="#tambahDataModal">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            
                            $query = "SELECT `tb_user`.`role`, `tb_user`.`nama_lengkap`, `tb_user`.`no_hp`, `tb_user`.`email`, `tb_user`.`id`
                            FROM `tb_user`";
                            $result = $conn->query($query);

                            foreach ($result as $row){

                            ?>

                            <tr>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                <td><?php echo $row['no_hp']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                                        data-target="#editDataModal<?= $row['id']; ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                        data-target="#hapusDataModal<?= $row['id']; ?>">Hapus</button>
                                </td>
                            </tr>


                            <!-- Modal ubah data -->
                            <div class="modal fade" id="editDataModal<?= $row['id']; ?>" tabindex="-1" role="dialog"
                                aria-labelledby="editDataModalLabel" ariahidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDataModalLabel">Edit Data Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control" id="role">

                                                        <?php if (ucfirst($row['role']) == 'Admin') { ?>

                                                        <?php 
                                                        if (ucfirst($row['role']) == 'Admin') { ?>
                                                        <option selected>Admin</option>
                                                        <?php } elseif (ucfirst($row['role']) == 'Penjual') { ?>
                                                        <option selected>Penjual</option>
                                                        <?php } elseif (ucfirst($row['role']) == 'User') { ?>
                                                        <option selected>User</option>
                                                        <?php } ?>

                                                        <option>Penjual</option>
                                                        <option>User</option>
                                                        <option>Admin</option>
                                                        <?php } elseif (ucfirst($row['role']) == 'Penjual') { ?>
                                                        <option>Admin</option>
                                                        <option>User</option>
                                                        <?php } elseif (ucfirst($row['role']) == 'User') { ?>
                                                        <option>Admin</option>
                                                        <option>Penjual</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama
                                                        Lengkap</label>
                                                    <input required type="text" class="form-control" id="nama_lengkap"
                                                        value="<?= $row['nama_lengkap']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">No. HP</label>
                                                    <input required type="text" class="form-control" id="no_hp"
                                                        value="<?= $row['no_hp']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input required type="email" class="form-control" id="email"
                                                        value="<?= $row['email']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input required type="password" class="form-control" id="password">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btnsecondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Hapus Data -->
                            <div class="modal fade" id="hapusDataModal<?= $row['id']; ?>" tabindex="-1" role="dialog"
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
                                            <button type="button" class="btn btndanger">Hapus</button>
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
    <!-- Modal tambah data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role">
                                <option>Admin</option>
                                <option>Penjual</option>
                                <option>User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input required type="text" class="form-control" id="nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input required type="text" class="form-control" id="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input required type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" class="form-control" id="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" datadismiss="modal">Tutup</button>
                    <button type="button" class="btn btnprimary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>