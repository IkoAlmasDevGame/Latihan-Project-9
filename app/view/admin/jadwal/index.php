<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Jadwal</title>
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
                        <h4 class="panel-title fst-normal fw-lighter">Jadwal Jam</h4>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=jadwal&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Jadwal</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <?php 
                        if(isset($_GET["ganti"])){
                            if($_GET["ganti"] == "yes"){
                            $id = htmlspecialchars($_GET["id_jam"]) ? htmlentities($_GET["id_jam"]) : $_GET["id_jam"];
                            $row = $configs->prepare("SELECT * FROM tb_jam WHERE id_jam = ?");
                            $row->execute(array($id));
                            $hasil = $row->fetchAll();
                            foreach ($hasil as $i) {
                    ?>
                    <div class="card col-md-4 col-lg-4">
                        <div class="card-header">
                            <h4 class="card-title fst-normal-fw-lighter">Edit Jadwal Jam</h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=edit-jadwal-jam" enctype="multipart/form-data" method="post">
                                <table class="table table-striped">
                                    <input type="hidden" name="id_jam" value="<?=$i["id_jam"]?>">
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam</td>
                                        <td>
                                            <input type="number" name="jam" value="<?=$i["jam"]?>"
                                                placeholder="jam ke berapa - " class="form-control time" required
                                                aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam Mulai</td>
                                        <td>
                                            <input type="time" name="mulai" value="<?=$i["mulai"]?>"
                                                class="form-control time" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam Akhir</td>
                                        <td>
                                            <input type="time" name="akhir" value="<?=$i["akhir"]?>"
                                                class="form-control time" required aria-required="true">
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="modal-footer container-fluid">
                                        <button type="submit" class="btn btn-primary mx-1">
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-danger mx-1">
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
                    <?php
                        }
                    }else{
                    ?>
                    <div class="card col-md-4 col-lg-4">
                        <div class="card-header">
                            <h4 class="card-title fst-normal-fw-lighter">Tambah Jadwal Jam</h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=tambah-jadwal-jam" enctype="multipart/form-data" method="post">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam</td>
                                        <td>
                                            <input type="number" name="jam" placeholder="jam ke berapa - "
                                                class="form-control time" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam Mulai</td>
                                        <td>
                                            <input type="time" name="mulai" placeholder="mulai jam berapa pelajaran"
                                                class="form-control time" required aria-required="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-lighter fst-normal fs-4">Jam Akhir</td>
                                        <td>
                                            <input type="time" name="akhir" placeholder="selesai jam berapa pelajaran"
                                                class="form-control time" required aria-required="true">
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <div class="modal-footer container-fluid">
                                        <button type="submit" class="btn btn-primary mx-1">
                                            Simpan
                                        </button>
                                        <button type="reset" class="btn btn-danger mx-1">
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
                    <div class="card col-md-7 col-lg-7">
                        <div class="card-header">
                            <div class="card-header-form">
                                <h4 class="card-title fs-5 fst-normal fw-lighter">List Data Guru Sekolah</h4>
                                <div class="card-header-form">
                                    <a href="?page=jadwal&nama=<?=$_SESSION["nama_pengguna"]?>" role="button"
                                        class="btn btn-info">List Data Jadwal</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-md table-responsive-lg">
                                    <table class="table table-striped" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="fw-lighter fst-normal">No</th>
                                                <th class="fw-lighter fst-normal">Jam Ke -</th>
                                                <th class="fw-lighter fst-normal">Mulai</th>
                                                <th class="fw-lighter fst-normal">Akhir</th>
                                                <th class="fw-lighter fst-normal">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $hasil = $viewJadwal->ReadJadwal();
                                                $no = 1;
                                                foreach ($hasil as $isi) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo "jam ke - ".$isi["jam"] ?></td>
                                                <td><?php echo $isi["mulai"] ?></td>
                                                <td><?php echo $isi["akhir"] ?></td>
                                                <td>
                                                    <a href="?page=jadwal&nama=<?=$_SESSION["nama_pengguna"]?>&ganti=yes&id_jam=<?=$isi["id_jam"]?>"
                                                        aria-current="page" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="?act=hapus-jadwal-jam&nama=<?=$_SESSION["nama_pengguna"]?>&id_jam=<?=$isi["id_jam"]?>"
                                                        aria-current="page" class="btn btn-danger">
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>