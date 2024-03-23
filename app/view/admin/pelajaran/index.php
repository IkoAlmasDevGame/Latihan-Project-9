<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Mata Pelajaran</title>
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
                        <h4 class="panel-title fst-normal fw-lighter pt-3 pt-lg-3">Mata Pelajaran</h4>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=pelajaran&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Mata Pelajaran</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <?php 
                    if(isset($_GET['ganti'])){
                        if($_GET["ganti"] == "iya"){
                            $id = htmlspecialchars($_GET["id"]) ? htmlentities($_GET['id']) : $_GET['id'];
                            $hasil = $viewPelajaran->SubjectReadEdit($id);
                    ?>
                    <?php foreach ($hasil as $isi) { ?>
                    <div class="card col-md-5 col-lg-5">
                        <div class="card-header">
                            <div class="card-header-form">
                                <h4 class="card-title fw-lighter fst-normal">Edit Mata Pelajaran</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="?act=edit-mapel" enctype="multipart/form-data" method="post">
                                <input type="hidden" name="id_pelajaran" value="<?php echo $isi['id_pelajaran']?>">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fst-normal fw-lighter fs-4">Nama Pelajaran</td>
                                        <td>
                                            <input type="text" name="pelajaran" value="<?php echo $isi['pelajaran']; ?>"
                                                class="form-control" placeholder="masukkan nama mata pelajaran" required
                                                aria-required="true">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary hover">
                                                Simpan
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                    <?php
                        }else{
                    ?>
                    <div class="card col-md-5 col-lg-5">
                        <div class="card-header">
                            <div class="card-header-form">
                                <h4 class="card-title fw-lighter fst-normal">Tambah Mata Pelajaran</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="?act=tambah-mapel" enctype="multipart/form-data" method="post">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fst-normal fw-lighter fs-4">Nama Pelajaran</td>
                                        <td>
                                            <input type="text" name="pelajaran" class="form-control"
                                                placeholder="masukkan nama mata pelajaran" required
                                                aria-required="true">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary hover">
                                                Simpan
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="card col-md-6 col-lg-6">
                        <div class="card-header">
                            <div class="card-header-form">
                                <h4 class="card-title fw-lighter fst-normal">List Mata Pelajaran</h4>
                                <a href="?page=pelajaran&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                                    class="btn btn-warning active"><i class="fas fa-book-open hover"></i> Mata
                                    Pelajaran</a>
                                <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                                    class="btn btn-warning active"><i class="fas fa-book-open hover"></i> Mata
                                    Pelajaran 2</a>
                            </div>
                        </div>
                        <div class="table-responsive-md table-responsive-lg">
                            <div class="card-body">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="fst-normal fw-lighter">No</th>
                                            <th class="fst-normal fw-lighter">Nama Pelajaran</th>
                                            <th class="fst-normal fw-lighter">Create Date</th>
                                            <th class="fst-normal fw-lighter">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $hasil = $viewPelajaran->SubjectRead();
                                            $no = 1;
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo ucwords(ucfirst($isi["pelajaran"])); ?></td>
                                            <td><?php echo $isi["create_timestamp"] ?></td>
                                            <td>
                                                <a href="?page=pelajaran&nama=<?=$_SESSION['nama_pengguna']?>&ganti=iya&id=<?php echo $isi['id_pelajaran']?>"
                                                    aria-current="page" class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?act=hapus-pelajaran" aria-current="page"
                                                    class="btn btn-danger">
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