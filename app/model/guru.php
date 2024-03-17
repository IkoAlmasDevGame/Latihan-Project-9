<?php 
namespace model_guru;

class guru {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>