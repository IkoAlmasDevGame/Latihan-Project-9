<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Pendaftaran</title>
        <?php 
            require_once("../ui/header.php");
            function agama($agama){
                switch ($agama) {
                    case '1':
                        echo $agama = "Buddha";
                        break;

                    case '2':
                        echo $agama = "Hindu";
                        break;

                    case '3':
                        echo $agama = "Kristen";
                        break;

                    case '4':
                        echo $agama = "Katholik";
                        break;

                    case '5':
                        echo $agama = "Islam";
                        break;

                    case '6':
                        echo $agama = "Konghucu";
                        break;
                    
                    default:
                        echo $agama = "Atheis";
                        break;
                }
            }
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
                            <a href="?page=lihat-siswa&nama=<?=$_SESSION["nama_pengguna"]?>&hapus=yes"
                                aria-current="page" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                                <span>Hapus Siswa Baru</span>
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
                                            <td><?php echo agama($isi['agama']); ?></td>
                                            <td>
                                                <a href="" role="button" data-bs-target="#photoSiswa"
                                                    data-bs-toggle="modal" aria-controls="photoSiswa"
                                                    aria-current="page" tabindex="-1" class="btn btn-danger">
                                                    <i class="fas fa-user-alt"></i>
                                                </a>
                                                <div class="modal fade" id="photoSiswa" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">

                                                            </div>
                                                            <div class="modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="" role="button" data-bs-target="#docSiswa1"
                                                    data-bs-toggle="modal" tabindex="-1" aria-controls="docSiswa1"
                                                    aria-current="page" class="btn btn-primary">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>
                                                <a href="" role="button" data-bs-target="#docSiswa2"
                                                    data-bs-toggle="modal" tabindex="-1" aria-controls="docSiswa2"
                                                    aria-current="page" class="btn btn-info">
                                                    <i class="fas fa-file-alt"></i>
                                                </a>
                                                <div class="modal fade" id="docSiswa1" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-4 fw-lighter fst-normal">
                                                                    Document
                                                                    PDF (1)</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="docSiswa2" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-4 fw-lighter fst-normal">
                                                                    Document
                                                                    PDF (2)</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="?page=edit-siswa&nama=<?=$_SESSION['nama_pengguna']?>&id_siswa=<?=$isi['id_siswa']?>"
                                                    aria-current="page" class="btn btn-secondary hover">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php 
                                                    if(!empty($_GET["hapus"]=="yes")){
                                                ?>
                                                <a href="?aksi=hapus&nis=<?=$isi['nis']?>&id_siswa=<?=$isi['id_siswa']?>"
                                                    role="button" aria-current="page"
                                                    onclick="javascript:return confirm('apakah anda ingin menghapus data ini ?')"
                                                    class="btn btn-danger hover">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <?php
                                                    }
                                                ?>
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