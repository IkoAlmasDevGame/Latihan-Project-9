<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <?php 
            require_once("../../database/koneksi.php");
            require_once("../../model/model.php");
            require_once("../../controller/view.php");
            $mAuth = new view\ViewAuth($configs);
            if(!isset($_GET["act"])){
                require_once("../auth/index.php");
            }else{
                switch ($_GET["act"]) {
                    case 'signin':
                        $mAuth->LoginSiswa();
                        break;
                    
                    default:
                        require_once("../auth/index.php");
                        break;
                }
            }
        ?>
    </head>

    <body onload="startTime()">
        <div class="app">
            <div class="layout">
                <nav class="navbar navbar-expand-lg navbar-custom-menu bg-body-secondary">
                    <header class="container-fluid">
                        <a href="index.php" class="navbar-brand">Dashboard Sekolah</a>
                        <span id="time"></span>
                        <button type="button" class="navbar-toggler" data-bs-target="#navbarToggle"
                            data-bs-toggle="collapse" aria-controls="navbarToggle" aria-expanded="false">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <aside class="collapse navbar-collapse" id="navbarToggle">
                            <ul class="nav flex-column ms-auto mb-2 mb-lg-0">
                                <div class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="../index.php" class="nav-link hover">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="index.php" class="nav-link hover">Login</a>
                                    </li>
                                </div>
                            </ul>
                        </aside>
                    </header>
                </nav>

                <section>
                    <div class="container-fluid py-5 p-5 rounded-1 bg-secondary min-vh-100">
                        <div class="container-fluid py-5 rounded-1 bg-light min-vh-100">
                            <h3 class="fs-5 fw-lighter text-center pt-5 mt-5">Login Dashboard Siswa</h3>
                            <div class="d-flex justify-content-center align-items-center flex-wrap pt-5 mt-5">
                                <div class="card col-md-5 col-lg-5">
                                    <div class="card-header">
                                        <h3 class="fs-3 card-title text-center">Login Siswa</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="../auth/index.php?act=signin" method="post">
                                            <div class="row align-items-center form-group mb-2 mb-lg-0">
                                                <label for="userMail" class="input-group-addon">Email /
                                                    nomer induk siswa</label>
                                                <div class="input-group-text form-control">
                                                    <div class="input-group">
                                                        <input type="text" name="nisEmail" id="nisEmail"
                                                            class="form-control"
                                                            placeholder="masukkan nomer induk siswa atau email anda ..."
                                                            required aria-required="true">
                                                    </div>
                                                </div>
                                                <div class="mb-2"></div>
                                                <label for="passMail" class="input-group-addon">Kata
                                                    Sandi <small class="fs-6 fw-lighter fst-normal
                                                         text-muted gap-3">[Tanggal lahir password anda]</small>
                                                    <br>
                                                    <small class="fs-6 fw-lighter fst-normal
                                                         text-muted gap-3">Contoh password : [05-05-2021]</small>
                                                </label>
                                                <div class="input-group-text form-control">
                                                    <div class="input-group">
                                                        <input type="password" name="password" id="passMail"
                                                            class="form-control"
                                                            placeholder="masukkan kata sandi anda ..." required
                                                            aria-required="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <p class="card-footer container">
                                                    <button type="submit" class="btn btn-primary hover">
                                                        <i class="fa fa-sign-in-alt"></i>
                                                        <span>Login</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-danger hover">
                                                        <i class="fa fa-eraser"></i>
                                                        <span>Hapus</span>
                                                    </button>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript">
        function startTime() {
            var day = ["Ahad", "Itsnain", "tsulatsa", "Arbia", "Khamiis ", "Jumu’ah", "Sabtu"];
            var today = new Date();
            var tahun = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('time').innerHTML =
                day[today.getDay()] + ", " + h + ":" + m + ":" + s + ", " + tahun;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        </script>
    </body>

</html>