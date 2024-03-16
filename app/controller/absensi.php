<?php 
namespace absensi;
use model_absensi\absensi;

class controllerAbsensi {
    protected $adb;
    public function __construct($db)
    {
        $this->adb = new absensi($db);
    }
}

?>