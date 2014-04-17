<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listalog extends CI_Controller {
	
	 
	public function index(){
		$data['jquery'] = 'assets/jquery/jquery-1.10.2.min.js';		
		
		$data['cssReset']		 = 'assets/purecss/cssreset.css';
		$data['cssPureCSS']	   = 'assets/purecss/purecss.css';
		$data['cssPureCSSCustom'] = 'assets/purecss/purecss_custom.css';		
		
		$data['common'] 		= 'assets/css/global/common.css';
		$data['cssMainHeader'] = 'assets/css/global/header.css';
		$data['cssMain'] 	   = 'assets/css/registration/lista_view.css';		
		$data['cssMainFooter'] = 'assets/css/global/footer.css';
		$data['cssNotificationBox'] = 'assets/jquery/notification_box/notification_box.css';

		$data['garimpay_captcha_css'] = 'assets/jquery/garimpay_captcha/garimpay_captcha.css';
		$data['garimpay_captcha_js']  = 'assets/jquery/garimpay_captcha/garimpay_captcha.js';	

		$data['nivoZoom_js']   = 'assets/jquery/nivoZoom/jquery.nivo.zoom.pack.js';
		$data['nivoZoom_css']  = 'assets/jquery/nivoZoom/nivo-zoom.css';	

		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);		

		$data['menu'] = $this->load->view('global/menu', '', TRUE);


		// Monta Grid
		$this->load->model('listacad_model');
		$list = $this->listacad_model->getlog();		
		$data['grid'] = $this->montagrid($list);
		

		$this->load->view('listalog_view.php', $data);	
	}

	
	
	private function montagrid($list){

			$cont = 0;
			$grid = "";
				
			if(count($list) > 0){
				foreach($list as $row){
					($cont % 2 == 0) ? $color = "background-color: #cee6fe;" : $color = "background-color: #fff;"; $cont++;
					($row->cad_admin == 1) ? $tipo = "Sim" : $tipo = "Não";
					($row->cad_nome == "") ? $nome = ":: CADASTRO DELETADO ::" : $nome = $row->cad_nome ;
		
						  $grid .= "<div class='rowDiv' style='$color'>
										<div class='cellDiv'>". date('d-m-Y', strtotime($row->log_data)) ."</div>
										<div class='cellDiv'>". $nome ."</div>
										<div class='cellDiv'>". $row->action ."</div>                  
										<div class='cellDiv lastCell'><strong>". $tipo ."</strong></div>
									</div>";
			   }                          
			}
			
			return $grid;

	}
	
}