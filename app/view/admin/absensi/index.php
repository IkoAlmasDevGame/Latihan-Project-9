<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Absensi</title>
        <?php 
            require_once("../ui/header.php");
            $id = htmlspecialchars($_GET['id_kelas']);
            $row = $configs->prepare("SELECT * FROM tb_kelas WHERE id_kelas = ?");
            $row->execute(array($id));
            $iHasil = $row->fetch();
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
                        <h4 class="panel-title fst-normal fw-lighter pt-3 pt-lg-3">List Absensi Kelas</h4>
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
                                <a href="?page=absensi&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$iHasil['id_kelas']?>"
                                    class="text-decoration-none text-primary">Absensi Pelajar</a>
                            </li>
                            <?php
                                }
                            }else{
                            ?>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=kelas&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Kelas Pelajar</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=absensi&nama=<?=$_SESSION['nama_pengguna']?>"
                                    class="text-decoration-none text-primary">Absensi Pelajar</a>
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
                        <h4 class="card-title fw-lighter fst-normal">- List Absensi Kelas
                            - <?php echo ucwords(ucfirst($iHasil['namakelas']))?> -
                        </h4>
                        <a href="?page=absensi&nama=<?=$_SESSION['nama_pengguna']?>&id_kelas=<?=$iHasil['id_kelas']?>"
                            aria-current="page" class="btn btn-warning active"><i class="fas fa-house-user hover"></i>
                            Kelas Pelajar</a>
                        <?php
                            }
                        ?>
                        <?php
                            }else{
                        ?>
                        <h4 class="card-title fw-lighter fst-normal">List Absensi Kelas</h4>
                        <a href="?page=absensi&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                            class="btn btn-warning active"><i class="fas fa-house-user hover"></i>Absensi Pelajar</a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="table-reponsive-md table-responsive-lg">
                            <?php 
                                if(isset($_GET["id_kelas"])){
                                    if($id == $iHasil["id_kelas"]){
                            ?>
                            <form action="?act=input-absensi" enctype="multipart/form-data" method="post">
                                <input type="hidden" value="<?php echo $iHasil['id_kelas'];?>" name="id_kelas" />
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <div class="input-group">
                                                <div class="input-group-addon form-control">
                                                    <input type="date" name="tanggal" class="form-control date">
                                                </div>
                                            </div>
                                            <div class="mb-2"></div>
                                        </tr>
                                        <tr>
                                            <th class="fst-normal text-center fw-lighter">No</th>
                                            <th class="fst-normal text-start fw-lighter">Nama Pelajar</th>
                                            <th class="fst-normal text-center fw-lighter">Hadir (H)</th>
                                            <th class="fst-normal text-center fw-lighter">Sakit (S)</th>
                                            <th class="fst-normal text-center fw-lighter">Ijin (I)</th>
                                            <th class="fst-normal text-center fw-lighter">Alfa (A)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 0;
                                            $c = 1;
                                            $sql = "SELECT * FROM tb_siswa where id_kelas = ?";
                                            $row = $configs -> prepare($sql);
                                            $row->execute(array($iHasil["id_kelas"]));
                                            $hasil = $row->fetchAll();
                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td class="text-center fst-normal fw-lighter"><?php echo $c; ?></td>
                                            <td class="text-start fst-normal fw-lighter">
                                                <?php echo ucwords(ucfirst($isi["nama_lengkap"])); ?></td>
                                            <td align="center">
                                                <?php
			                        	            echo "<input type=checkbox name=hadir[] value=$row[id_siswa] id='$no'>";
			                        	            $no++;
			                        	        ?>
                                            </td>
                                            <td align="center">
                                                <?php
			                        	            echo "<input type=checkbox name=sakit[] value=$row[id_siswa] id=$no>";
			                        	            $no++;
			                        	        ?>
                                            </td>
                                            <td align="center">
                                                <?php
			                        	            echo "<input type=checkbox name=ijin[] value=$row[id_siswa] id=$no>";
			                        	            $no++;
			                        	        ?>
                                            </td>
                                            <td align="center">
                                                <?php
			                        	            echo "<input type=checkbox name=alfa[] value=$row[id_siswa] id=$no>";
			                        	            $no++;
			                        	        ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $c++;
                                            }
                                        echo "
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td align=center>
                                                <input type='button' name='pilih' onclick='for (i=0;i<$no;i++){document.getElementById(i).checked=true;}' value='Check All'>
                                                </td>
                                                <td align=center>
                                                <input type='button' name='pilih' onclick='for (i=0;i<$no;i++){document.getElementById(i).checked=false;}' value='Uncheck All'>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>";
                                        ?>
                                    </tbody>
                                </table>
                                <input type="checkbox" name="selesai" value="yes" /> Tandai Kelas Selesai
                                <div class="mb-3"></div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <?php
                                }
                            }else{
                            ?>
                            <div class="input-group">
                                <div class="input-group-addon form-control">
                                    <form method="post">
                                        <select name="id_kelas" class="select form-control" required type="submit"
                                            onchange="this.form.submit(this);">
                                            <option value="">Pilih Kelas</option>
                                            <?php 
                                                $get_kelas = $configs->prepare("SELECT * FROM tb_kelas ORDER BY id_kelas asc");
                                                $get_kelas->execute();
                                                $get = $get_kelas->fetchAll();
                                                foreach ($get as $iKelas) {
                                            ?>
                                            <option value="<?=$iKelas['id_kelas']?>"><?php echo $iKelas['namakelas'] ?>
                                            </option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fst-normal text-center fw-lighter">No</th>
                                        <th class="fst-normal text-start fw-lighter">Nama Pelajar</th>
                                        <th class="fst-normal text-center fw-lighter">Kelas Pelajar</th>
                                        <th class="fst-normal text-center fw-lighter">Hadir (H)</th>
                                        <th class="fst-normal text-center fw-lighter">Sakit (S)</th>
                                        <th class="fst-normal text-center fw-lighter">Ijin (I)</th>
                                        <th class="fst-normal text-center fw-lighter">Alfa (A)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $id_kelas = htmlspecialchars($_POST['id_kelas']) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
                                        $sql = "SELECT tb_absensi.*, tb_pendaftaran.id_siswa, tb_pendaftaran.nama_lengkap, tb_siswa.id_siswa, tb_siswa.id_kelas, tb_kelas.id_kelas FROM tb_absensi inner join tb_siswa on tb_absensi.id_kelas = tb_siswa.id_kelas inner join tb_pendaftaran on tb_absensi.id_siswa = tb_pendaftaran.id_siswa inner join tb_kelas on tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_absensi.id_kelas = ? ";
                                        $row = $configs->prepare($sql);
                                        $row->execute(array($id_kelas));
                                        $ii = $row->fetchAll();
                                        $no = 1;
                                        $nama = $_SESSION['nama_pengguna'];
                                        foreach ($ii as $i) {
                                            $hadir = $configs->prepare("SELECT count(keterangan[h]) as hadir FROM tb_absensi WHERE keterangan = 'h'");
                                            $hadir->execute();
                                            $h = $hadir->fetch();

                                            $sakit = $configs->prepare("SELECT count(keterangan[s]) as sakit FROM tb_absensi WHERE keterangan = 's'");
                                            $sakit->execute();
                                            $s = $sakit->fetch();
                                            
                                            $izin = $configs->prepare("SELECT count(keterangan[i]) as izin FROM tb_absensi WHERE keterangan = 'i'");
                                            $izin->execute();
                                            $i = $izin->fetch();

                                            $alfa = $configs->prepare("SELECT count(keterangan[a]) as alfa FROM tb_absensi WHERE keterangan = 'a'");
                                            $alfa->execute();
                                            $a = $alfa->fetch();
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $i['nama_lengkap']; ?></td>
                                        <td><?php echo $i['namakelas']; ?></td>
                                        <td align="center"><?php echo number_format($h['hadir']) ?></td>
                                        <td align="center"><?php echo number_format($s['sakit']) ?></td>
                                        <td align="center"><?php echo number_format($i['izin']) ?></td>
                                        <td align="center"><?php echo number_format($a['alfa']) ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                </tbody>
                            </table>
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