<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lista extends CI_Controller {
	
	 
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
		$this->load->model('lista_model');
		$list = $this->lista_model->getlista();		
		$data['grid'] = $this->montagrid($list);
		

		$this->load->view('lista_view.php', $data);	
	}

	
	public function delete(){	
		if($this->uri->segment(3) != FALSE){
			$id = $this->uri->segment(3);			
			
			$this->load->model('lista_model');
			$return = $this->lista_model->delete($id);
	
			if($return){

				$this->session->set_flashdata('success','Cadastro excluido com sucesso!');
	
				redirect('/lista');
				break;
			}
			
		}else{
			show_404();
		}

	} 
	
	private function montagrid($list){

			$cont = 0;
			$grid = "";
				
			if(count($list) > 0){
				foreach($list as $row){
					($cont % 2 == 0) ? $color = "background-color: #cee6fe;" : $color = "background-color: #fff;"; $cont++;
					($row->car_foto == "") ? $img = "../../assets/images/no_image.jpg" : $img = "../../assets/images/uploads/".$row->car_foto;
		
						  $grid .= "<div class='rowDiv' style='$color'>
										<div class='cellDiv'>". date('d-m-Y', strtotime($row->car_data)) ."</div>
										<div class='cellDiv'>". $row->mar_marca ."</div>
										<div class='cellDiv'>". $row->car_modelo ."</div>
										<div class='cellDiv'>". $row->car_ano ."</div>
										<div class='cellDiv'><a href='". $img ."' class='nivoZoom'>
											<img src='". $img ."' style='border:none; vertical-align: middle' width='25' height='25'></a></div>
										<div class='cellDiv'>". number_format($row->car_valor,2,',','.') ."</div>
										<div class='cellDiv'>". $row->car_nro_parcelas.'X' ."</div>
										<div class='cellDiv'>". number_format($row->car_valor_total_juros_mes,2,',','.') ."</div>
										<div class='cellDiv'>". $row->cad_nome ."</div>                    
										<div class='cellDiv lastCell'>
											<a style='margin:0;' href='cadcarros/update/". $row->id ."' style='cursor:pointer; border: 0;'>
												<img src='../../assets/images/file_edit.png' width='16' height='16' title='Editar Registro' style='border:none; vertical-align: middle'>
											</a>&nbsp;&nbsp; ";
																						
											if($this->session->userdata('admin') == 1){									
											$grid .= " <a style='margin:0;' href='lista/delete/". $row->id ."' style='cursor:pointer; border: 0'>
													  		<img src='../../assets/images/delete.png' width='16' height='16' title='Excluir Registro' style='border:none; vertical-align: middle'>
													  </a> ";
											}
							 			
						      $grid .= "</div>
							  	 </div>";
			   }                          
			}
			
			return $grid;

	}
	
}