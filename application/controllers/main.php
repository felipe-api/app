<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index(){
		$data['jquery'] = 'assets/jquery/jquery-1.10.2.min.js';		
		//$data['jsMainHeader'] = 'assets/js/main_header.js';	
			
		$data['cssMainHeader'] = 'assets/css/main_header.css';
		$data['cssMain'] 	   = 'assets/css/main_view.css';		
		$data['cssMainFooter'] = 'assets/css/main_footer.css';	
		$data['cssNotificationBox'] = 'assets/jquery/notification_box/notification_box.css';			

		if(!$this->session->userdata('logado')){
			$data['control_panel'] = '<div style="float:left; width: 75px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
											<a href="/registration" style="text-decoration:none; color:#fff">Cadastre-se</a></div>
									  <div style="float:left; width: 65px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
											|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/mainlogin" style="text-decoration:none; color:#fff">Entrar</a></div>'; 
		}else{
			$data['control_panel'] = '<div style="float:left; width: 75px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px; margin-top: 10px">
									  		<a href="/mainlogin/logoff" style="text-decoration:none; color:#fff">Sair / Logoff</a></div>
									  <div style="float:left; width: 65px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
									  		&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/lista" style="text-decoration:none; color:#fff"><strong><font size="+2">Administrar</font></strong></a></div>'; 
		}


		// Monta Grid Principal
		$this->load->model('lista_model');
		$list = $this->lista_model->getlista();
		$data['grid'] = $this->montagridmain($list);			
		
		$this->load->view('main_view', $data);
	}
	
	
	private function montagridmain($list){
		

			$grid = "";
			
			if(count($list) > 0){
				foreach($list as $row){
				
					($row->car_foto == "") ? $img = "../../assets/images/no_image.jpg" : $img = "../../assets/images/uploads/".$row->car_foto; 
					$grid .= "<div id='divf' class='anuncio_texto'>
								  <div style='border:1px solid #000; margin:7px 5px 5px 7px; border: 1px #999999 dotted'>
										<img src='". $img ."' width='265px' height='200px'>
								  </div>		
								  <div style='border:1px solid #000; margin:5px 5px 1px; 10px; border: 1px #999999 dotted'>Ano: <strong>". $row->car_ano ."</strong></div>
								  <div style='border:1px solid #000; margin:1px 5px 1px; 10px; border: 1px #999999 dotted'><strong>". $row->mar_marca ."</strong> - <strong>". $row->car_modelo ."</strong></div>
								  <div style='border:1px solid #000; margin:1px 5px; border: 1px #999999 dotted'>Valor: <strong>R$ ". number_format($row->car_valor,2,',','.') ."</strong> / Parc.: <strong>". $row->car_nro_parcelas.'X' ."</strong></div>  	
								  <div style='border:1px solid #000; margin:1px 5px; border: 1px #999999 dotted'>Total c/ Juros: <strong>R$ ". number_format($row->car_valor_total_juros_mes,2,',','.') ."</strong></div> 
							  </div>";                					
				
				}
			}else{
				$grid = "<div class='anuncio_texto'>Informação do sistema: <u><strong>Não existem registros cadastrados até o momento!</strong></u>
						<br><br>Efetueu seu cadastro como <strong>Administrador</strong> ou <strong>Funcionário</strong>, para isso...
						<br><strong>1)</strong> Clique em <strong>Cadastre-se</strong> e faça seu cadastro
						<br><strong>2)</strong> Clique em <strong> Entrar</strong> faça seu login
						<br><strong>3)</strong> Clique em <strong>Administra</strong> e comece a utilizar o sistema.</div>";
			}
			
			return $grid;	
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */