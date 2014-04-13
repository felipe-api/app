<?php
		if(!$this->session->userdata('logado')){
			$data['control_panel'] = '<div style="float:left; width: 75px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
											<a href="/registration" style="text-decoration:none; color:#fff">Cadastre-se</a></div>
									  <div style="float:left; width: 65px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
											|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/mainlogin" style="text-decoration:none; color:#fff">Entrar</a></div>'; 
		}elseif(!$this->session->userdata('admin')){
			$data['control_panel'] = '<div style="float:left; width: 75px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
											<a href="/mainlogin/logoff" style="text-decoration:none; color:#fff">Sair / Logoff</a></div>
									  </div>'; 	
		}elseif($this->session->userdata('admin')){
			$data['control_panel'] = '<div style="float:left; width: 75px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px; margin-top: 10px">
									  		<a href="/mainlogin/logoff" style="text-decoration:none; color:#fff"><strong>Sair / Logoff</strong></a></div>
									  <div style="float:left; width: 65px; font-family: Arial, sans-serif; font-size: 12px; color:#FFF; padding:30px 2px 0 2px;">
									  		&nbsp;&nbsp;&nbsp;&nbsp;</div>'; 
		}

?>

<div id="container">
    <div id="logo">
        <h1>
            <a href="<?php echo base_url();?>" id="logo_image">
            	AutoAPI
            </a>
        </h1>           
    </div>    
    <div id="container_center"> &nbsp; </div> 
    <div id="access_menu"> <?php echo $data['control_panel'] ?> </div> 
</div>