<?php 
namespace account;
use model_account\account;

class controllerAccount {
    protected $cdb;
    public function __construct($db)
    {
        $this->cdb = new account($db);
    }
}

?>