<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_404 extends CI_Controller {
	
	 
	public function index(){
		
		$data['cssMainHeader'] = 'assets/css/global/header.css';
		$data['css404'] = 'assets/css/custom_404/custom_404_view.css';		
		$data['cssMainFooter'] = 'assets/css/global/footer.css';
		
		$data['header'] = $this->load->view('global/header', '', TRUE);
		$data['footer'] = $this->load->view('global/footer', '', TRUE);
		
		$this->load->view('custom_404_view', $data);
	}
	

}
