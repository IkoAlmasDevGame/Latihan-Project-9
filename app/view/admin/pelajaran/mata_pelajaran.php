<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Mata Pelajaran 2</title>
        <?php 
            require_once("../ui/header.php");
            $id = htmlspecialchars($_GET['id_kelas']);
            $row = $configs->prepare("SELECT * FROM tb_kelas WHERE id_kelas = ?");
            $row->execute(array($id));
            $iHasil = $row->fetch();
        ?>
        <script lang="javascript">
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
    </head>

    <body>
        <?php 
            require_once("../ui/navbar.php");
        ?>
        <div class="container-fluid py-5 p-5 bg-secondary rounded-1 min-vh-100">
            <div class="container-fluid bg-body-secondary rounded-1 min-vh-100">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="panel-title fst-normal fw-lighter pt-3 pt-lg-3">Mata Pelajaran 2</h4>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Beranda</a>
                            </li>
                            <?php 
                                if(isset($_GET['id_kelas'])){
                                    if($id == $iHasil['id_kelas']){
                            ?>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=kelas&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Kelas Pelajar</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$iHasil['id_kelas']?>"
                                    class="text-decoration-none text-primary">Mata Pelajaran 2</a>
                            </li>
                            <?php
                                }
                            }else{
                            ?>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=pelajaran&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Mata Pelajaran</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Mata Pelajaran 2</a>
                            </li>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <?php 
                            if(isset($_GET['id_kelas'])){
                                if($id == $iHasil['id_kelas']){
                        ?>
                        <h4 class="card-title fw-lighter fst-normal">- List Mata Pelajaran
                            - <?php echo ucwords(ucfirst($iHasil['namakelas']))?> -
                        </h4>
                        <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$iHasil['id_kelas']?>"
                            aria-current="page" class="btn btn-warning active"><i class="fas fa-book-open hover"></i>
                            Mata Pelajaran</a>
                        <?php
                            }
                        ?>
                        <?php
                            }else{
                        ?>
                        <h4 class="card-title fw-lighter fst-normal">List Mata Pelajaran 2</h4>
                        <a href="?page=pelajaran&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                            class="btn btn-warning active"><i class="fas fa-book-open hover"></i> Mata
                            Pelajaran</a>
                        <a href="?page=mapel&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                            class="btn btn-warning active"><i class="fas fa-book-open hover"></i> Mata
                            Pelajaran 2</a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-md table-responsive-lg">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-lighter text-center"> Jam Ke </th>
                                        <th class="fw-lighter text-center"> Senin </th>
                                        <th class="fw-lighter text-center"> Selasa </th>
                                        <th class="fw-lighter text-center"> Rabu </th>
                                        <th class="fw-lighter text-center"> Kamis </th>
                                        <th class="fw-lighter text-center"> Jumat </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $table = "tb_jam";
                                        $sql = "SELECT * FROM $table order by id_jam asc";
                                        $row = $configs->prepare($sql);
                                        $row->execute();
                                        $hasil = $row->fetchAll();
                                        foreach ($hasil as $isi) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?=$isi['mulai']." - ".$isi['akhir']?></td>
                                        <?php for($j=1; $j <= 5; $j++){ ?>
                                        <?php 
                                            $hari = "";
                                                if($j == 1){
                                                    $hari = "Senin";
                                                }else if($j == 2){
                                                    $hari = "Selasa";
                                                }else if($j == 3){
                                                    $hari = "Rabu";
                                                }else if($j == 4){
                                                    $hari = "Kamis";
                                                }else if($j == 5){
                                                    $hari = "Jumat";
                                                }
                                            ?>
                                        <td>
                                            <form action="" id="form_id_<?=$j."_".$isi['id_jam']?>" method="post">
                                                <input type="hidden" name="id_kelas" value="<?=$iHasil['id_kelas']?>">
                                                <input type="hidden" name="hari" value="<?=$hari;?>">
                                                <input type="hidden" name="id_jam" value="<?=$isi['id_jam']?>">
                                                <?php 
                                                    $id_kelas = $iHasil['id_kelas'];
                                                    $id_jam = $isi['id_jam'];

                                                    $sql = "SELECT * FROM tb_jadwal inner join tb_pelajaran on tb_pelajaran.id_pelajaran = tb_jadwal.id_pelajaran WHERE id_jam = '$id_jam' && id_kelas = '$id_kelas' && hari='$hari'";
                                                    $row = $configs->prepare($sql);
                                                    $row->execute();
                                                    $ii = $row->fetch();
                                                ?>
                                                <input type="hidden" name="id_jadwal" value="<?=$ii['id_jadwal']?>"
                                                    required>
                                                <select name="id_pelajaran" data-toggle="tooltip"
                                                    class="form-control select" data-placement="top"
                                                    title="<?=$ii['pelajaran']?>" type="submit"
                                                    onchange="document.getElementById('form_id_<?=$j.'_'.$isi['id_jam']; ?>').submit();">
                                                    <option value=""> Mata Pelajaran </option>
                                                    <?php 
                                                        $dataPelajaran = $configs->prepare("SELECT * FROM tb_pelajaran");
                                                        $dataPelajaran->execute();
                                                        $hasil = $dataPelajaran->fetchAll();
                                                        foreach ($hasil as $iPelajaran) {
                                                    ?>
                                                    <option value="<?=$iPelajaran['id_pelajaran']?>"
                                                        <?php if($ii['id_pelajaran'] == $iPelajaran['id_pelajaran']){ echo "selected"; }?>>
                                                        <?=$iPelajaran['pelajaran']?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </form>
                                            <form action="" id="form_id_2_<?=$j."_".$isi['id_jam']?>" method="post">
                                                <?php 
                                                    $id_kelas = $iHasil['id_kelas'];
                                                    $id_jam = $isi['id_jam'];

                                                ?>
                                            </form>
                                        </td>
                                        <?php
                                            }
                                        ?>
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>