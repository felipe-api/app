<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainLogin extends CI_Controller {
	
	 
	public function index(){
		$data['jquery'] = 'assets/jquery/jquery-1.10.2.min.js';		
		
		$data['cssReset'] = 'assets/purecss/cssreset.css';
		$data['cssPureCSS'] = 'assets/purecss/purecss.css';
		$data['cssPureCSSCustom'] = 'assets/purecss/purecss_custom.css';		
		
		$data['common'] = 'assets/css/global/common.css';	
		$data['cssMainHeader'] = 'assets/css/global/header.css';
		$data['cssMain'] = 'assets/css/login/login_view.css';		
		$data['cssMainFooter'] = 'assets/css/global/footer.css';
		
		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);
		
		$this->load->view('login_view', $data);
	}
	
	
	public function loginverify(){
		
		$this->form_validation->set_rules('user', 'Apelido', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Senha', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE){
		
			$arr = array(
				'inputs_required' => 1,
				'user_msg' => form_error('user', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'pass_msg' => form_error('pass', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>')
			);		
			echo json_encode($arr);		
			
		}else{
			

			// #####   VERIFICA LOGIN	
			$user = $this->input->post('user', TRUE);
			$pass = $this->input->post('pass', TRUE);
			
			$this->load->model('mainlogin_model');
			$user_id = $this->mainlogin_model->setlogin($user, $pass);			
			
			// LOGIN OK!
			if($user_id != false){

				#### Seta as variaveis de sessão do Admin!
				$this->load->helper('set_login');
				login_sessions($user_id);
				
				
				// ##### SETA LOG
				$data_log = array('log_data' => date("Y-m-d H:i:s"), 'id_user' => $user_id['id'], 'action' => 'login', 'admin' => $user_id['admin']);
				$this->mainlogin_model->setlog($data_log);
				
				
				
				$arr = array('inputs_required' => 2);
							 
				echo json_encode($arr);
				
			// LOGIN ERRO!
			}else{
	
				$arr = array(
					'inputs_required' => 0,
					'login_fail' => '<div style="background-color: #feeeef; width: 315px; padding: 2px 5px 2px 5px; border: 1px #ffc0c0 solid; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">
									 <img src="../../assets/images/caution.png" width="24" height="24" style="vertical-align: middle; margin-right: 5px">
									 <font color=#FF0000 size="-1">Seu Apelido e/ou Senha estão incorretos.</font>
									 </div>');
				echo json_encode($arr);
				
			}
			

		}
			
	}
	
	
	public function logoff(){

		$this->load->model('mainlogin_model');	
		$data_log = array('log_data' => date("Y-m-d H:i:s"), 'id_user' => $this->session->userdata('user_id'), 'action' => 'logoff', 'admin' => $this->session->userdata('admin'));
		$this->mainlogin_model->setlog($data_log);		
		
		$this->session->userdata = array();
		$this->session->sess_destroy();
		redirect('/');
		break;
		 
	}
	
	
	
	public function recoverdata(){
	
		$email = $this->input->post('email', TRUE);		

		$this->load->model('mainlogin_model');
		$return = $this->mainlogin_model->getrecover($email);
		
		if($return != false){		
			# Enviar email confirmação cadastro... 
			$email = $this->load->library('email');
			$return = $this->email->sendEmailRegister($return);
			
			$arr = array('retorno' => 1);
		}else{
			$arr = array('retorno' => 0);
		}
		
		echo json_encode($arr);	
	}		

}
