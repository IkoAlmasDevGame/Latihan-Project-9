<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Utama</title>
        <?php 
            session_start();
            require_once("../../controller/view.php");
            require_once("../../model/model.php");
            require_once("../../database/koneksi.php");
            require_once("../../config/authentication.php");
            require_once("../../config/config.php");

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
                        $table = "tb_pengguna";
                        $sql = "UPDATE $table SET created_End = ? WHERE nis = ?";
                        $row = $configs->prepare($sql);
                        $row->execute(array($created_end, $_SESSION['nis_pengguna']));
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

                    case 'jadwal':
                        require_once("../jadwal/index.php");
                        break;

                    case 'absensi':
                        require_once("../absensi/index.php");
                        break;
                                             
                    case 'pelajaran':
                        require_once("../pelajaran/index.php");
                        break;
                                                
                    case 'pesan':
                        require_once("../pesan/index.php");
                        break;
                        
                    case 'account':
                        require_once("../settings/index.php");
                        break;
                    
                    case 'raport':
                        require_once("../laporan/index.php");
                        break;
                                            
                    default:
                        require_once("../dashboard/index.php");
                        break;
                }
            }
        ?>
    </head>

    <body>