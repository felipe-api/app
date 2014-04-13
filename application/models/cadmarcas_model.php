<?php
class Cadmarcas_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }


    function register_marca($dados){		
		if($this->db->insert('marca', $dados)){
			return true;
		}else{
			return false;		
		}
	}
	
	function getmarcas(){
        $query = $this->db->query("SELECT * FROM marca");
        return $query->result();
    }	

}
?>