<?php 
namespace model_account;

class account {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>