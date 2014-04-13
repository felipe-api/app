<?php
class Cadcarros_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }


    function register_carro($dados){		
		if($this->db->insert('carro', $dados)){
			return true;
		}else{
			return false;		
		}
	}	

}
?>