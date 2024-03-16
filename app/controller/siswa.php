<?php 
namespace siswa;
use model_siswa\siswa;

class controllerSiswa {
    protected $sdb;
    public function __construct($db)
    {
        $this->sdb = new siswa($db);
    }
}

?>