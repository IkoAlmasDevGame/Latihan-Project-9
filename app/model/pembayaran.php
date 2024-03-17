<?php 
namespace model_pembayaran;

class pembayaran {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>