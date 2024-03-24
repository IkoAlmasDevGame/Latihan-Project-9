<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Kelas</title>
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
                        <h4 class="panel-title fst-normal fw-lighter pt-3 pt-lg-3">Kelas Pelajar</h4>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=kelas&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Kelas Pelajar</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="fw-lighter fst-normal text-center">No</th>
                                    <th class="fw-lighter fst-normal text-center">Nama Kelas</th>
                                    <th class="fw-lighter fst-normal text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $hasil = $viewKelas->read();
                                    $no = 1;
                                    foreach ($hasil as $isi) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center"><?php echo $isi['namakelas']; ?></td>
                                    <td class="text-center">
                                        <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$isi['id_kelas']?>"
                                            aria-current="page" class="btn btn-info hover">
                                            <i class="fas fa-book" title="Tambah Mata Pelajaran"></i>
                                        </a>
                                        <a href="?page=absensi&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$isi['id_kelas']?>"
                                            aria-current="page" class="btn btn-warning hover">
                                            <i class="fas fa-pen-alt" title="Absensi Siswa/i"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>