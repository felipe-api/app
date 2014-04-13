<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadmarcas extends CI_Controller {
	
	 
	public function index(){
		$data['jquery'] = 'assets/jquery/jquery-1.10.2.min.js';		
		
		$data['cssReset']		 = 'assets/purecss/cssreset.css';
		$data['cssPureCSS']	   = 'assets/purecss/purecss.css';
		$data['cssPureCSSCustom'] = 'assets/purecss/purecss_custom.css';		
		
		$data['common'] 		= 'assets/css/global/common.css';
		$data['cssMainHeader'] = 'assets/css/global/header.css';
		$data['cssMain'] 	   = 'assets/css/registration/registrationuser_view.css';		
		$data['cssMainFooter'] = 'assets/css/global/footer.css';

		$data['garimpay_captcha_css'] = 'assets/jquery/garimpay_captcha/garimpay_captcha.css';
		$data['garimpay_captcha_js']  = 'assets/jquery/garimpay_captcha/garimpay_captcha.js';	

		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);		

		$data['menu'] = $this->load->view('global/menu', '', TRUE);

		$this->load->helper('url');
	
		$this->load->model('cadmarcas_model');
		$data['marcas']  = $this->cadmarcas_model->getmarcas();

		$this->load->view('cadmarcas_view.php', $data);	
	}

	
	public function setmarca(){	

			$marca  = $this->input->post('marca', TRUE);
			
			$arr = array('mar_data' => date("Y-m-d H:i:s"), 
						 'id_user' => $this->session->userdata('user_id'),
						 'mar_marca' => $marca);
			
			// Cria a nova marca
			$this->load->model('cadmarcas_model');
			$return = $this->cadmarcas_model->register_marca($arr);
				
			if($return){				
				$this->session->set_flashdata('success','Marca cadastrada com sucesso!');
			}else{
				$this->session->set_flashdata('error','Marca não foi cadastrada!');	
			}
			
			$return = array('inputs_required' => 1);			
			echo json_encode($return);						

	} 
	
}