<?php 
namespace guru;
use model_guru\guru;

class controllerGuru {
    protected $gdb;
    public function __construct($db)
    {
        $this->gdb = new guru($db);
    }
}

?>