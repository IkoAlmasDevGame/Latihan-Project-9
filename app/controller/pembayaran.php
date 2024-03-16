<?php 
namespace pembayaran;
use model_pembayaran\pembayaran;

class controllerPembayaran {
    protected $edb;
    public function __construct($db)
    {
        $this->edb = new pembayaran($db);
    }
}

?>