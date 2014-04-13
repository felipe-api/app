<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="pt-br"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        <script type="text/javascript" src="<?php //echo base_url($jsMainHeader)?>"></script>
           
 		
        <link rel="stylesheet" href="<?php echo base_url($cssReset)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSS)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSSCustom)?>"> 
    
        <link rel="stylesheet" href="<?php echo base_url($common)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($cssMain)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>">
        
        <script>
		  $(document).ready(function () {

                $('#user').focus();		      
		      
				$('#enter').click(function () {
				
				//$('#enter').attr("disabled", "disabled");
				
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('mainlogin/loginverify'); ?>",
						data: $('form').serialize(),
						success: function (data) {							
							var obj = $.parseJSON(data);

							$('#login_error').html('');
							$('#user_msg').html('');
							$('#pass_msg').html('');
								
							if(obj.inputs_required == 1){	
								$('#user_msg').html(obj.user_msg);
								$('#pass_msg').html(obj.pass_msg);
							}else if(obj.inputs_required == 0){
								$('#login_error').html(obj.login_fail);
							}else if(obj.inputs_required == 2){
								window.location.href = '<?php echo base_url() ?>';
							}							

							//$('#enter').removeAttr("disabled");  							
							
						},
						error:function(){
          					alert("Tente novamente em instantes!");
        				}
												
					});
					
					return false;
				});
				
				$('#register').click(function () {
				    window.location.href = '/registration';
				});
				
				$('#recover').click(function () {
					if($('#recuperar').css("display") == "block"){	
						$('#recuperar').css("display","none");    
					}else{
					   $('#recuperar').css("display","block");
					}
				});
				
				
				
				// RECUPERA LOGIN E SENHA
				$('#recupera_data').click(function () {
				  	
					$('#recupera_data').attr("disabled", "disabled");
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('mainlogin/recoverdata'); ?>",
						data: $('#form_two').serialize(),
						success: function (data) {							
							var obj = $.parseJSON(data);

							if(obj.retorno == 1){
								alert('Email com Login/Senha enviados com sucesso');
								$('#email').val('');
								$('#recupera_data').removeAttr("disabled");								
							}else if(obj.retorno == 0){
								alert('Email não cadastrado no sistema');
								$('#recupera_data').removeAttr("disabled");								
							}
							
						},
						error:function(){
          					alert("Tente novamente em instantes!");
							$('#recupera_data').removeAttr("disabled");							
        				}
												
					});
					
					return false;
				});							
				
				   
			});
        </script>   
</head>

<body>
<div id="wrapper">
    <div id="header">
    	<?php echo $header ?>  
    </div>
    <div id="main">
        <div id="flag">
        	<img src="<?php echo base_url('/assets/images/img_cad_free2.png') ?>" width="150" height="141">
        </div>      
        <div id="register_content">   
            <div id="description">
                <span class="nro_lines">1. Cadastre-se agora</span>
                <span class="nro_lines">2. Se for Admin comece a gerenciar</span>
                <span class="nro_lines">3. O resto é por nossa conta!</span> 
            </div>	
            <input type="button" id="register" value="Cadastre-se" class="pure-button pure-button-success btn_register">	
        </div>
        <div id="login_content">
        <form action="#" method="post">
            <div id="login_pos">
            	<p id="login_label">Login</p>
            </div>
            <div id="login_error"></div>
            <div id="email_content">
                <span class="descr"><label>Apelido / Login</label></span>
                <input type="text" class="gp-input-text gp-300" name="user" id="user" autofocus>
                <div id="user_msg"></div>
            </div>
            <div id="pass_content">
                <span class="descr"><label>Senha</label></span>
                <input type="text" class="gp-input-text gp-300" name="pass" id="pass">
                <div id="pass_msg"></div>
            </div>
            <div id="connected_content">
            &nbsp;
            </div>
            <div id="btn_content">
            	<input type="button" class="pure-button pure-button-primary" id="enter" value="Entrar">
            </div>
            <div id="recover_content">
            	<a href="#" id="recover">Recuperar senha!</a>
            </div>
        </form>
        
        <div style="display:none" id="recuperar"><br>
            <form id="form_two" action="#" method="post">
                <div id="email_content">
                    <span class="descr"><label>Email</label></span>
                    <input type="text" class="gp-input-text gp-300" name="email" id="email" placeholder="Digite email de cadastro">
                </div>
                <div id="btn_content">
                    <input type="button" class="pure-button pure-button-primary" id="recupera_data" value="Recuperar">
                </div>
            </form>
        </div>
                
        </div>
        
    </div>
    <div id="footer">
    	<?php echo $footer ?>
    </div>
</div>
</body>
</html>