<?php
class MainLogin_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }

    function setlogin($user, $pass){	
		if($data = $this->db->select('*')->from("cadastro")->where('cad_login', $user)->where('cad_senha', $pass)->get()->row()){		
			 
			$arr = array('id' => $data->id,
						 'admin' => ($data->cad_admin));			 
			return $arr;
		}else{
			return false;
		}
	}
	
    function setlog($dados){		
		if($this->db->insert('log', $dados)){
			return true;
		}
	}
	
    function getrecover($email){	
		if($data = $this->db->select('*')->from("cadastro")->where('cad_email', $email)->get()->row()){		
			 
			$arr = array('login' => $data->cad_login,
						 'senha' => $data->cad_senha,
						 'email' => $email);			 
			return $arr;
		}else{
			return false;
		}
	}	
	
}
?>