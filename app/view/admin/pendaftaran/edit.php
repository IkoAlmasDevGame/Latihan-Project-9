<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Data Siswa Baru</title>
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
                        <div class="panel-heading pt-5 text-end">
                            <h4 class="panel-title fs-4 fst-normal fw-lighter">Pendaftaran Siswa Baru</h4>
                        </div>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=lihat-siswa&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Lihat Data Masuk</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=edit-siswa&nama=<?=$_SESSION["nama_pengguna"]?>&nis=<?="";?>"
                                    aria-current="page" class="text-decoration-none">Edit Siswa</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title fs-4 fst-normal fw-lighter">Edit Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <form action="?act=edit-siswa-baru" enctype="multipart/form-data" method="post">
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">EDIT DATA SISWA BARU</th>
                            </table>
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">DATA ORANG TUA</th>
                            </table>
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">DATA DOCUMENT SISWA</th>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>