<?php 
namespace view;

use model\Auth;
class ViewAuth {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Auth($db);
    }
    
    public function Login(){
        session_start();
        $userMail = htmlspecialchars($_POST["userMail"]) ? htmlentities($_POST["userMail"]) : $_POST["userMail"];
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : $_POST["password"];
        password_verify($password, PASSWORD_DEFAULT);
        $this->konfig->AuthLogin($userMail,$password);
    }

    public function Read(){
        $row = $this->konfig->AuthRead();
        $hasil = $row->fetchAll();
        return $hasil;
    }
}

use model\Absensi;
class ViewAbsensi {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Absensi($db);
    }
}

use model\Guru;
class ViewGuru {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Guru($db);
    }
    
    public function TeacherRead(){
        $row = $this->konfig->readTeacher();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function TeacherEditRead($id){
        $id = htmlspecialchars($_GET["id_guru"]) ? htmlentities($_GET["id_guru"]) : $_GET["id_guru"];
        $row = $this->konfig->ReadEditTeacher($id);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function TeacherCreate(){
        $nip = htmlspecialchars($_POST["nip"]) ? htmlentities($_POST["nip"]) : $_POST["nip"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $tanggal = htmlspecialchars($_POST["tanggal_lahir"]) ? htmlentities($_POST["tanggal_lahir"]) : $_POST["tanggal_lahir"];
        $kelamin = htmlspecialchars($_POST["jeniskelamin"]) ? htmlentities($_POST["jeniskelamin"]) : $_POST["jeniskelamin"];
        $this->konfig->createTeacher($nip,$nama,$tanggal,$kelamin);
        $namas = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=guru&nama=$namas'</script>";
    }

    public function TeacherEdit(){
        $id = htmlspecialchars($_POST["id_guru"]) ? htmlentities($_POST["id_guru"]) : $_POST["id_guru"];
        $nip = htmlspecialchars($_POST["nip"]) ? htmlentities($_POST["nip"]) : $_POST["nip"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $tanggal = htmlspecialchars($_POST["tanggal_lahir"]) ? htmlentities($_POST["tanggal_lahir"]) : $_POST["tanggal_lahir"];
        $kelamin = htmlspecialchars($_POST["jeniskelamin"]) ? htmlentities($_POST["jeniskelamin"]) : $_POST["jeniskelamin"];
        $this->konfig->EditTeacher($nip,$nama,$tanggal,$kelamin,$id);
        $namas = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=guru&nama=$namas'</script>";
    }

    public function TeacherDelete(){
        $id = htmlspecialchars($_POST["id_guru"]) ? htmlentities($_POST["id_guru"]) : $_POST["id_guru"];
        $this->konfig->DeleteTeacher($id);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=guru&nama=$nama'</script>";
    }
}

use model\Kelas;
class ViewKelas {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Kelas($db);
    }

    public function read(){
        $row = $this->konfig->readClass();
        $hasil = $row->fetchAll();
        return $hasil;
    }
}

use model\Pelajaran;
class ViewPelajaran {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Pelajaran($db);
    }

    public function SubjectCreate(){
        $mapel = htmlspecialchars($_POST["pelajaran"]) ? htmlentities($_POST["pelajaran"]) : $_POST["pelajaran"];
        $create_date = Date('d-m-Y');
        $this->konfig->createsubject($mapel,$create_date);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=pelajaran&nama=$nama'</script>";
    }

    public function SubjectEdit(){
        $id = htmlspecialchars($_POST["id_pelajaran"]) ? htmlentities($_POST["id_pelajaran"]) : $_POST["id_pelajaran"];
        $mapel = htmlspecialchars($_POST["pelajaran"]) ? htmlentities($_POST["pelajaran"]) : $_POST["pelajaran"];
        $this->konfig->editSubject($mapel,$id);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=pelajaran&nama=$nama'</script>";
    }
    
    public function SubjectRead(){
        $row = $this->konfig->readsubject();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function SubjectReadEdit($id){
        $id = htmlspecialchars($_GET["id"]) ? htmlentities($_GET['id']) : $_GET['id'];
        $row = $this->konfig->readsubjectedit($id);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function SubjectHapus(){
        $id = htmlspecialchars($_POST["id_pelajaran"]) ? htmlentities($_POST["id_pelajaran"]) : $_POST["id_pelajaran"];
        $row = $this->konfig->deleteSubject($id);
        $hasil = $row->fetch();
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=pelajaran&nama=$nama'</script>";
        return $hasil;
    }
}

use model\Pembayaran;
class ViewPembayaran {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Pembayaran($db);
    }
}

use model\Pendaftaran;
class ViewPendaftaran {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Pendaftaran($db);
    }

    public function StudentCreated(){
        $nis = htmlspecialchars($_POST["nis"]) ? htmlentities($_POST["nis"]) : $_POST["nis"];
        $nama = htmlspecialchars($_POST["nama_lengkap"]) ? htmlentities($_POST["nama_lengkap"]) : $_POST["nama_lengkap"];
        $tempat = htmlspecialchars($_POST["tempat_lahir"]) ? htmlentities($_POST["tempat_lahir"]) : $_POST["tempat_lahir"];
        $tanggal = htmlspecialchars($_POST["tanggal"]) ? htmlentities($_POST["tanggal"]) : $_POST["tanggal"];
        $bulan = htmlspecialchars($_POST["bulan_lahir"]) ? htmlentities($_POST["bulan_lahir"]) : $_POST["bulan_lahir"];
        $tahun = htmlspecialchars($_POST["tahun_lahir"]) ? htmlentities($_POST["tahun_lahir"]) : $_POST["tahun_lahir"];
        $agama = htmlspecialchars($_POST["agama"]) ? htmlentities($_POST["agama"]) : $_POST["agama"];
        $saudara = htmlspecialchars($_POST["jumlah_saudara"]) ? htmlentities($_POST["jumlah_saudara"]) : $_POST["jumlah_saudara"];
        $alamat = htmlspecialchars($_POST["alamat"]) ? htmlentities($_POST["alamat"]) : $_POST["alamat"];
        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;
        /* Data Orang Tua */
        $nama_ayah = htmlspecialchars($_POST["nama_ayah"]) ? htmlentities($_POST["nama_ayah"]) : $_POST["nama_ayah"];
        $pekerjaan_ayah = htmlspecialchars($_POST["pekerjaan_ayah"]) ? htmlentities($_POST["pekerjaan_ayah"]) : $_POST["pekerjaan_ayah"];
        $telepon_ayah = htmlspecialchars($_POST["telepon_ayah"]) ? htmlentities($_POST["telepon_ayah"]) : $_POST["telepon_ayah"];
        $nama_ibu = htmlspecialchars($_POST["nama_ibu"]) ? htmlentities($_POST["nama_ibu"]) : $_POST["nama_ibu"];
        $pekerjaan_ibu = htmlspecialchars($_POST["pekerjaan_ibu"]) ? htmlentities($_POST["pekerjaan_ibu"]) : $_POST["pekerjaan_ibu"];
        $telepon_ibu = htmlspecialchars($_POST["telepon_ibu"]) ? htmlentities($_POST["telepon_ibu"]) : $_POST["telepon_ibu"]; 
        /* File Kartu Keluarga */
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        /* File Akte Lahir */
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        /* File Photo */
        $image = htmlspecialchars($_FILES["file_image"]["name"]);
        $this->konfig->CreateStudent($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image);
        $namas = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=list-siswa&nama=$namas&act_seleksi=yes'</script>";
    }

    public function StudentEdit(){
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
        $tanggal_lahir = $tanggal."-".$bulan."-".$tahun;
        /* Data Orang Tua */
        $nama_ayah = htmlspecialchars($_POST["nama_ayah"]) ? htmlentities($_POST["nama_ayah"]) : $_POST["nama_ayah"];
        $pekerjaan_ayah = htmlspecialchars($_POST["pekerjaan_ayah"]) ? htmlentities($_POST["pekerjaan_ayah"]) : $_POST["pekerjaan_ayah"];
        $telepon_ayah = htmlspecialchars($_POST["telepon_ayah"]) ? htmlentities($_POST["telepon_ayah"]) : $_POST["telepon_ayah"];
        $nama_ibu = htmlspecialchars($_POST["nama_ibu"]) ? htmlentities($_POST["nama_ibu"]) : $_POST["nama_ibu"];
        $pekerjaan_ibu = htmlspecialchars($_POST["pekerjaan_ibu"]) ? htmlentities($_POST["pekerjaan_ibu"]) : $_POST["pekerjaan_ibu"];
        $telepon_ibu = htmlspecialchars($_POST["telepon_ibu"]) ? htmlentities($_POST["telepon_ibu"]) : $_POST["telepon_ibu"]; 
        /* File Kartu Keluarga */
        $kk = htmlspecialchars($_FILES["file_kk"]["name"]);
        /* File Akte Lahir */
        $akte = htmlspecialchars($_FILES["file_akte"]["name"]);
        /* File Photo */
        $image = htmlspecialchars($_FILES["file_image"]["name"]);
        $this->konfig->EditStudent($nis, $nama, $tempat,$tanggal_lahir,$agama,$saudara,$alamat,$nama_ayah,
        $pekerjaan_ayah,$telepon_ayah,$nama_ibu,$pekerjaan_ibu,$telepon_ibu,$kk,$akte,$image,$id);
        $namas = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=list-siswa&nama=$namas'</script>";
    }
}

use model\Account;
class ViewAccount {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Account($db);
    }

    public function Register(){
        $email = htmlspecialchars($_POST["email"]) ? htmlentities($_POST["email"]) : $_POST["email"];
        $username = htmlspecialchars($_POST["username"]) ? htmlentities($_POST["username"]) : $_POST["username"];
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : $_POST["password"];
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : $_POST["nama"];
        $user_level = htmlspecialchars($_POST["user_level"]) ? htmlentities($_POST["user_level"]) : $_POST["user_level"];
        $this->konfig->AuthRegister($email,$username,$password,$nama,$user_level);
        $namas = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=akun&nama=$namas'</script>";
    }
}

use model\Siswa;
class ViewSiswa {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Siswa($db);
    }

    public function StudentRead(){
        $row = $this->konfig->ReadStudent();
        $hasil = $row->fetchAll();
        return $hasil;

    }
}

use model\Jadwal;
class ViewJadwal {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Jadwal($db);
    }

    public function JadwalCreate(){
        $jam = htmlspecialchars($_POST["jam"]) ? htmlentities($_POST["jam"]) : $_POST["jam"];
        $mulai = htmlspecialchars($_POST["mulai"]) ? htmlentities($_POST["mulai"]) : $_POST["mulai"];
        $akhir = htmlspecialchars($_POST["akhir"]) ? htmlentities($_POST["akhir"]) : $_POST["akhir"];
        $this->konfig->createJadwal($jam,$mulai,$akhir);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=jadwal&nama=$nama'</script>";
    }

    public function JadwalEdit(){
        $id = htmlspecialchars($_POST["id_jam"]) ? htmlentities($_POST["id_jam"]) : $_POST["id_jam"];
        $jam = htmlspecialchars($_POST["jam"]) ? htmlentities($_POST["jam"]) : $_POST["jam"];
        $mulai = htmlspecialchars($_POST["mulai"]) ? htmlentities($_POST["mulai"]) : $_POST["mulai"];
        $akhir = htmlspecialchars($_POST["akhir"]) ? htmlentities($_POST["akhir"]) : $_POST["akhir"];
        $this->konfig->EditJadwal($jam,$mulai,$akhir,$id);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=jadwal&nama=$nama'</script>";
    }

    public function JadwalHapus(){
        $id = htmlspecialchars($_POST["id_jam"]) ? htmlentities($_POST["id_jam"]) : $_POST["id_jam"];
        $this->konfig->DeleteJadwal($id);
        $nama = $_SESSION['nama_pengguna'];
        echo "<script lang='javascript'>location.href='../ui/header.php?page=jadwal&nama=$nama'</script>";
    }

    public function ReadJadwal(){
        $row = $this->konfig->Jadwal();
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function PilihJadwal($id){
        $id = htmlspecialchars($_GET["id_jam"]) ? htmlentities($_GET["id_jam"]) : $_GET["id_jam"];
        $row = $this->konfig->PilihEditJadwal($id);
        $hasil = $row->fetch();
        return $hasil;
    }
}

use model\Message;
class ViewMessage {
    protected $konfig;
    public function __construct($db)
    {
        $this->konfig = new Message($db);
    }
}
?>