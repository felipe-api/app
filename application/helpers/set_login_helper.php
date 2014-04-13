<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Helper set sessions, login ou register.
	versão 1.0 - data: 07/03/2014
*/

if ( ! function_exists('login_sessions')){
	
	function login_sessions($user_id) { 
		$CI =& get_instance();
		$CI->load->library('session');
		
		$CI->session->set_userdata('user_id', $user_id['id']);
		$CI->session->set_userdata('admin', $user_id['admin']);		
		$CI->session->set_userdata('logado', true);		
		
		return true;
	}	
	
}
