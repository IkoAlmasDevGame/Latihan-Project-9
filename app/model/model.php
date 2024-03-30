<?php 
namespace model;

// 1
/* Model Auth */ 
class Auth {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function AuthRead(){
        $table = "tb_user";
        $sql = "SELECT * FROM $table order by id_user asc";
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }

    public function AuthLoginSiswa(){
        $nisEmail = htmlspecialchars($_POST["nisEmail"]);
        $password = htmlspecialchars($_POST["password"]);
        password_verify($password, PASSWORD_DEFAULT);
        $date = Date('Y-m-d H:i:s a');

        if($nisEmail == "" || $password == ""){
            header("location:../auth/index.php");
            exit(0);
        }

        $table = "tb_pengguna";
        $sql = "SELECT * FROM $table WHERE nis = ? and password = ? || email='$nisEmail' and password='$password'";
        $dbAuth = $this->db->prepare($sql);
        $dbAuth->execute(array($nisEmail,$password));
        $cek = $dbAuth->rowCount();

        if($cek > 0){
            $b = array($nisEmail,$password,$date);
            $response[$table] = $b;
            if($row = $dbAuth->fetch()){
                if($row["user_level"] == "Siswa"){
                    $_SESSION["id"] = $row["id_pengguna"];
                    $_SESSION["email_pengguna"] = $row["email"];
                    $_SESSION["nama_pengguna"] = $row["nama"];
                    $_SESSION["nis_pengguna"] = $row["nis"];
                    $_SESSION["user_level"] = "Siswa";
                    $_SESSION["created_At"] = $row["created_At"];
                    $_SESSION["created_End"] = $date;
                    header("location:../ui/header.php?page=beranda&nis=".$_SESSION["nis_pengguna"]);
                }
                $_SESSION["status"] = true;
                array_push($response[$table], $row);
                $this->db->prepare("UPDATE $table SET created_End = ? WHERE username='$nisEmail'")->execute(array($date));
                $this->db->prepare("UPDATE $table SET created_End = ? WHERE email='$nisEmail'")->execute(array($date));
                exit(0);
            }else{
                $_SESSION["status"] = false;
                header("location:../auth/index.php");
                exit(0);                
            }
        }
    }

    public function AuthLogin($userMail, $password){
        $userMail = htmlspecialchars($_POST["userMail"]);
        $password = htmlspecialchars($_POST["password"]);
        password_verify($password, PASSWORD_DEFAULT);
        $date = Date('Y-m-d H:i:s a');

        if($userMail == "" || $password == ""){
            header("location:../auth/index.php");
            exit(0);
        }

        $table = "tb_user";
        $sql = "SELECT * FROM $table WHERE email = ? and password = ? || username='$userMail' and password='$password'";
        $dbAuth = $this->db->prepare($sql);
        $dbAuth->execute(array($userMail,$password));
        $cek = $dbAuth->rowCount();

        if($cek > 0){
            $b = array($userMail,$password,$date);
            $response[$table] = $b;
            if($row = $dbAuth->fetch()){
                if($row["user_level"] == "Admin"){
                    $_SESSION["id"] = $row["id_user"];
                    $_SESSION["email_pengguna"] = $row["email"];
                    $_SESSION["nama_pengguna"] = $row["nama"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["user_level"] = "Admin";
                    $_SESSION["created_At"] = $row["created_At"];
                    $_SESSION["created_End"] = $date;
                    header("location:../ui/header.php?page=beranda&nama=".$_SESSION["nama_pengguna"]);
                }
                $_SESSION["status"] = true;
                array_push($response[$table], $row);
                $this->db->prepare("UPDATE $table SET created_End = ? WHERE username='$userMail'")->execute(array($date));
                $this->db->prepare("UPDATE $table SET created_End = ? WHERE email='$userMail'")->execute(array($date));
                exit(0);
            }else{
                $_SESSION["status"] = false;
                header("location:../auth/index.php");
                exit(0);                
            }
        }
    }
}

// 2
/* Model Absensi */ 
class Absensi {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createInputAbsensi($kd_kelas,$tanggal){
        $kd_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST['id_kelas'];
        $tanggal = htmlspecialchars($_POST["tanggal"]) ? htmlentities($_POST["tanggal"]) : $_POST['tanggal'];

        if(isset($_POST["selesai"])){
            if(!empty($_POST["hadir"])){
                $kd_siswa = htmlspecialchars($_POST['hadir']) ? htmlentities($_POST['hadir']): $_POST['hadir'];
                $jumlah = count($kd_siswa);
                for($i = 0; $i < $jumlah; $i++){
                    $row = $this->db->prepare("INSERT INTO tb_absensi (id_siswa,id_kelas,keterangan,tanggal,selesai)
                     VALUES ('$kd_siswa[$i]','$kd_kelas','h','$tanggal','yes')");
                    $row->execute();
                }
            }
            if(!empty($_POST["sakit"])){
                $kd_siswa = htmlspecialchars($_POST['sakit']) ? htmlentities($_POST['sakit']): $_POST['sakit'];
                $jumlah = count($kd_siswa);
                for($i = 0; $i < $jumlah; $i++){
                    $row = $this->db->prepare("INSERT INTO tb_absensi (id_siswa,id_kelas,keterangan,tanggal,selesai)
                     VALUES ('$kd_siswa[$i]','$kd_kelas','s','$tanggal','yes')");
                    $row->execute();
                }
            }
            if(!empty($_POST["ijin"])){
                $kd_siswa = htmlspecialchars($_POST['ijin']) ? htmlentities($_POST['ijin']): $_POST['ijin'];
                $jumlah = count($kd_siswa);
                for($i = 0; $i < $jumlah; $i++){
                    $row = $this->db->prepare("INSERT INTO tb_absensi (id_siswa,id_kelas,keterangan,tanggal,selesai)
                     VALUES ('$kd_siswa[$i]','$kd_kelas','i','$tanggal','yes')");
                    $row->execute();
                }
            }
            if(!empty($_POST["alfa"])){
                $kd_siswa = htmlspecialchars($_POST['alfa']) ? htmlentities($_POST['alfa']): $_POST['alfa'];
                $jumlah = count($kd_siswa);
                for($i = 0; $i < $jumlah; $i++){
                    $row = $this->db->prepare("INSERT INTO tb_absensi (id_siswa,id_kelas,keterangan,tanggal,selesai)
                     VALUES ('$kd_siswa[$i]','$kd_kelas','a','$tanggal','yes')");
                    $row->execute();
                }
            }
        }else{
            unset($_POST["selesai"]);
            $nama = $_SESSION["nama_pengguna"];
            echo "<script lang='javascript'>location.href='../ui/header.php?page=absensi&nama=$nama&id_kelas=$kd_kelas';</script>";
        }
    }
}

// 3
/* Model Guru */ 
class Guru {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function readTeacher(){
        $table = "tb_guru";
        /* Read Teacher Database */ 
        $sql = "SELECT * FROM $table order by id_guru asc";
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }

    public function createTeacher($nip,$nama,$tanggal,$kelamin){
        $table = "tb_guru";
        $nip = htmlspecialchars($_POST["nip"]) ? htmlentities($_POST["nip"]) : $_POST["nip"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $tanggal = htmlspecialchars($_POST["tanggal_lahir"]) ? htmlentities($_POST["tanggal_lahir"]) : $_POST["tanggal_lahir"];
        $kelamin = htmlspecialchars($_POST["jeniskelamin"]) ? htmlentities($_POST["jeniskelamin"]) : $_POST["jeniskelamin"];

        /* Create Teacher Database */ 
        $sql = "INSERT INTO $table (nip,nama,tanggal_lahir,jeniskelamin) VALUES (?,?,?,?)";
        $row = $this->db->prepare($sql);
        $a_guru = array($nip,$nama,$tanggal,$kelamin);
        $row->execute($a_guru);
        return $row;
    }

    public function EditTeacher($nip,$nama,$tanggal,$kelamin,$id){
        $table = "tb_guru";
        $id = htmlspecialchars($_POST["id_guru"]) ? htmlentities($_POST["id_guru"]) : $_POST["id_guru"];
        $nip = htmlspecialchars($_POST["nip"]) ? htmlentities($_POST["nip"]) : $_POST["nip"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $tanggal = htmlspecialchars($_POST["tanggal_lahir"]) ? htmlentities($_POST["tanggal_lahir"]) : $_POST["tanggal_lahir"];
        $kelamin = htmlspecialchars($_POST["jeniskelamin"]) ? htmlentities($_POST["jeniskelamin"]) : $_POST["jeniskelamin"];

        /* Edit Teacher Database */ 
        $sql = "UPDATE $table SET nip = ?, nama = ?, tanggal_lahir = ?, jeniskelamin = ? WHERE id_guru = ?";
        $row = $this->db->prepare($sql);
        $a_guru = array($nip,$nama,$tanggal,$kelamin,$id);
        $row->execute($a_guru);
        return $row;
    }

    public function DeleteTeacher($id){
        $table = "tb_guru";
        $id = htmlspecialchars($_GET["id_guru"]) ? htmlentities($_GET["id_guru"]) : $_GET["id_guru"];

        /* Hapus Teacher Database */ 
        $sql = "DELETE FROM $table WHERE id_guru = ?";
        $row = $this->db->prepare($sql);
        $a_guru = array($id);
        $row->execute($a_guru);
        return $row;
    }

    public function ReadEditTeacher($id){
        $table = "tb_guru";
        $id = htmlspecialchars($_GET["id_guru"]) ? htmlentities($_GET["id_guru"]) : $_GET["id_guru"];

        /* Read Teacher Database */
        $sql = "SELECT * FROM $table WHERE id_guru = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        return $row;
    }
}

// 4
/* Model Kelas */ 
class Kelas {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function readClass(){
        $table = "tb_kelas";
        $sql = "SELECT * FROM $table Order by id_kelas asc";
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }
}

// 5
/* Model Pelajaran */ 
class Pelajaran {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createsubject($mapel,$create_date){
        $mapel = htmlspecialchars($_POST["pelajaran"]) ? htmlentities($_POST["pelajaran"]) : $_POST["pelajaran"];
        $create_date = Date('d-m-Y');
        /* Create Table Save */
        $table = "tb_pelajaran";
        $sql = "INSERT INTO $table (pelajaran,create_timestamp) VALUES (?,?)"; 
        $row = $this->db->prepare($sql);
        $row->execute(array($mapel,$create_date));
        return $row;
    }

    public function editSubject($mapel,$id){
        $id = htmlspecialchars($_POST["id_pelajaran"]) ? htmlentities($_POST["id_pelajaran"]) : $_POST["id_pelajaran"];
        $mapel = htmlspecialchars($_POST["pelajaran"]) ? htmlentities($_POST["pelajaran"]) : $_POST["pelajaran"];
        /* Create Table Save */
        $table = "tb_pelajaran";
        $sql = "UPDATE $table SET pelajaran = ? WHERE id_pelajaran = ?"; 
        $row = $this->db->prepare($sql);
        $row->execute(array($mapel,$id));
        return $row;
    }
    
    public function readsubject(){
        /* Table Read */
        $table = "tb_pelajaran";
        $sql = "SELECT * FROM $table Order by id_pelajaran asc"; 
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }
    
    public function readsubjectedit($id){
        $id = htmlspecialchars($_GET["id"]) ? htmlentities($_GET['id']) : $_GET['id'];
        /* Table Read */
        $table = "tb_pelajaran";
        $sql = "SELECT * FROM $table WHERE id_pelajaran = ?"; 
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        return $row;
    }

    public function deleteSubject($id){
        $id = htmlspecialchars($_GET["id_pelajaran"]) ? htmlentities($_GET["id_pelajaran"]) : $_GET["id_pelajaran"];
        $table = "tb_pelajaran";
        $sql = "DELETE FROM $table WHERE id_pelajaran = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        return $row;
    }
}

// 6
/* Model Pembayaran */ 
class Pembayaran {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function GetPembayaran($id_kelas){
        $id_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
        $sql = "SELECT tb_siswa.*, tb_kelas.id_kelas, tb_kelas.namakelas, tb_pendaftaran.id_siswa, tb_pendaftaran.nama_lengkap FROM tb_siswa inner join tb_kelas on tb_siswa.id_kelas = tb_kelas.id_kelas inner join tb_pendaftaran on tb_siswa.id_siswa = tb_pendaftaran.id_siswa WHERE tb_siswa.id_kelas = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id_kelas));
        return $row;
    }
    
    public function pembayaranSiswa($id_siswa,$id_kelas,$bulan,$tanggal,$total,$selesai){
        $id_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
        $id_siswa = htmlspecialchars($_POST["id_siswa"]) ? htmlentities($_POST["id_siswa"]) : $_POST["id_siswa"];
        $bulan = htmlspecialchars($_POST["bulan_input"]) ? htmlentities($_POST["bulan_input"]) : $_POST["bulan_input"];
        $tanggal = htmlspecialchars($_POST["tanggal_input"]) ? htmlentities($_POST["tanggal_input"]) : $_POST["tanggal_input"];
        $total = htmlspecialchars($_POST["total"]) ? htmlentities($_POST["total"]) : $_POST["total"];
        $selesai = "yes";

        $table = "tb_pembayaran";
        $sql = "INSERT INTO $table (id_siswa,id_kelas,bulan_input,tanggal_input,total,selesai) VALUES (?,?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($id_siswa,$id_kelas,$bulan,$tanggal,$total,$selesai));
        return $row;
    }
}

// 7
/* Model Pendaftaran */ 
class Pendaftaran {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function CreateStudent($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image){
        $nis = htmlspecialchars($_POST["nis"]) ? htmlentities($_POST["nis"]) : $_POST["nis"];
        $nama = htmlspecialchars($_POST["nama_lengkap"]) ? htmlentities($_POST["nama_lengkap"]) : $_POST["nama_lengkap"];
        $tempat = htmlspecialchars($_POST["tempat_lahir"]) ? htmlentities($_POST["tempat_lahir"]) : $_POST["tempat_lahir"];
        $tanggal = htmlspecialchars($_POST["tanggal"]) ? htmlentities($_POST["tanggal"]) : $_POST["tanggal"];
        $bulan = htmlspecialchars($_POST["bulan_lahir"]) ? htmlentities($_POST["bulan_lahir"]) : $_POST["bulan_lahir"];
        $tahun = htmlspecialchars($_POST["tahun_lahir"]) ? htmlentities($_POST["tahun_lahir"]) : $_POST["tahun_lahir"];
        $agama = htmlspecialchars($_POST["agama"]) ? htmlentities($_POST["agama"]) : $_POST["agama"];
        $saudara = htmlspecialchars($_POST["jumlah_saudara"]) ? htmlentities($_POST["jumlah_saudara"]) : $_POST["jumlah_saudara"];
        $alamat = htmlspecialchars($_POST["alamat"]) ? htmlentities($_POST["alamat"]) : $_POST["alamat"];
        /* Data Orang Tua */
        $nama_ayah = htmlspecialchars($_POST["nama_ayah"]) ? htmlentities($_POST["nama_ayah"]) : $_POST["nama_ayah"];
        $pekerjaan_ayah = htmlspecialchars($_POST["pekerjaan_ayah"]) ? htmlentities($_POST["pekerjaan_ayah"]) : $_POST["pekerjaan_ayah"];
        $telepon_ayah = htmlspecialchars($_POST["telepon_ayah"]) ? htmlentities($_POST["telepon_ayah"]) : $_POST["telepon_ayah"];
        $nama_ibu = htmlspecialchars($_POST["nama_ibu"]) ? htmlentities($_POST["nama_ibu"]) : $_POST["nama_ibu"];
        $pekerjaan_ibu = htmlspecialchars($_POST["pekerjaan_ibu"]) ? htmlentities($_POST["pekerjaan_ibu"]) : $_POST["pekerjaan_ibu"];
        $telepon_ibu = htmlspecialchars($_POST["telepon_ibu"]) ? htmlentities($_POST["telepon_ibu"]) : $_POST["telepon_ibu"];
        /* Data Document */
        /* File Kartu Keluarga */
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        /* File Akte Lahir */
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        /* File Photo */
        $image = htmlspecialchars($_FILES["file_image"]["name"]);

        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;

        $table = "tb_pendaftaran";
        $sql = "INSERT INTO $table (nis,nama_lengkap,tempat_lahir,tanggal_lahir,agama,jumlah_saudara,alamat,nama_ayah,pekerjaan_ayah,telepon_ayah,nama_ibu,pekerjaan_ibu,telepon_ibu,file_kk,file_akte,file_image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $ab = array($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image);
        $row->execute($ab);

        $email = $nis."@sekolah.com";
        $password = $tanggal."-".$bulan."-".$tahun;
        $user_level = "Siswa";
        $created_at = Date('Y-m-d H:i:s a');
        $created_end = Date('Y-m-d H:i:s a');
        $this->db->prepare("INSERT INTO tb_pengguna (nis,email,password,nama,user_level,created_At,create_end)
         VALUES (?,?,?,?,?,?,?)")->execute(array($nis, $email, $password, $nama,$user_level, $created_at, $created_end));
        return $row;
    }

    public function EditStudent($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image,$id){
        $id = htmlspecialchars($_POST["id_siswa"]) ? htmlentities($_POST["id_siswa"]) : $_POST["id_siswa"];
        $nis = htmlspecialchars($_POST["nis"]) ? htmlentities($_POST["nis"]) : $_POST["nis"];
        $nama = htmlspecialchars($_POST["nama_lengkap"]) ? htmlentities($_POST["nama_lengkap"]) : $_POST["nama_lengkap"];
        $tempat = htmlspecialchars($_POST["tempat_lahir"]) ? htmlentities($_POST["tempat_lahir"]) : $_POST["tempat_lahir"];
        $tanggal = htmlspecialchars($_POST["tanggal"]) ? htmlentities($_POST["tanggal"]) : $_POST["tanggal"];
        $bulan = htmlspecialchars($_POST["bulan_lahir"]) ? htmlentities($_POST["bulan_lahir"]) : $_POST["bulan_lahir"];
        $tahun = htmlspecialchars($_POST["tahun_lahir"]) ? htmlentities($_POST["tahun_lahir"]) : $_POST["tahun_lahir"];
        $agama = htmlspecialchars($_POST["agama"]) ? htmlentities($_POST["agama"]) : $_POST["agama"];
        $saudara = htmlspecialchars($_POST["jumlah_saudara"]) ? htmlentities($_POST["jumlah_saudara"]) : $_POST["jumlah_saudara"];
        $alamat = htmlspecialchars($_POST["alamat"]) ? htmlentities($_POST["alamat"]) : $_POST["alamat"];
        /* Data Orang Tua */
        $nama_ayah = htmlspecialchars($_POST["nama_ayah"]) ? htmlentities($_POST["nama_ayah"]) : $_POST["nama_ayah"];
        $pekerjaan_ayah = htmlspecialchars($_POST["pekerjaan_ayah"]) ? htmlentities($_POST["pekerjaan_ayah"]) : $_POST["pekerjaan_ayah"];
        $telepon_ayah = htmlspecialchars($_POST["telepon_ayah"]) ? htmlentities($_POST["telepon_ayah"]) : $_POST["telepon_ayah"];
        $nama_ibu = htmlspecialchars($_POST["nama_ibu"]) ? htmlentities($_POST["nama_ibu"]) : $_POST["nama_ibu"];
        $pekerjaan_ibu = htmlspecialchars($_POST["pekerjaan_ibu"]) ? htmlentities($_POST["pekerjaan_ibu"]) : $_POST["pekerjaan_ibu"];
        $telepon_ibu = htmlspecialchars($_POST["telepon_ibu"]) ? htmlentities($_POST["telepon_ibu"]) : $_POST["telepon_ibu"];
        /* Data Document */
        /* File Kartu Keluarga */
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        /* File Akte Lahir */
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        /* File Photo */
        $image = htmlspecialchars($_FILES["file_image"]["name"]);

        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;

        $table = "tb_pendaftaran";
        $sql = "UPDATE $table SET nis = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, agama = ?, jumlah_saudara = ?, alamat = ?, nama_ayah = ?, pekerjaan_ayah = ?, telepon_ayah = ?, nama_ibu = ?, pekerjaan_ibu = ?, telepon_ibu = ?, file_kk = ?, file_akte = ?, file_image = ? WHERE id_siswa = ?";
        $row = $this->db->prepare($sql);
        $ab = array($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image,$id);
        $row->execute($ab);
        return $row;
    }

    public function PilihStudent($id){
        $table = "tb_pendaftaran";
        $id = htmlspecialchars($_GET["id_siswa"]) ? htmlentities($_GET["id_siswa"]) : $_GET["id_siswa"];
        $sql = "SELECT * FROM $table WHERE id_siswa = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        return $row;

    }

    public function DeleteStudent($id){
        $id = htmlspecialchars($_GET["id_siswa"]) ? htmlentities($_GET["id_siswa"]) : $_GET["id_siswa"];
        $sql = "SELECT * FROM tb_pendaftaran WHERE id_siswa = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        /* Hapus Tembak */ 
        $iHasil = $row->fetch();
        $ii = $iHasil['nis'];
        $sql_2 = "DELETE FROM tb_pengguna WHERE nis = ?";
        $sql_3 = "DELETE FROM tb_siswa WHERE id_siswa = ?";
        $sql_4 = "DELETE FROM tb_pendaftaran WHERE id_siswa = ?";
        $row = $this->db->prepare($sql_2)->execute(array($ii));
        $row = $this->db->prepare($sql_3)->execute(array($iHasil['id_siswa']));
        $row = $this->db->prepare($sql_4)->execute(array($iHasil['id_siswa']));
        return $row;
    }
}

// 8
/* Model Account-Settings */ 
class Account {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function AuthRegister($email,$username,$password,$nama,$user_level){
        $email = htmlspecialchars($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $nama = htmlspecialchars($_POST["nama"]);
        $user_level = htmlspecialchars($_POST["user_level"]);
        $created_at = Date("Y-m-d H:i:s a");
        $created_end = Date("Y-m-d H:i:s a");

        /* Create Table user */ 
        $table = "tb_user";
        $sql = "INSERT INTO $table (email,username,password,nama,user_level,created_At,created_End) VALUES (?,?,?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $a_register = array($email,$username,$password,$nama,$user_level,$created_at,$created_end);
        $row->execute($a_register);
    }

    public function AuthEdited($email,$username,$password,$nama,$user_level){
        $email = htmlspecialchars($_POST["email"]) ? htmlentities($_POST["email"]) : $_POST["email"];
        $username = htmlspecialchars($_POST["username"]) ? htmlentities($_POST["username"]) : $_POST["username"];
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : $_POST["password"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $user_level = htmlspecialchars($_POST["user_level"]) ? htmlentities($_POST["user_level"]) : $_POST["user_level"];
        
        $table = "tb_user";
        $sql = "UPDATE $table SET email = ?, username = ?, password = ?, user_level = ? WHERE nama = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($email,$username,$password,$nama,$user_level));
    }
}

// 9
/* Model Siswa */ 
class Siswa {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ReadStudent(){
        $table = "tb_pendaftaran";
        $sql = "SELECT * FROM $table ORDER BY id_siswa ASC";
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }

    public function createData($id_siswa, $id_kelas){
        $id_siswa = htmlspecialchars($_POST["id_siswa"]) ? htmlentities($_POST["id_siswa"]) : $_POST["id_siswa"];
        $id_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
        $table = "tb_siswa";
        $sql = "INSERT INTO $table (id_siswa,id_kelas) VALUES (?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($id_siswa,$id_kelas));
        return $row;
    }

    public function UpdateData($id_kelas, $id_siswa){
        $id_siswa = htmlspecialchars($_POST["id_siswa"]) ? htmlentities($_POST["id_siswa"]) : $_POST["id_siswa"];
        $id_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
        $table = "tb_siswa";
        $sql = "UPDATE $table SET id_kelas = ? WHERE id_siswa = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id_kelas,$id_siswa));
        return $row;
    }
}

// 10
/* Model Jadwal */ 
class Jadwal {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createJadwal($jam,$mulai,$akhir){
        $jam = htmlspecialchars($_POST["jam"]) ? htmlentities($_POST["jam"]) : $_POST["jam"];
        $mulai = htmlspecialchars($_POST["mulai"]) ? htmlentities($_POST["mulai"]) : $_POST["mulai"];
        $akhir = htmlspecialchars($_POST["akhir"]) ? htmlentities($_POST["akhir"]) : $_POST["akhir"];

        /* Create Table Database */
        $table = "tb_jam";
        $sql = "INSERT INTO $table (jam,mulai,akhir) VALUES (?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($jam,$mulai,$akhir));
    }
    
    public function EditJadwal($jam,$mulai,$akhir,$id){
        $id = htmlspecialchars($_POST["id_jam"]) ? htmlentities($_POST["id_jam"]) : $_POST["id_jam"];
        $jam = htmlspecialchars($_POST["jam"]) ? htmlentities($_POST["jam"]) : $_POST["jam"];
        $mulai = htmlspecialchars($_POST["mulai"]) ? htmlentities($_POST["mulai"]) : $_POST["mulai"];
        $akhir = htmlspecialchars($_POST["akhir"]) ? htmlentities($_POST["akhir"]) : $_POST["akhir"];

        /* Create Table Database */
        $table = "tb_jam";
        $sql = "UPDATE $table SET jam = ?, mulai = ?, akhir = ? WHERE id_jam = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($jam,$mulai,$akhir,$id));
    }

    public function DeleteJadwal($id){
        $id = htmlspecialchars($_GET["id_jam"]) ? htmlentities($_GET["id_jam"]) : $_GET["id_jam"];

        /* Create Table Database */
        $table = "tb_jam";
        $sql = "DELETE FROM $table WHERE id_jam = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
    }
    
    public function Jadwal(){
        /* Create Table Database */
        $table = "tb_jam";
        $sql = "SELECT * FROM $table Order By id_jam asc";
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }

    public function PilihEditJadwal($id){
        $id = htmlspecialchars($_GET["id_jam"]) ? htmlentities($_GET["id_jam"]) : $_GET["id_jam"];
        $table = "tb_jam";
        $sql = "SELECT * FROM $table WHERE id_jam = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        return $row;
    }

    public function SubJadwal($id_jadwal,$id_guru,$id_kelas,$id_jam,$id_pelajaran,$hari){
        $id_jadwal = htmlspecialchars($_POST["id_jadwal"]) ? htmlentities($_POST["id_jadwal"]) : $_POST["id_jadwal"];
        $id_guru = htmlspecialchars($_POST["id_guru"]) ? htmlentities($_POST["id_guru"]) : $_POST["id_guru"];
        $id_kelas = htmlspecialchars($_POST["id_kelas"]) ? htmlentities($_POST["id_kelas"]) : $_POST["id_kelas"];
        $id_jam = htmlspecialchars($_POST["id_jam"]) ? htmlentities($_POST["id_jam"]) : $_POST["id_jam"];
        $id_pelajaran = htmlspecialchars($_POST["id_pelajaran"]) ? htmlentities($_POST["id_pelajaran"]) : $_POST["id_pelajaran"];
        $hari = htmlspecialchars($_POST["hari"]) ? htmlentities($_POST["hari"]) : $_POST["hari"];

        if(empty($id_guru)){
            $sql = "SELECT count(*) as total from tb_jadwal where id_jadwal = ?";
            $select = $this->db->prepare($sql);
            $select->execute(array($id_jadwal));
            $tHasil = $select->fetch();
            
            if($tHasil['total'] > 0){
                $row = $this->db->prepare("UPDATE tb_jadwal SET id_pelajaran = ?, id_jam = ?, hari = ? where id_jadwal = ?");
                $row->execute(array($id_pelajaran,$id_jam,$hari,$id_jadwal));
            }else{
                $row = $this->db->prepare("INSERT INTO tb_jadwal (id_pelajaran,id_jam,hari,id_kelas) VALUES (?,?,?,?)");
                $row->execute(array($id_pelajaran,$id_jam,$hari,$id_kelas));
            }
        }else{
            if(empty($id_jadwal)){
                $_SESSION["gagal"] = "isi terlebih dahulu mata pelajaran";
            }else{
                $sql_2 = "SELECT COUNT(*) as total FROM tb_jawdal inner join tb_kelas on tb_kelas.id_kelas = tb_jadwal.id_kelas where id_guru = ? && id_jam = ? && hari = ?";
                $select_2 = $this->db->prepare($sql_2);
                $select_2->execute(array($id_guru,$id_jam,$hari));
                $tHasili = $select_2->fetch();

                if($tHasili['total'] > 0){
                    $get_data = $this->db->prepare("SELECT COUNT(*) as total FROM tb_jawdal inner join tb_kelas on tb_kelas.id_kelas = tb_jadwal.id_kelas where id_guru = ? && id_jam = ? && hari = ?");
                    $get_data->execute(array($id_guru,$id_jam,$hari));
                    $cek_data = $get_data->fetch();
                    $_SESSION["gagal"] = 'Guru Sudah Mengisi di Kelas '.$cek_data['namakelas'];
                }else{
                    $row = $this->db->prepare("UPDATE tb_jadwal SET id_guru = ? WHERE id_jadwal = ?");
                    $row->execute(array($id_guru,$id_jadwal));
                }
            }
        }   
    }
}

// 11
/* Model Pesan */ 
class Message {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function SendMessage($from,$to,$subject,$message){
        $table = "tb_pesan";
        $from = htmlspecialchars($_POST['toFrom']) ? htmlentities($_POST["toFrom"]) : $_POST["toFrom"];
        $to = htmlspecialchars($_POST['toTo']) ? htmlentities($_POST["toTo"]) : $_POST["toTo"];
        $subject = htmlspecialchars($_POST['toSubject']) ? htmlentities($_POST["toSubject"]) : $_POST["toSubject"];
        $message = htmlspecialchars($_POST['toMessage']) ? htmlentities($_POST["toMessage"]) : $_POST["toMessage"];

        if($from == "" || $to == "" || $subject == "" || $message == ""){
            echo "<script lang='javascript'>location.href='../ui/header.php?page=pesan&email=$from'</script>";
            exit(0);
        }
        
        $sql = "INSERT INTO $table (toFrom,toTo,toSubject,toMessage) VALUES (?,?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($from,$to,$subject,$message));
    }

    public function ReplyMessage($from,$to,$subject,$message){
        $table = "tb_pesan";
        $from = htmlspecialchars($_POST['toFrom']) ? htmlentities($_POST["toFrom"]) : $_POST["toFrom"];
        $to = htmlspecialchars($_POST['toTo']) ? htmlentities($_POST["toTo"]) : $_POST["toTo"];
        $subject = htmlspecialchars($_POST['toSubject']) ? htmlentities($_POST["toSubject"]) : $_POST["toSubject"];
        $message = htmlspecialchars($_POST['toMessage']) ? htmlentities($_POST["toMessage"]) : $_POST["toMessage"];

        if($from == "" || $to == "" || $subject == "" || $message == ""){
            echo "<script lang='javascript'>location.href='../ui/header.php?page=pesan&email=$from'</script>";
            exit(0);
        }
        
        $sql = "INSERT INTO $table (toFrom,toTo,toSubject,toMessage) VALUES (?,?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($from,$to,$subject,$message));
    }

    public function EditMessage($from,$to,$subject,$message,$id){
        $table = "tb_pesan";
        $id = htmlspecialchars($_POST['id_pesan']) ? htmlentities($_POST["id_pesan"]) : $_POST["id_pesan"];
        $from = htmlspecialchars($_POST['toFrom']) ? htmlentities($_POST["toFrom"]) : $_POST["toFrom"];
        $to = htmlspecialchars($_POST['toTo']) ? htmlentities($_POST["toTo"]) : $_POST["toTo"];
        $subject = htmlspecialchars($_POST['toSubject']) ? htmlentities($_POST["toSubject"]) : $_POST["toSubject"];
        $message = htmlspecialchars($_POST['toMessage']) ? htmlentities($_POST["toMessage"]) : $_POST["toMessage"];

        if($from == "" || $to == "" || $subject == "" || $message == "" || $id == ""){
            echo "<script lang='javascript'>location.href='../ui/header.php?page=pesan&email=$from'</script>";
            exit(0);
        }

        $sql = "UPDATE $table SET toFrom = ?, toTo = ?, toSubject = ?, toMessage = ? WHERE id_pesan = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($from,$to,$subject,$message,$id));
    }

    public function DeleteMessage($id_pesan){
        $id_pesan = htmlspecialchars($_GET['id']) ? htmlentities($_GET["id"]) : $_GET["id"];
        $sql = "DELETE FROM tb_pesan WHERE id_pesan = ?";
        $row = $this->db->prepare($sql);
        $id = array($id_pesan);
        $row->execute($id);
    }
}
?>