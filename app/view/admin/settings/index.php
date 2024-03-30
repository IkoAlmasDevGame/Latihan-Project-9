<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Account Pribadi</title>
        <?php 
            require_once("../ui/header.php");
            $nama = htmlspecialchars($_GET["nama"]) ? htmlentities($_GET["nama"]) : $_GET["nama"];
            $table = "tb_user";
            $sql = "SELECT * FROM $table WHERE nama = ?";
            $row = $configs->prepare($sql);
            $row->execute(array($nama));
            $hasil = $row->fetchAll();
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
                                <a href="?page=account&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Edit Akun</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center flex-wrap">
                    <div class="card col-md-8 col-lg-8">
                        <div class="card-header">
                            <h4 class="card-title display-4 fst-normal fw-lighter fs-4">Edit Data Account</h4>
                        </div>
                        <div class="card-body">
                            <?php 
                                foreach ($hasil as $isi) {
                            ?>
                            <form action="?act=edit-akun" enctype="multipart/form-data" method="post">
                                <div class="row align-items-center form-group mb-2 mb-lg-0">
                                    <label for="email" class="input-group-addon">Email</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="email" name="email" value="<?=$isi["email"]?>" id="email"
                                                class="form-control" placeholder="masukkan email anda ..." required
                                                aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="username" class="input-group-addon">Username</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="text" name="username" value="<?=$isi["username"]?>"
                                                id="username" class="form-control"
                                                placeholder="masukkan username anda ..." required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="passMail" class="input-group-addon">Kata
                                        Sandi</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="password" name="password" value="<?=$isi["password"]?>"
                                                id="passMail" class="form-control"
                                                placeholder="masukkan kata sandi anda ..." required
                                                aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="nama" class="input-group-addon">Nama</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <input type="text" name="nama" value="<?=$isi["nama"]?>" id="nama"
                                                class="form-control" placeholder="masukkan nama anda ..." required
                                                aria-required="true">
                                        </div>
                                    </div>
                                    <div class="mb-2"></div>
                                    <label for="jabatan" class="input-group-addon">Jabatan</label>
                                    <div class="input-group-text form-control">
                                        <div class="input-group">
                                            <select name="user_level" id="jabatan" class="form-control" required
                                                aria-required="true">
                                                <option value="">Pilih Jabatan Anda Sekarang</option>
                                                <option <?php if($isi["user_level"] == "Admin"){?> selected=""
                                                    <?php } ?> value="<?=$isi["user_level"]?>">Admin</option>
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
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>