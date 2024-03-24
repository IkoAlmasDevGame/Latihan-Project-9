<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Pesan</title>
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
                        <div class="panel-heading pt-5 text-start">
                            <h4 class="panel-title fs-4 fst-normal fw-lighter">Lihat Pesan Masuk</h4>
                        </div>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=pesan&email=<?=$_SESSION["email_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Lihat Pesan Masuk</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-1">
                    <?php 
                    if(isset($_GET["editpesan"])){
                        if($_GET["editpesan"] == "yes"){
                            $id = htmlspecialchars($_GET["id_pesan"]) ? htmlentities($_GET["id_pesan"]) : $_GET["id_pesan"];
                            $table1 = "tb_pesan";
                            $sql1 = "SELECT * FROM $table1 WHERE id_pesan = ?";
                            $row1 = $configs->prepare($sql1);
                            $row1->execute(array($id));
                            $hasil = $row1->fetchAll();
                        foreach($hasil as $iHasili){
                    ?>
                    <div class="card col-md-4 col-lg-4">
                        <div class="card-header">
                            <div class="card-header-form text-end">
                                <i class="fa fa-envelope fs-4"></i>
                            </div>
                            <h4 class="card-title fs-5 text-start">
                                Edit Pesan
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=edit-pesan" method="post" enctype="multipart/form-data">
                                <div class="row form-group input-group
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="email" name="toFrom" class="form-control"
                                                value="<?=$iHasili['toFrom']?>" readonly
                                                placeholder="Masukkan Email anda ..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toTo" value="<?=$iHasili['toTo']?>"
                                                class="form-control" placeholder="Masukkan Email tujuan ...." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toSubject" value="<?=$iHasili['toSubject']?>"
                                                class="form-control" placeholder="Masukkan subject baru anda ...."
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <textarea name="toMessage" class="form-control"
                                                style="height: 100%; min-height:auto;"
                                                placeholder="Ketikkan pesan anda disini ..."
                                                required><?=$iHasili['toMessage']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2"></div>
                                <div class="modal-footer"></div>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-danger btn-outline-light">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Kirim pesan</span>
                                    </button>
                                    <button type="reset" class="btn btn-secondary btn-outline-light">
                                        <i class="fa fa-eraser"></i>
                                        <span>Cancel pesan</span>
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <?php
                    }
                    }else if(isset($_GET['balaspesan'])){
                        if($_GET["balaspesan"] == "yes"){
                            $id = htmlspecialchars($_GET["id_pesan"]) ? htmlentities($_GET["id_pesan"]) : $_GET["id_pesan"];
                            $table2 = "tb_pesan";
                            $sql2 = "SELECT * FROM $table2 WHERE id_pesan = ?";
                            $row2 = $configs->prepare($sql2);
                            $row2->execute(array($id));
                            $hasil = $row2->fetchAll();
                        foreach ($hasil as $iHasil) {
                    ?>
                    <div class="card col-md-3 col-lg-3">
                        <div class="card-header">
                            <div class="card-header-form text-end">
                                <i class="fa fa-envelope fs-4"></i>
                            </div>
                            <h4 class="card-title fs-5 text-start">
                                Balas Pesan
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=balas-pesan" method="post" enctype="multipart/form-data">
                                <div class="row form-group input-group
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="email" name="toFrom" class="form-control"
                                                value="<?=$iHasil['toTo']?>" readonly
                                                placeholder="Masukkan Email anda ..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toTo" value="<?=$iHasil['toFrom']?>"
                                                class="form-control" placeholder="Masukkan Email tujuan ...." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toSubject" value="<?=$iHasil['toSubject']?>"
                                                class="form-control" placeholder="Masukkan subject baru anda ...."
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <textarea name="toMessage" class="form-control"
                                                style="height: 100%; min-height:auto;"
                                                placeholder="Ketikkan pesan anda disini ..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2"></div>
                                <div class="modal-footer"></div>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-danger btn-outline-light">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Kirim pesan</span>
                                    </button>
                                    <button type="reset" class="btn btn-secondary btn-outline-light">
                                        <i class="fa fa-eraser"></i>
                                        <span>Cancel pesan</span>
                                    </button>
                                </p>
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
                    <div class="card col-md-3 col-lg-3">
                        <div class="card-header">
                            <div class="card-header-form text-end">
                                <i class="fa fa-envelope fs-4"></i>
                            </div>
                            <h4 class="card-title fs-5 text-start">
                                Message Blank Paper
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="?act=kirim-pesan" method="post" enctype="multipart/form-data">
                                <div class="row form-group input-group
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="email" name="toFrom" class="form-control"
                                                value="<?=$_SESSION['email_pengguna']?>" readonly
                                                placeholder="Masukkan Email anda ..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toTo" class="form-control"
                                                placeholder="Masukkan Email tujuan ...." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <input type="text" name="toSubject" class="form-control"
                                                placeholder="Masukkan subject baru anda ...." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"></div>
                                <div class="row form-group input-group 
                                    d-flex justify-content-end align-items-end flex-wrap">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="input-group-addon">
                                            <textarea name="toMessage" class="form-control"
                                                style="height: 100%; min-height:auto;"
                                                placeholder="Ketikkan pesan anda disini ..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2"></div>
                                <div class="modal-footer"></div>
                                <p class="text-end">
                                    <button type="submit" class="btn btn-danger btn-outline-light">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Kirim pesan</span>
                                    </button>
                                    <button type="reset" class="btn btn-secondary btn-outline-light">
                                        <i class="fa fa-eraser"></i>
                                        <span>Cancel pesan</span>
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="card col-md-8 col-lg-8">
                        <div class="card-header">
                            <div class="card-header-form">
                                <p class="text-start">
                                    <a href="?page=pesan&email=<?=$_SESSION['email_pengguna']?>"
                                        class="btn btn-warning">
                                        <i class="fa fa-refresh"></i>
                                        <span>refresh halaman</span>
                                    </a>
                                    <a href="?page=pesan&keluar=yes&email=<?=$_SESSION['email_pengguna']?>"
                                        class="btn btn-danger">
                                        <i class="fa fa-envelope-open"></i>
                                        <span>Pesan Keluar</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-md table-responsive-lg">
                                <?php 
                                    if(!empty($_GET["keluar"] == "yes")){
                                ?>
                                <table class="table table-striped" id="example1">
                                    <thead class="table-head-fixed">
                                        <tr>
                                            <th class="fst-normal fw-lighter">No</th>
                                            <th class="fst-normal fw-lighter">Email dari</th>
                                            <th class="fst-normal fw-lighter">Email kepada</th>
                                            <th class="fst-normal fw-lighter">Subject</th>
                                            <th class="fst-normal fw-lighter">Pesan</th>
                                            <th class="fst-normal fw-lighter">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $table = "tb_pesan";
                                            $email = $_SESSION['email_pengguna'];
                                            $sql = "SELECT * FROM $table WHERE toFrom = ? order by id_pesan asc";
                                            $row = $configs->prepare($sql);
                                            $row->execute(array($email));
                                            $iHas = $row->fetchAll();
                                            foreach ($iHas as $isi) {
                                        ?>
                                        <tr>
                                            <td><?php $no=1; echo $no++; ?></td>
                                            <td><?php echo $isi['toFrom'] ?></td>
                                            <td><?php echo $isi['toTo'] ?></td>
                                            <td><?php echo $isi['toSubject'] ?></td>
                                            <td>
                                                <textarea style="min-width: 100%; width:250px;"
                                                    class="border border-0 border-transparent" required
                                                    readonly><?php echo $isi['toMessage'] ?></textarea>
                                            </td>
                                            <td>
                                                <a href="?page=pesan&email=<?=$_SESSION['email_pengguna']?>&editpesan=yes&id_pesan=<?=$isi['id_pesan']?>"
                                                    aria-current="page" class="btn btn-warning hover">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?act=hapus&id=<?=$isi['id_pesan']?>" role="button"
                                                    onclick="javascript:return confirm('')" aria-current="page"
                                                    class="btn btn-danger hover">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                    }else{
                                ?>
                                <table class="table table-striped" id="example1">
                                    <thead class="table-head-fixed">
                                        <tr>
                                            <th class="fst-normal fw-lighter">No</th>
                                            <th class="fst-normal fw-lighter">Email kepada</th>
                                            <th class="fst-normal fw-lighter">Subject</th>
                                            <th class="fst-normal fw-lighter">Pesan</th>
                                            <th class="fst-normal fw-lighter">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $table = "tb_pesan";
                                            $email = $_SESSION['email_pengguna'];
                                            $sql = "SELECT * FROM $table WHERE toTo = ? order by id_pesan asc";
                                            $row = $configs->prepare($sql);
                                            $row->execute(array($email));
                                            $iHasi = $row->fetchAll();
                                            foreach ($iHasi as $pesan) {
                                        ?>
                                        <tr>
                                            <td><?php $no=1; echo $no++; ?></td>
                                            <td><?php echo $pesan['toFrom'] ?></td>
                                            <td><?php echo $pesan['toSubject'] ?></td>
                                            <td>
                                                <textarea style="min-width: 100%; width:250px;"
                                                    class="border border-0 border-transparent" required
                                                    readonly><?php echo $pesan['toMessage'] ?></textarea>
                                            </td>
                                            <td>
                                                <a href="?page=pesan&email=<?=$_SESSION['email_pengguna']?>&balaspesan=yes&id_pesan=<?=$pesan['id_pesan']?>"
                                                    aria-current="page" class="btn btn-primary hover">
                                                    <i class="fa fa-paper-plane"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
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
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>