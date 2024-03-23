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
        $id = htmlspecialchars($_POST["id_guru"]) ? htmlentities($_POST["id_guru"]) : $_POST["id_guru"];

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
        $id = htmlspecialchars($_POST["id_pelajaran"]) ? htmlentities($_POST["id_pelajaran"]) : $_POST["id_pelajaran"];
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
        $ekstensi_diperbolehkan_kk = array('pdf');
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        $x_kk = explode('.', $kk);
        $ekstensi_kk = strtolower(end($x_kk));
        $ukuran_kk = $_FILES['file_kk']['size'];
        $file_tmp_kk = $_FILES['file_kk']['tmp_name'];
        /* File Akte Lahir */
        $ekstensi_diperbolehkan_akte = array('pdf');
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        $x_akte = explode('.', $akte);
        $ekstensi_akte = strtolower(end($x_akte));
        $ukuran_akte = $_FILES['file_akte']['size'];
        $file_tmp_akte = $_FILES['file_akte']['tmp_name'];
        /* File Photo */
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif');
        $image = htmlspecialchars($_FILES["file_image"]["name"]);
        $x_foto = explode('.', $image);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['file_image']['size'];
        $file_tmp_foto = $_FILES['file_image']['tmp_name'];

        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;

        $table = "tb_pendaftaran";
        $sql = "INSERT INTO $table (nis,nama_lengkap,tempat_lahir,tanggal_lahir,agama,jumlah_saudara,alamat,nama_ayah,pekerjaan_ayah,telepon_ayah,nama_ibu,pekerjaan_ibu,telepon_ibu,file_kk,file_akte,file_image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $ab = array($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image);
        $row->execute($ab);

        if(in_array($ekstensi_kk, $ekstensi_diperbolehkan_kk) === true){
            if($ukuran_kk < 10440070){
                move_uploaded_file($file_tmp_kk, "../../../../assets/document/" . $kk);
                if(in_array($ekstensi_akte, $ekstensi_diperbolehkan_akte) === true){
                    if($ukuran_akte < 10440070){
                        move_uploaded_file($file_tmp_akte, "../../../../assets/document/" . $akte);                    
                        if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) === true){
                            if($ukuran_foto < 10440070){
                                move_uploaded_file($file_tmp_foto, "../../../../assets/image/" . $image);
                            }else{
                                echo "GAGAL MENGUPLOAD FILE FOTO";
                            }
                        }else{
                            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                        }
                    }else{
                        echo "GAGAL MENGUPLOAD FILE FOTO";
                    }
                }else{
                    echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                }
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }

    public function EditStudent($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image,$id){
        $id = htmlspecialchars($_POST["id_pendaftaran"]) ? htmlentities($_POST["id_pendaftaran"]) : $_POST["id_pendaftaran"];
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
        $ekstensi_diperbolehkan_kk = array('pdf');
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        $x_kk = explode('.', $kk);
        $ekstensi_kk = strtolower(end($x_kk));
        $ukuran_kk = $_FILES['file_kk']['size'];
        $file_tmp_kk = $_FILES['file_kk']['tmp_name'];
        /* File Akte Lahir */
        $ekstensi_diperbolehkan_akte = array('pdf');
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        $x_akte = explode('.', $akte);
        $ekstensi_akte = strtolower(end($x_akte));
        $ukuran_akte = $_FILES['file_akte']['size'];
        $file_tmp_akte = $_FILES['file_akte']['tmp_name'];
        /* File Photo */
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif');
        $image = htmlspecialchars($_FILES["file_image"]["name"]);
        $x_foto = explode('.', $image);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['file_image']['size'];
        $file_tmp_foto = $_FILES['file_image']['tmp_name'];

        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;

        $table = "tb_pendaftaran";
        $sql = "UPDATE $table SET nis = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, agama = ?, jumlah_saudara = ?, alamat = ?, nama_ayah = ?, pekerjaan_ayah = ?, telepon_ayah = ?, nama_ibu = ?, pekerjaan_ibu = ?, telepon_ibu = ?, file_kk = ?, file_akte = ?, file_image = ? WHERE id_pendaftaran = ?";
        $row = $this->db->prepare($sql);
        $ab = array($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image,$id);
        $row->execute($ab);

        if(in_array($ekstensi_kk, $ekstensi_diperbolehkan_kk) === true){
            if($ukuran_kk < 10440070){
                move_uploaded_file($file_tmp_kk, "../../../../assets/document/" . $kk);
                if(in_array($ekstensi_akte, $ekstensi_diperbolehkan_akte) === true){
                    if($ukuran_akte < 10440070){
                        move_uploaded_file($file_tmp_akte, "../../../../assets/document/" . $akte);                    
                        if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) === true){
                            if($ukuran_foto < 10440070){
                                move_uploaded_file($file_tmp_foto, "../../../../assets/image/" . $image);
                            }else{
                                echo "GAGAL MENGUPLOAD FILE FOTO";
                            }
                        }else{
                            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                        }
                    }else{
                        echo "GAGAL MENGUPLOAD FILE FOTO";
                    }
                }else{
                    echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
                }
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }

    public function DeleteStudent(){

    }

    public function SelectionStudent(){
        
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
        $sql = "SELECT * FROM $table ORDER BY id_pendaftaran ASC";
        $row = $this->db->prepare($sql);
        $row->execute();
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
        $id = htmlspecialchars($_POST["id_jam"]) ? htmlentities($_POST["id_jam"]) : $_POST["id_jam"];

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
}

// 11
/* Model Pesan */ 
class Message {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>