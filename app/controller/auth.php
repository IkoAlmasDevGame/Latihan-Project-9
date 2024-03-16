<?php 
namespace auth;
use model_auth\auth;

class controllerAuth {
    protected $udb;
    public function __construct($db)
    {
        $this->udb = new auth($db);
    }
}

?>