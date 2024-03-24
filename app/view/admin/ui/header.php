<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Utama</title>
        <?php
            session_start();
            require_once("../../../controller/view.php");
            require_once("../../../model/model.php");
            require_once("../../../database/koneksi.php");
            require_once("../../../config/authentication.php");
            require_once("../../../config/config.php");

            $viewAuth = new view\ViewAuth($configs);
            $viewAccount = new view\ViewAccount($configs);
            $viewAbsensi = new view\ViewAbsensi($configs);
            $viewGuru = new view\ViewGuru($configs);
            $viewKelas = new view\ViewKelas($configs);
            $viewPelajaran = new view\ViewPelajaran($configs);
            $viewPembayaran = new view\ViewPembayaran($configs);
            $viewPendaftaran = new view\ViewPendaftaran($configs);
            $viewSiswa = new view\ViewSiswa($configs);
            $viewJadwal = new view\ViewJadwal($configs);
            $viewMessage = new view\ViewMessage($configs);

            if(!isset($_GET['aksi'])){
                require_once("../dashboard/index.php");
            }else{
                switch ($_GET['aksi']) {
                    /* Log out */
                    case 'logout':
                        $created_end = Date("Y-m-d H:i:s a");
                        $table = "tb_user";
                        $sql = "UPDATE $table SET created_End = ? WHERE nama = ?";
                        $row = $configs->prepare($sql);
                        $row->execute(array($created_end, $_SESSION['nama_pengguna']));
                        if(isset($_SESSION['status'])){
                            unset($_SESSION['status']);
                            session_unset();
                            session_destroy();
                            $_SESSION = array();
                        }
                        header("location:../auth/index.php");
                        exit(0);
                    break; 
                    
                    default:
                        require_once("../dashboard/index.php");
                    break;
                }
            }

            if(!isset($_GET["page"])){
                require_once("../dashboard/index.php");
            }else{
                switch ($_GET["page"]) {
                    case 'beranda':
                        require_once("../dashboard/index.php");
                        break;

                    case 'guru':
                        require_once("../guru/index.php");
                        break;
                        
                    case 'siswa':
                        require_once("../siswa/index.php");
                        break;

                    case 'jadwal':
                        require_once("../jadwal/index.php");
                        break;

                    case 'absensi':
                        require_once("../absensi/index.php");
                        break;
                        
                    case 'kelas':
                        require_once("../kelas/index.php");
                        break;
                     
                    /* Pelajaran */
                    case 'pelajaran':
                        require_once("../pelajaran/index.php");
                        break;
                        
                    case 'mapel':
                        require_once("../pelajaran/mata_pelajaran.php");
                        break;
                    /* */
                        
                    case 'pembayaran':
                        require_once("../pembayaran/index.php");
                        break;
                    
                    /* Pendaftaran */ 
                    case 'lihat-siswa':
                        require_once("../pendaftaran/index.php");
                        break;

                    case 'pendaftaran':
                        require_once("../pendaftaran/siswa.php");
                        break;
                        
                    case 'edit-siswa':
                        require_once("../pendaftaran/edit.php");
                        break;
                    /* */ 
                        
                    case 'pesan':
                        require_once("../pesan/index.php");
                        break;
                        
                    case 'account':
                        require_once("../settings/index.php");
                        break;
                        
                    case 'akun':
                        require_once("../account/index.php");
                        break;
                    
                    default:
                        require_once("../dashboard/index.php");
                        break;
                }
            }

            if(!isset($_GET["act"])){
                require_once("../dashboard/index.php");
            }else{
                switch ($_GET["act"]) {
                    /* Guru */ 
                    case 'tambah-guru':
                        $viewGuru->TeacherCreate();
                        break;

                    case 'edit-guru':
                        $viewGuru->TeacherEdit();
                        break;
                        
                    case 'hapus-guru':
                        $viewGuru->TeacherDelete();
                        break;
                    /* Guru Akhir */

                    /* Account */
                    case 'tambah-akun':
                        $viewAccount->Register();
                        break;
                    /* Account Akhir */

                    /* pendaftaran */ 
                    case 'tambah-siswa-baru':
                        $viewPendaftaran->StudentCreated();
                        break;
                    case 'edit-siswa-baru':
                        $viewPendaftaran->StudentEdit();
                        break;
                    /* Pendaftaran akhir */ 

                    /* Jadwal */
                    case 'tambah-jadwal-jam':
                        $viewJadwal->JadwalCreate();
                        break;
                    case 'edit-jadwal-jam':
                        $viewJadwal->JadwalEdit();
                        break;
                    case 'hapus-jadwal-jam':
                        $viewJadwal->JadwalHapus();
                        break;
                    case 'tambah-jadwal-mapel':
                        $viewJadwal->SubjectJadwal();
                        break;
                    /* Jadwal Akhir */

                    /* Pelajaran */
                    case 'tambah-mapel':
                        $viewPelajaran->SubjectCreate();
                        break;
                    case 'edit-mapel':
                        $viewPelajaran->SubjectEdit();
                        break;
                    case 'hapus-pelajaran':
                        $viewPelajaran->SubjectHapus();
                        break;
                    /* Pelajaran Akhir*/  

                    /* Absensi */
                    case 'input-absensi':
                        $viewAbsensi->inputAbsensi();
                        break;
                    /* Absensi Akhir */

                    default:
                        require_once("../dashboard/index.php");
                        break;
                }
            }
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    </head>

    <body onload="startTime()">