<?php 
if($_SESSION["user_level"] == ""){
    header("location:../auth/index.php");
    exit(0);
}
?>

<?php 
if($_SESSION["user_level"] == "Admin"){
?>
<div class="col-md-12 col-lg-12">
    <nav class="navbar navbar-custom-menu navbar-expand-lg bg-body-secondary">
        <header class="container-fluid">
            <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" class="navbar-brand">Dashboard
                Admin Sekolah</a>
            <span id="time"></span>
            <button type="button" class="navbar-toggler" data-bs-target="#navbarToggle" data-bs-toggle="collapse"
                aria-controls="navbarToggle" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <aside class="collapse navbar-collapse" id="navbarToggle">
                <ul class="nav flex-column ms-auto pe-5 me-5 mb-2 mb-lg-0">
                    <div class="navbar-nav">
                        <li class="nav-item">
                            <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=guru&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Guru</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=siswa&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=jadwal&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=kelas&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=pelajaran&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Mata Pelajaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=pembayaran&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=lihat-siswa&nama=<?=$_SESSION["nama_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Lihat Data Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=pesan&email=<?=$_SESSION["email_pengguna"]?>" class="nav-link hover"
                                aria-current="page">Message</a>
                        </li>
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle" aria-controls="dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">Settings</button>
                            <ol class="dropdown-submenu">
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item-text">
                                        <a href="?page=akun&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                                            class="dropdown-item hover fs-6">Pembuatan Akun</a>
                                        <a href="?page=account&nama=<?=$_SESSION['nama_pengguna']?>" aria-current="page"
                                            class="dropdown-item hover fs-6">Account</a>
                                        <a href="?aksi=logout&nama=<?=$_SESSION['nama_pengguna']?>"
                                            onclick="javascript:return confirm('Apakah anda ingin keluar ?')"
                                            aria-current="page" class="dropdown-item hover fs-6">Log Out</a>
                                    </li>
                                </ul>
                            </ol>
                        </div>
                    </div>
                </ul>
            </aside>
        </header>
    </nav>
</div>
<?php
}else{
    header("location:../auth/index.php");
    exit(0);
}
?>