<?php 
namespace kelas;
use model_kelas\kelas;

class controllerKelas {
    protected $kdb;
    public function __construct($db)
    {
        $this->kdb = new kelas($db);
    }
}

?>