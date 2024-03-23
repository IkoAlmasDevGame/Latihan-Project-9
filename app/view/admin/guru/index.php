<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Guru</title>
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
                                <a href="?page=guru&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Guru</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-start flex-wrap gap-5">
                    <?php 
                    if(isset($_GET["edit"])){
                        if($_GET["edit"]=="yes"){
                            $id = $_GET["id_guru"];
                            $hasil = $viewGuru->TeacherEditRead($id);
                            foreach ($hasil as $iHasil) {
                    ?>
                    <div class="card col-md-3 col-lg-3">
                        <div class="card-header">
                            <h4 class="fs-5 card-title fst-normal fw-lighter">
                                Daftar Guru
                            </h4>
                            <div class="card-header-form text-end">
                                <h4 class="fs-5 fas fa-user-alt"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="?act=edit-guru" method="post">
                                <input type="hidden" name="id_guru" value="<?=$iHasil["id_guru"]?>">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="fst-normal fw-lighter">Nip Guru</th>
                                        <td>
                                            <input type="number" name="nip" value="<?=$iHasil["nip"]?>" maxlength="18"
                                                class="form-control" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Nama Guru</th>
                                        <td>
                                            <input type="text" name="nama" value="<?=$iHasil["nama"]?>" maxlength="100"
                                                class="form-control" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Tanggal Lahir</th>
                                        <td>
                                            <input type="date" name="tanggal_lahir"
                                                value="<?=$iHasil["tanggal_lahir"]?>" class="form-control" required
                                                aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Jenis Kelamin</th>
                                        <td>
                                            <input type="radio" name="jeniskelamin" value="<?=$iHasil["jeniskelamin"]?>"
                                                class="mx-1" required aria-required="true">Laki-Laki
                                            <input type="radio" name="jeniskelamin" value="<?=$iHasil["jeniskelamin"]?>"
                                                class="mx-1" required aria-required="true">Perempuan
                                        </td>
                                    </tr>
                                </table>
                                <div class="modal-footer">
                                    <div class="card-footer container text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <?php
                        }
                    }else{
                    ?>
                    <div class="card col-md-3 col-lg-3">
                        <div class="card-header">
                            <h4 class="fs-5 card-title fst-normal fw-lighter">
                                Daftar Guru
                            </h4>
                            <div class="card-header-form text-end">
                                <h4 class="fs-5 fas fa-user-alt"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="?act=tambah-guru" method="post">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="fst-normal fw-lighter">Nip Guru</th>
                                        <td>
                                            <input type="text" name="nip" id="nip" maxlength="18" class="form-control"
                                                required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Nama Guru</th>
                                        <td>
                                            <input type="text" name="nama" id="nama" maxlength="100"
                                                class="form-control" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Tanggal Lahir</th>
                                        <td>
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                                class="form-control" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="fst-normal fw-lighter">Jenis Kelamin</th>
                                        <td>
                                            <input type="radio" name="jeniskelamin" id="jeniskelamin" value="Laki-Laki"
                                                class="mx-1" required aria-required="true">Laki-Laki
                                            <input type="radio" name="jeniskelamin" id="jeniskelamin" value="Perempuan"
                                                class="mx-1" required aria-required="true">Perempuan
                                        </td>
                                    </tr>
                                </table>
                                <div class="modal-footer">
                                    <div class="card-footer container text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fas fa-eraser"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="card col-md-8 col-lg-8">
                        <div class="card-header">
                            <h4 class="card-title fs-5 fst-normal fw-lighter">List Data Guru Sekolah</h4>
                            <div class="card-header-form">
                                <a href="?page=guru&nama=<?=$_SESSION["nama_pengguna"]?>" role="button"
                                    class="btn btn-info">List Data Guru</a>
                                <a href="?page=guru&nama=<?=$_SESSION["nama_pengguna"]?>&aksi=yes" role="button"
                                    class="btn btn-secondary">Edit Data Guru</a>
                            </div>
                        </div>
                        <div class="table-responsive-md table-responsive-lg">
                            <div class="card-body">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="fw-lighter col-md-1 col-lg-1">No</th>
                                            <th class="fw-lighter col-md-3 col-lg-3">NIP</th>
                                            <th class="fw-lighter">Nama Guru</th>
                                            <th class="fw-lighter">Tanggal Lahir</th>
                                            <th class="fw-lighter">Jenis Kelamin</th>
                                            <?php 
                                                if(!empty($_GET["aksi"]=="yes")){
                                            ?>
                                            <th class="fw-lighter">Aksi</th>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $hasil = $viewGuru->TeacherRead();
                                            $no = 1;
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi["nip"]; ?></td>
                                            <td><?php echo $isi["nama"] ?></td>
                                            <td><?php echo $isi["tanggal_lahir"]; ?></td>
                                            <td><?php echo $isi["jeniskelamin"]; ?></td>
                                            <?php 
                                                if(!empty($_GET["aksi"]=="yes")){
                                            ?>
                                            <td>
                                                <a href="?page=guru&nama=<?=$_SESSION["nama_pengguna"]?>&edit=yes&id_guru=<?=$isi["id_guru"]?>"
                                                    role="button" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?act=hapus-guru&id_guru=<?=$isi["id_guru"]?>" role="button"
                                                    class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                            <?php
                                                }
                                            ?>
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