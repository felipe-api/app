<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 Helper Baseado no http://keith-wood.name/realPerson.html
 versão 1.1.1
*/

if ( ! function_exists('captcha_verify')){
	
	function captcha_verify($input_user, $input_app){
		if(rpHash($input_user) != $input_app){
			return '<div class="valid_error" style="text-align:left;"><font color="#FF0000" size="-1">O Código digitado não confere.</font></div>';
		}else{
			return '';
		}			  
	}
	
}


if ( ! function_exists('rpHash')){
	
	function rpHash($value) { 
		
		$hash = 5381; 
		$value = strtoupper($value); 
		for($i = 0; $i < strlen($value); $i++) { 
			$hash = (leftShift32($hash, 5) + $hash) + ord(substr($value, $i)); 
		} 
		return $hash; 
	} 
}


if ( ! function_exists('leftShift32')){

	function leftShift32($number, $steps) { 
		$binary = decbin($number); 
		$binary = str_pad($binary, 32, "0", STR_PAD_LEFT); 
		$binary = $binary.str_repeat("0", $steps); 
		$binary = substr($binary, strlen($binary) - 32); 
		return ($binary{0} == "0" ? bindec($binary) : -(pow(2, 31) - bindec(substr($binary, 1)))); 
	} 	
}