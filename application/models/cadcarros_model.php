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
	

	function update_carro($data) {
		$this->db->where('id', $data['id']);
		$this->db->set($data);
		return $this->db->update('carro');
	}		
	
	public function getcarro($id){
 		$this->db->where('id', $id);
    	return $this->db->get('carro')->result();	
	}

}
?>