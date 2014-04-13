<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {
	
	public function sendEmailRegister($dados){	
		$config['protocol']  = "smtp";
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "api.sendemail@gmail.com"; 
		$config['smtp_pass'] = "ab123456ab";
		$config['charset']   = "utf-8";
		$config['mailtype']  = "html";
		$config['newline']   = "\r\n";
		
		$ci = get_instance();
		$ci->email->initialize($config);	

		$ci->email->from("api.sendemail@gmail.com", "CarroAPI");
		$ci->email->to($dados['email']);
		$ci->email->subject("E-mail com Login e Senha de acesso CarrosAPI!");
		$ci->email->message("<table width=\"500px\"  align=\"center\" bgcolor=\"#fbfbf9\" style=\"margin: 40px 0 0; border-collapse: collapse; border:1px solid #999;\">
								<tr>
									<td style=\"border:1px dotted #999; padding: 15px 15px 10px 15px;\"><img src=\"http://imageshack.com/a/img163/5140/fgwa.png\" width=\"167\" height=\"43\">
									</td>
								</tr>
								<tr>
									<td style=\"padding: 20px 20px 10px 20px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;\">
										 Seu Login de acesso é: <strong>". $dados['login'] ."</strong>,<br>
										 Sua Senha de acesso é: <strong>". $dados['senha'] ."</strong>,<br><br>
									</td>
								</tr>
							</table>
							<table width=\"500px\" border=\"0px\" align=\"center\">
								<tr>
									<td align=\"center\" style=\"padding: 20px 20px 10px 20px; font-size: 12px; font-family: Arial, Helvetica, sans-serif;\">Não responda a este e-mail!</td>
								</tr>   
							</table>");
		$ci->email->send();
	}

	
}