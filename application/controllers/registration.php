<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {
	
	 
	public function index(){
		$data['jquery'] = 'assets/jquery/jquery-1.10.2.min.js';		
		
		$data['cssReset']		 = 'assets/purecss/cssreset.css';
		$data['cssPureCSS']	   = 'assets/purecss/purecss.css';
		$data['cssPureCSSCustom'] = 'assets/purecss/purecss_custom.css';		
		
		$data['common'] 		= 'assets/css/global/common.css';
		$data['cssMainHeader'] = 'assets/css/global/header.css';
		$data['cssMain'] 	   = 'assets/css/registration/registration_view.css';		
		$data['cssMainFooter'] = 'assets/css/global/footer.css';

		$data['garimpay_captcha_css'] = 'assets/jquery/garimpay_captcha/garimpay_captcha.css';
		$data['garimpay_captcha_js']  = 'assets/jquery/garimpay_captcha/garimpay_captcha.js';	

		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);		

		$this->load->view('registration_view.php', $data);	
	}

	
	public function register(){	

		$this->form_validation->set_rules('name', 'Nome', 'trim|required|xss_clean|min_length[2]|callback_validname');
		$this->form_validation->set_rules('surname', 'Sobrenome', 'trim|required|xss_clean|min_length[2]|callback_validsurname');
		$this->form_validation->set_rules('login', 'Apelido / Login', 'trim|required|xss_clean|min_length[2]|is_unique[cadastro.cad_login]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|xss_clean|valid_email|is_unique[cadastro.cad_email]');
		$this->form_validation->set_rules('passwd', 'Senha', 'trim|required|xss_clean|min_length[6]|max_length[20]|alpha_numeric');		
		$this->form_validation->set_rules('confpasswd', 'Confirme a Senha', 'trim|required|xss_clean|min_length[6]|max_length[20]|alpha_numeric|matches[passwd]');	
		
		$this->load->helper('captchax64');
		$captcha = captcha_verify($_POST['defaultReal'], $_POST['defaultRealHash']);		
		
		if($this->form_validation->run() == FALSE){
			
			$arr = array(
				'inputs_required' => 1,
				'name_msg' => form_error('name', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'surname_msg' => form_error('surname', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'login_msg' => form_error('login', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'email_msg' => form_error('email', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),				
				'passwd_msg' => form_error('passwd', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'confpasswd_msg' => form_error('confpasswd', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'captcha_msg' => $captcha
			);		
			echo json_encode($arr);		
			
		}else{
			
			// Verifica código Catpcha digitado, caso divergencia, informando.  
			if($captcha != ""){
				$arr = array(
					'inputs_required' => 1,
					'captcha_msg' => $captcha
				);				
				echo json_encode($arr);
				die();
			}
					
		
			// Prepara campos p/ criar novo cadastro
			$cad_nome  = $this->input->post('name', TRUE) ." ". $this->input->post('surname', TRUE);
			$cad_email = mb_strtolower($this->input->post('email', TRUE), 'UTF-8');
			$dados = array(
				'cad_data'  => date("Y-m-d H:i:s"),
				'cad_nome'  => $cad_nome,
				'cad_email' => $cad_email,
				'cad_login' => $this->input->post('login', TRUE),
				'cad_senha' => $this->input->post('passwd', TRUE),
				'cad_admin' => $this->input->post('admin', TRUE)
			);
			
			// Cria o novo cadastro
			$this->load->model('registration_model');
			$user_id = $this->registration_model->register($dados);	
			if($user_id != ""){
				
				# Enviar email confirmação cadastro... 
				//$this->load->library('email');
				//$this->email->sendEmailRegister($dados, $user_id);
	
				# Seta as variaveis de sessão!
				//$this->load->helper('set_login');
				//login_sessions($user_id);
				$this->session->set_flashdata('success','Cadastro efetuado com sucesso!');
	
				$return = array(
					'inputs_required' => 0
				);
				echo json_encode($return);
			}			
			
		}
	
	} 
	
	public function validname($str){
		# Aceita apenas letras, - e ' de qualquer linguagem, Árabe, Chines, Russo, Brasil, etc..
		/*if ( ! preg_match('/^[-\' \p{L}\p{N}]+$/u', $str) ) */
		if( ! preg_match("/^[0-9a-zA-Z-áàâäãéêèëíóôöõúüçÁÀÂÄÃÉÊÈËÍÓÔÖÕÚÜÇ '-]+$/u", $str)){
			$this->form_validation->set_message('validname', 'O campo %s deverá conter apenas caracteres alpha-num&eacute;ricos.');
			return FALSE;
		}else{
			return TRUE;
		}
	}	
	
	public function validsurname($str){
		# Aceita apenas letras, - e ' de qualquer linguagem, Árabe, Chines, Russo, Brasil, etc..
		/*if ( ! preg_match('/^[-\' \p{L}\p{N}]+$/u', $str) ) */
		if( ! preg_match("/^[0-9a-zA-Z-áàâäãéêèëíóôöõúüçÁÀÂÄÃÉÊÈËÍÓÔÖÕÚÜÇ '-]+$/u", $str)){
			$this->form_validation->set_message('validsurname', 'O campo %s deverá conter apenas caracteres alpha-num&eacute;ricos.');
			return FALSE;
		}else{
			return TRUE;
		}		
	}			
	
}