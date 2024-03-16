<?php 
namespace model_siswa;

class siswa {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>