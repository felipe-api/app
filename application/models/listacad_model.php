<?php
class Listacad_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }


	function getlista(){
        $query = $this->db->query("SELECT id, cad_data, cad_nome, cad_email, cad_login, cad_admin FROM cadastro");
        return $query->result();
    }	


	function getlog(){
        $query = $this->db->query("SELECT L.log_data, C.cad_nome, C.cad_admin, L.`action`
								   FROM `log` AS L
								   LEFT JOIN cadastro AS C
								   		ON L.id_user = C.id
								   ORDER BY L.log_data DESC
								   LIMIT 30");
        return $query->result();
    }	

    function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('cadastro'); 
		
		return true;
	}

}
?>