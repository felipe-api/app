<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadcarros extends CI_Controller {
	
	 
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

		$data['maskMoney'] = 'assets/jquery/maskMoney/jquery.maskMoney.js';		

		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);		

		$data['menu'] = $this->load->view('global/menu', '', TRUE);

		$this->load->helper('url');
	
		$this->load->model('cadmarcas_model');
		$data['marcas']  = $this->cadmarcas_model->getmarcas();		

		$this->load->view('cadcarros_view.php', $data);	
	}
	
	
	public function update(){
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

		$data['maskMoney'] = 'assets/jquery/maskMoney/jquery.maskMoney.js';		

		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);		

		$data['menu'] = $this->load->view('global/menu', '', TRUE);

		
		// Visibilidade - Editar valor somente Admin
		($this->session->userdata('admin') == 1) ? $data['visibilidade'] = "" : $data['visibilidade'] = "readonly";
		($this->session->userdata('admin') == 1) ? $data['disable'] = "" : $data['disable'] = "disabled";

		
		
		$this->load->helper('url');

		$this->load->model('cadmarcas_model');
		$data['marcas']  = $this->cadmarcas_model->getmarcas();	
		
		if($this->uri->segment(3) != FALSE){
			$id = $this->uri->segment(3);			

			$this->load->model('cadcarros_model');
			$data['carro'] = $this->cadcarros_model->getcarro($id);
		}

		$this->load->view('cadcarrosupd_view.php', $data);	
	}	


	public function validform(){
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required|xss_clean|min_length[2]');
		$this->form_validation->set_rules('ano', 'Ano', 'trim|required|numeric|xss_clean|min_length[4]');
		$this->form_validation->set_rules('valor', 'Valor', 'trim|required|xss_clean|');
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|xss_clean|');
		
		
		if($this->form_validation->run() == FALSE){			
			$arr = array(
				'inputs_required' => 1,
				'modelo_msg' => form_error('modelo', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'ano_msg' => form_error('ano', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'valor_msg' => form_error('valor', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>'),
				'marca_msg' => form_error('marca', '<div class="valid_error"><font color="#FF0000" size="-1">', '</font></div>')
			);		
			echo json_encode($arr);			
		}		
	}

	
	public function register(){						

		$config['upload_path'] = 'assets/images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		 
		// You can give video formats if you want to upload any video file.
		 
		$this->load->library('upload', $config);		 
		
		if($this->upload->do_upload()){
		
			$upload_data = $this->upload->data(); 
			$nome_arquivo = $upload_data['file_name'];
	
		}else{
			$nome_arquivo = "";
		}
					

			// Prepara campos p/ criar novo cadastro carro
			($this->input->post('nro_parcelas', TRUE) == 1) ? $total_juros = str_replace(",", ".", str_replace(".", "", $this->input->post('total_juros', TRUE))) : $total_juros = $this->input->post('total_juros', TRUE);
			$dados = array(
					'id_mar'     => $this->input->post('marca', TRUE),
					'car_data'   => date("Y-m-d H:i:s"),
					'car_modelo' => $this->input->post('modelo', TRUE),
					'car_ano'    => $this->input->post('ano', TRUE),
					'car_foto'   => $nome_arquivo,
					'car_valor'  => str_replace(",", ".", str_replace(".", "", $this->input->post('valor', TRUE))),
					'car_nro_parcelas'  => $this->input->post('nro_parcelas', TRUE),
					'car_valor_total_juros_mes'  => $total_juros,
					'id_user'  => $this->session->userdata('user_id')							
			);
			
			// Cria o novo cadastro
			$this->load->model('cadcarros_model');
			$user_id = $this->cadcarros_model->register_carro($dados);	
			if($user_id != ""){

				$this->session->set_flashdata('success','Cadastro do carro efetuado com sucesso!');
	
				redirect('/lista');
				break;
			}
	
	} 		


	public function update_carro(){						

		$config['upload_path'] = 'assets/images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		 
		// You can give video formats if you want to upload any video file.
		 
		$this->load->library('upload', $config);		 
		
		if($this->upload->do_upload()){
		
			$upload_data = $this->upload->data(); 
			$nome_arquivo = $upload_data['file_name'];
	
		}else{
			$nome_arquivo = $this->input->post('foto_old', TRUE);
		}

			// Prepara campos p/ criar novo cadastro carro
			($this->input->post('nro_parcelas', TRUE) == 1) ? $total_juros = str_replace(",", ".", str_replace(".", "", $this->input->post('total_juros', TRUE))) : $total_juros = str_replace(",", ".", $this->input->post('total_juros', TRUE));
			$dados = array(
					'id'		 => $this->input->post('id', TRUE),
					'id_mar'     => $this->input->post('marca', TRUE),
					'car_modelo' => $this->input->post('modelo', TRUE),
					'car_ano'    => $this->input->post('ano', TRUE),
					'car_foto'   => $nome_arquivo,
					'car_valor'  => str_replace(",", ".", str_replace(".", "", $this->input->post('valor', TRUE))),
					'car_nro_parcelas'  => $this->input->post('nro_parcelas', TRUE),
					'car_valor_total_juros_mes'  => $total_juros,
					'id_user'  => $this->session->userdata('user_id')							
			);
			
			// Cria o novo cadastro
			$this->load->model('cadcarros_model');
			$user_id = $this->cadcarros_model->update_carro($dados);	
			if($user_id != ""){

				$this->session->set_flashdata('success','Atualização do carro efetuada com sucesso!');
	
				redirect('/lista');
				break;
			}
			

	
	} 		
	
}