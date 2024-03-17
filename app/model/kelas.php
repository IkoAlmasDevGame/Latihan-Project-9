<?php 
namespace model_kelas;

class kelas {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>