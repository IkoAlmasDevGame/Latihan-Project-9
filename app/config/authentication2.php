<?php 
if(isset($_SESSION['status'])){
    if(isset($_SESSION['id'])){
        if(isset($_SESSION['nis_pengguna'])){
            if(isset($_SESSION['email_pengguna'])){
                if(isset($_SESSION['nama_pengguna'])){
                    if(isset($_SESSION['user_level'])){
                        if(isset($_SESSION['created_At'])){
                            if(isset($_SESSION['created_End'])){
                                
                            }
                        }
                    }                                
                }            
            }        
        }            
    }
}else{
    echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../auth/index.php'
    }, 3000);
    </script>
    ";
    exit(0);
}
?>