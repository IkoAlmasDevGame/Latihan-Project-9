<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Data Siswa Baru</title>
        <?php 
            require_once("../ui/header.php");
            $id = htmlspecialchars($_GET["id_siswa"]) ? htmlentities($_GET["id_siswa"]) : $_GET["id_siswa"];
            $table = "tb_pendaftaran";
            $sql = "SELECT * FROM $table WHERE id_siswa = ?";
            $row = $configs->prepare($sql);
            $row->execute(array($id));
            $hasil = $row->fetchAll();
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
                                <a href="?page=edit-siswa&nama=<?=$_SESSION["nama_pengguna"]?>&id_siswa=<?=$hasil["id_siswa"];?>"
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
                        <?php 
                            foreach ($hasil as $key) {
                        ?>
                        <form action="?act=edit-siswa-baru" enctype="multipart/form-data" method="post">
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">DATA SISWA BARU</th>
                                <tr>
                                    <td colspan="2" class="fw-lighter fst-normal fs-6">Nomer Induk Siswa</td>
                                    <td colspan="6">
                                        <input type="text" value="<?=$isi["nis"]?>" name="nis" maxlength="10"
                                            class="form-control" placeholder="Masukkan Nomer induk siswa baru"
                                            aria-required="true" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="fw-lighter fst-normal fs-6">Nama Lengkap</td>
                                    <td colspan="6">
                                        <input type="text" value="<?=$isi["nama_lengkap"]?>" name="nama_lengkap"
                                            maxlength="128" class="form-control"
                                            placeholder="Masukkan Nama Lengkap Siswa baru" aria-required="true"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-lighter fst-normal fs-6">Tempat Lahir</td>
                                    <td>
                                        <input type="text" name="tempat_lahir" maxlength="128" class="form-control"
                                            placeholder="Masukkan Tempat Lahir" value="<?=$isi["tempat_lahir"]?>"
                                            aria-required="true" required>
                                    </td>
                                    <td class="fw-lighter fst-normal fs-6">Tanggal Lahir</td>
                                    <td>
                                        <select name="tanggal" class="form-control" aria-required="true" required>
                                            <option value="">Pilih Tanggal Lahir</option>
                                            <?php 
                                                    $tanggal = 31;
                                                    for($a = 1; $a <= $tanggal; $a += 1){
                                                ?>
                                            <option <?php if($isi["tanggal_lahir"] == $a){?> selected="" <?php } ?>
                                                value="<?=$a;?>">
                                                <?=$a;?></option>
                                            <?php
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                    <td class="fw-lighter fst-normal fs-6">Bulan Lahir</td>
                                    <td>
                                        <select name="bulan_lahir" class="form-control" aria-required="true" required>
                                            <option value="">Pilih Bulan Lahir</option>
                                            <?php 
                                                $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                                $jlh_bln = count($bulan);
                                                $bln1 = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
                                                for ($c = 0; $c < $jlh_bln; $c += 1) { 
                                                ?>
                                            <option <?php if($isi["tanggal_lahir"] == $bln1[$c]){?> selected=""
                                                <?php } ?> value="<?=$bln1[$c]?>"><?=$bulan[$c]?></option>
                                            <?php
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                    <td class="fw-lighter fst-normal fs-6">Tahun Lahir</td>
                                    <td>
                                        <select name="tahun_lahir" class="form-control" aria-required="true" required>
                                            <option value="">Pilih Tahun Lahir</option>
                                            <?php 
                                                    $now = Date('Y');
                                                    for ($i=2000; $i <= $now; $i++) { 
                                                ?>
                                            <option <?php if($isi["tanggal_lahir"] == $i){?> selected="" <?php } ?>
                                                value="<?=$i?>">
                                                <?=$i;?></option>
                                            <?php
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Agama</td>
                                    <td colspan="3">
                                        <select name="agama" aria-required="true" required class="form-control">
                                            <option value="">Pilih Agama</option>
                                            <?php 
                                                $agama = array("Hindu","Budha","Kristen","Katholik","Islam","Konghucu");
                                                $jlh_agama = count($agama);
                                                $agm = array('01', '02', '03', '04', '05', '06');
                                                for ($c = 0; $c < $jlh_agama; $c += 1) { 
                                                ?>
                                            <option <?php if($isi["agama"] == $agm[$c]){?> selected="" <?php } ?>
                                                value="<?=$agm[$c];?>"><?=$agama[$c]?></option>
                                            <?php
                                                    }
                                                ?>
                                        </select>
                                    </td>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Jumlah Saudara</td>
                                    <td colspan="3">
                                        <input type="number" value="<?=$isi["jumlah_saudara"]?>" name="jumlah_saudara"
                                            class="form-control" aria-required="true" required
                                            placeholder="Berapa Jumlah Saudara Kandung">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Alamat Rumah</td>
                                    <td colspan="7">
                                        <textarea name="alamat" value="<?=$isi["alamat"]?>" maxlength="255"
                                            class="form-control" required aria-required="true"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">DATA ORANG TUA</th>
                                <tr>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Nama Ayah Kandung</td>
                                    <td colspan="2">
                                        <input type="text" name="nama_ayah" maxlength="128" class="form-control"
                                            placeholder="Masukkan Nama Ayah" value="<?=$isi["nama_ayah"]?>"
                                            aria-required="true" required>
                                    </td>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Pekerjaan Ayah Kandung</td>
                                    <td colspan="2">
                                        <input type="text" name="pekerjaan_ayah" required
                                            placeholder="Pekerjaan Ayah Kandung" value="<?=$isi["pekerjaan_ayah"]?>"
                                            class="form-control">
                                    </td>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">No Telepon Ayah</td>
                                    <td colspan="2">
                                        <input type="text" name="telepon_ayah" value="<?=$isi["telepon_ayah"]?>"
                                            maxlength="13" class="form-control" placeholder="Masukkan No Telepon Ayah"
                                            aria-required="true" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Nama Ibu Kandung</td>
                                    <td colspan="2">
                                        <input type="text" name="nama_ibu" maxlength="128" class="form-control"
                                            placeholder="Masukkan Nama Ibu" value="<?=$isi["nama_ibu"]?>"
                                            aria-required="true" required>
                                    </td>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">Pekerjaan Ibu Kandung</td>
                                    <td colspan="2">
                                        <input type="text" name="pekerjaan_ibu" required
                                            placeholder="Pekerjaan ibu Kandung" value="<?=$isi["pekerjaan_ibu"]?>"
                                            class="form-control">
                                    </td>
                                    <td colspan="1" class="fw-lighter fst-normal fs-6">No Telepon Ibu</td>
                                    <td colspan="2">
                                        <input type="text" name="telepon_ibu" value="<?=$isi["telepon_ibu"]?>"
                                            maxlength="13" class="form-control" placeholder="Masukkan No Telepon Ibu"
                                            aria-required="true" required>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-striped">
                                <th class="text-center fw-lighter fst-normal" colspan="8">DATA DOCUMENT SISWA</th>
                                <tr>
                                    <td>File Document PDF <br>(Kartu Keluarga)</td>
                                    <td>
                                        <input type="file" accept=".pdf" name="file_kk" class="form-control" required
                                            aria-required="true">
                                        <input type="hidden" accept=".pdf" name="file_akte"
                                            value="<?=$isi["file_kk"]?>">
                                    </td>
                                    <td>File Document PDF <br>(Akte Lahir)</td>
                                    <td>
                                        <input type="file" accept=".pdf" name="file_akte" class="form-control" required
                                            aria-required="true">
                                        <input type="hidden" accept=".pdf" name="file_akte"
                                            value="<?=$isi["file_akte"]?>">
                                    </td>
                                    <td>File Photo</td>
                                    <td>
                                        <input type="file" accept="image/*" name="file_image" class="form-control"
                                            required aria-required="true">
                                        <input type="hidden" name="file_image" accept="image/*"
                                            value="<?=$isi["file_image"]?>">
                                    </td>
                                </tr>
                            </table>
                            <div class="card-footer container-fuild">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mx-1">
                                        <i class="fas fa-save"></i>
                                        <span>Simpan</span>
                                    </button>
                                    <button type="reset" class="btn btn-danger mx-1">
                                        <i class="fas fa-eraser"></i>
                                        <span>Hapus semua</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>