<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Siswa</title>
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
                        <div class="panel-heading text-start">
                            <h4 class="panel-title fs-4 pt-4 fst-normal fw-lighter">Lihat Siswa</h4>
                        </div>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=siswa&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Lihat Siswa</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="card col-md-9 col-lg-9">
                        <div class="card-header">
                            <div class="card-header-form">
                                <a href="?page=siswa&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                                    class="btn btn-warning active">
                                    List Siswa Create
                                </a>
                                <a href="?page=siswa&nama=<?=$_SESSION['nama_pengguna']?>&update=yes"
                                    aria-current="page" class="btn btn-danger active">
                                    Update Kelas Siswa
                                </a>
                                <a href="?page=siswa&nama=<?=$_SESSION['nama_pengguna']?>&informasi=yes"
                                    aria-current="page" class="btn btn-secondary active">
                                    Information
                                </a>
                            </div>
                            <?php 
                                if(!empty($_GET["informasi"]=="yes")){
                                echo "<div aria-hidden='true' tabindex='-1'>
                                    <h4 class='card-title fs-6 fw-lighter fst-normal text-end'>Klick Submit untuk Masuk Kelas 1 untuk
                                        siswa baru mendaftar</h4>
                                    </div>";
                                }
                            ?>
                            <div class="pb-2"></div>
                        </div>
                        <div class="table-responsive-md table-responsive-lg">
                            <div class="pb-2"></div>
                            <table class="table table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th class="fst-normal fw-lighter text-center">No</th>
                                        <th class="fst-normal fw-lighter text-center">Nama Pelajar</th>
                                        <th class="fst-normal fw-lighter text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $table = "tb_pendaftaran";
                                        $sql = "SELECT * FROM $table ORDER BY id_siswa ASC";
                                        $row = $configs->prepare($sql);
                                        $row->execute();
                                        $hasil = $row->fetchAll();
                                        foreach ($hasil as $isi) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no; ?></td>
                                        <td class="text-center"><?php echo $isi['nama_lengkap']; ?></td>
                                        <?php 
                                            if(!empty($_GET['update']=="yes")){
                                        ?>
                                        <form action="?act=update-data" enctype="multipart/form-data" method="post">
                                            <td class="text-center">
                                                <input type="hidden" name="id_siswa" value="<?=$isi['id_siswa']?>">
                                                <select name="id_kelas" class="form-control" required type="submit"
                                                    onchange="this.form.submit()">
                                                    <option value="">Pilih Kenaikan Kelas</option>
                                                    <?php 
                                                        $hasil = $viewKelas->read();
                                                        foreach ($hasil as $key) {
                                                    ?>
                                                    <option value="<?=$key['id_kelas']?>"><?=$key['namakelas']?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </form>
                                        <?php
                                            }else{
                                        ?>
                                        <td class="text-center">
                                            <form action="?act=create-data" method="post">
                                                <input type="hidden" name="id_siswa" value="<?=$isi['id_siswa']?>">
                                                <input type="hidden" name="id_kelas" value="1">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
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
        <?php 
            require_once("../ui/footer.php");
        ?>