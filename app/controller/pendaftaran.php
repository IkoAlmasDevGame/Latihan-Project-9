<?php 
namespace pendaftaran;
use model_pendaftaran\pendaftaran;

class controllerPendaftaran {
    protected $ddb;
    public function __construct($db)
    {
        $this->ddb = new pendaftaran($db);
    }
}

?>