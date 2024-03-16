<?php 
namespace pelajaran;
use model_pelajaran\pelajaran;

class controllerPelajaran {
    protected $pdb;
    public function __construct($db)
    {
        $this->pdb = new pelajaran($db);
    }
}

?>