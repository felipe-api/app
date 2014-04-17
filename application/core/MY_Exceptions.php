<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Exceptions extends CI_Exceptions {

		public function __construct(){
	      parent::__construct();
	    }
		
		function show_404($page = ''){
			redirect('404');
			exit;		
		}
}
?>