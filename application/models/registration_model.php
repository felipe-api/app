<?php
class Registration_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }


    function register($dados){		
		if($this->db->insert('cadastro', $dados)){
			return $this->db->insert_id();
		}
	}
	

    function exist_nickname($name){	
		if($this->db->from("cadastro")->where('cad_login', $name)->get()->result()){
			return true;
		}else{
			return false;
		}
	}
	
	public function getuser($id){
 		$this->db->where('id', $id);
    	return $this->db->get('cadastro')->result();	
	}	

	function update_user($data) {
		$this->db->where('id', $data['id']);
		$this->db->set($data);
		return $this->db->update('cadastro');
	}	
	
}
?>