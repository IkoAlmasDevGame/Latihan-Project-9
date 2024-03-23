<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Pendaftaran</title>
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
                        <div class="panel-heading pt-2 text-end">
                            <h4 class="panel-title fs-4 fst-normal fw-lighter">Lihat Data Siswa</h4>
                        </div>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=lihat-siswa&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Lihat Data Siswa</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header shadow shadow-lg bg-body-secondary">
                        <h4 class="card-title fs-5 fst-normal fw-lighter text-end">Lihat Data Siswa</h4>
                        <div class="card-header-form px-1 mx-1">
                            <a href="?page=pendaftaran&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                class="btn btn-warning">
                                <i class="fas fa-user-alt"></i>
                                <span>Pendaftaran Siswa Baru</span>
                            </a>
                        </div>
                        <div class="mb-1"></div>
                        <div class="border border-top border-dark"></div>
                        <div class="table-responsive-md table-responsive-lg">
                            <div class="card-body" style="overflow-x: auto;">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="fw-normal fst-normal" style="min-width:5%; width:5%;">No</th>
                                            <th class="fw-normal fst-normal" style="min-width:10%; width:10%;">Nis</th>
                                            <th class="fw-normal fst-normal">Nama Lengkap</th>
                                            <th class="fw-normal fst-normal">Tempat, Tanggal Lahir</th>
                                            <th class="fw-normal fst-normal">Agama Siswa</th>
                                            <th class="fw-normal fst-normal">Data Orang Tua</th>
                                            <th class="fw-normal fst-normal">Data Document</th>
                                            <th class="fw-normal fst-normal">Seleksi Siswa</th>
                                            <th class="fw-normal fst-normal">Action List</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $hasil = $viewSiswa->StudentRead();
                                            $no = 1;
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi["nis"]; ?></td>
                                            <td><?php echo $isi["nama_lengkap"]; ?></td>
                                            <td><?php echo $isi["tempat_lahir"].", ".$isi["tanggal_lahir"]; ?></td>
                                            <td><?php echo $isi["agama"]; ?></td>
                                            <td>
                                                <a href="" role="button" data-bs-target="" data-bs-toggle=""
                                                    aria-controls="" aria-current="page" class="btn btn-danger">
                                                    <i class="fas fa-user-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" role="button" data-bs-target="" data-bs-toggle=""
                                                    aria-controls="" aria-current="page" class="btn btn-primary">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>
                                                <a href="" role="button" data-bs-target="" data-bs-toggle=""
                                                    aria-controls="" aria-current="page" class="btn btn-info">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>
                                            </td>
                                            <?php 
                                                if(!empty($_GET["act_seleksi"] == "yes")){
                                            ?>
                                            <form action="" enctype="multipart/form-data" method="post">

                                            </form>
                                            <?php
                                                }else{
                                            ?>
                                            <td><?php echo $isi["seleksi"]; ?></td>
                                            <?php
                                                }
                                            ?>
                                            <td>
                                                <a href="" aria-current="page" class="btn btn-secondary hover">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="" aria-current="page" class="btn btn-danger hover">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
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