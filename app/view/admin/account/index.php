<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Pembuatan Akun</title>
        <?php 
            require_once("../ui/header.php");
        ?>
    </head>

    <body>
        <?php 
            require_once("../ui/navbar.php");
        ?>
        <div class="container-fluid py-5 p-5 bg-secondary rounded-1 min-vh-100">
            <div class="container-fluid bg-body-secondary rounded-1 min-vh-100">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="panel-title fst-normal fw-lighter">Dashboard Guru</h4>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=akun&email=<?=$_SESSION['email_pengguna']?>"
                                    class="text-decoration-none text-primary">Account</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around align-items-start flex-wrap gap-4">
                    <div class="card col-md-4 col-lg-4">
                        <div class="card-header">
                            <h4 class="card-title fs-5 text-start fw-lighter fst-normal">Pembuatan Account Sekolah</h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=tambah-akun" method="post">
                                <div class="row align-items-center form-group mb-2 mb-lg-0">
                                    <label for="email" class="input-group-addon">Email</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="masukkan email anda ..." required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="username" class="input-group-addon">Username</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="masukkan username anda ..." required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="passMail" class="input-group-addon">Kata
                                        Sandi</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="password" name="password" id="passMail" class="form-control"
                                                placeholder="masukkan kata sandi anda ..." required
                                                aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="nama" class="input-group-addon">Nama</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                placeholder="masukkan nama anda ..." required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="jabatan" class="input-group-addon">Jabatan</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <select name="user_level" id="jabatan" class="form-control" required
                                                aria-required="true">
                                                <option value="">Pilih Jabatan Anda Sekarang</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer container">
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary mx-1">
                                            <i class="fa fa-save"></i>
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-danger mx-1">
                                            <i class="fa fa-eraser"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card col-md-7 col-lg-7">
                        <div class="card-header">
                            <h4 class="card-title fs-5 text-start fw-lighter fst-normal">Data Account Sekolah</h4>
                        </div>
                        <div class="table-responsive-md table-responsive-lg">
                            <div class="card-body">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="fst-normal fw-lighter col-md-1 col-lg-1">No</th>
                                            <th class="fst-normal fw-lighter">Email</th>
                                            <th class="fst-normal fw-lighter">Username</th>
                                            <th class="fst-normal fw-lighter">Nama</th>
                                            <th class="fst-normal fw-lighter">Jabatan</th>
                                            <th class="fst-normal fw-lighter">Created At</th>
                                            <th class="fst-normal fw-lighter">Created End</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $hasil = $viewAuth->Read();
                                            $no = 1;
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi["email"]; ?></td>
                                            <td><?php echo $isi["username"]; ?></td>
                                            <td><?php echo $isi["nama"]; ?></td>
                                            <td><?php echo $isi["user_level"]; ?></td>
                                            <td><?php echo $isi["created_At"]; ?></td>
                                            <td><?php echo $isi["created_End"]; ?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>