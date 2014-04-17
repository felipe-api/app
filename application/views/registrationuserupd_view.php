<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        
        <link rel="stylesheet" href="<?php echo base_url($cssReset)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSS)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSSCustom)?>"> 
    
        <link rel="stylesheet" href="<?php echo base_url($common)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($cssMain)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>">
        
		<script>	
            
            $(document).ready(function () {
                $('#criar').click(function () {
                
					//$('#criar').attr("disabled", "disabled");
                
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('registrationuser/update_user'); ?>",
                        data: $('form').serialize(),
						contentType: "application/x-www-form-urlencoded;charset=utf-8",
						async: false,
                        success: function (data) {							
                            var obj = $.parseJSON(data);
            
                            $('#name_msg').html('');
                            $('#email_msg').html('');
							$('#login_msg').html('');
                            $('#passwd_msg').html('');
                            $('#confpasswd_msg').html('');
                                
                            if(obj.inputs_required == 1){	
                                $('#name_msg').html(obj.name_msg);
                                $('#email_msg').html(obj.email_msg);
                                $('#login_msg').html(obj.login_msg);
								$('#passwd_msg').html(obj.passwd_msg);
                                $('#confpasswd_msg').html(obj.confpasswd_msg);
								$('#criar').removeAttr("disabled");
                            }else if(obj.inputs_required == 0){
                                window.location.href = '<?php echo base_url('listacad'); ?>';
								//window.location.href = '/main';
								
								//$('#criar').removeAttr("disabled");
								//alert(obj.ret);								
                            }
                        },
                        error:function(){
                            alert("Tente novamente em instantes!");
                        	//$('#criar').removeAttr("disabled");
						}
                                                
                    });
                    
                    return false;
                });
            $('#name').focus();
            });
                
        </script>   
</head>

<body>
<div id="wrapper">
    <div id="header">
    	<?php echo $header ?>       
    </div>
    <div id="main"> 

         <div id="menuContainer">
            <ul class="menu">
                <?php echo $menu; ?>                               
            </ul>        	
        </div> 
    
        <div id="main_content">        
            <div id="form_register">            
                <form action="#" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $user[0]->id ?>"> 
                <div id="register_pos"><p id="register_label">Atualizar Cadastro</p></div>                
         
                 <div id="email_content">
                    <span id="form_label" style="margin-top:10px">
                    <label>Perfil</label></span>  					
                        <?php echo $admin_func; ?>
                </div>        
         
                <div id="name_content">
                    <span id="form_label">
                    <label>Nome e Sobrenome</label></span>
                    <input type="text" class="gp-input-text-25 gp-350" name="name" value="<?php echo $user[0]->cad_nome ?>" id="name" maxlength="25" autofocus>
                    <div id="name_msg"></div>
                </div>                              
                <div id="email_content">
                    <span id="form_label"><label>E-mail</label></span>
                    <input type="text" class="gp-input-text-25 gp-350" name="email" id="email" value="<?php echo $user[0]->cad_email ?>" maxlength="60">
                    <div id="email_msg"></div>
                </div>                
                <div id="login_content">
                    <span id="form_label"><label>Apelido / Login</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" name="login" id="login" value="<?php echo $user[0]->cad_login ?>" placeholder="" maxlength="20">
                    <div id="login_msg"></div>
                </div>
                <div id="pass_content">
                    <span id="form_label"><label>Senha</label></span>
                    <input type="password" class="gp-input-text-25 gp-150" name="passwd" id="passwd" value="<?php echo $user[0]->cad_senha ?>" placeholder="6-20 caracteres" maxlength="20">
                    <div id="passwd_msg"></div>
                </div> 
                <div id="confpass_content">
                    <span id="form_label">
                    <label>Confirmar Senha</label></span>
                    <input type="password" class="gp-input-text-25 gp-150" name="confpasswd" id="confpasswd" value="<?php echo $user[0]->cad_senha ?>" placeholder="6-20 caracteres" maxlength="20">
                    <div id="confpasswd_msg"></div>
                </div> 
                <div id="btn_register">
	                <input type="button" class="pure-button pure-button-primary" id="criar" value="Atualizar">
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