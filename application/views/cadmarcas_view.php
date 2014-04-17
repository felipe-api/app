<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        <script type="text/javascript" src="<?php echo base_url($garimpay_captcha_js)?>"></script>
        
        <link rel="stylesheet" href="<?php echo base_url($garimpay_captcha_css)?>"> 
        
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
				
					if($('#marca').val() != ''){ 
						$.ajax({
							type: "POST",
							url: "<?php echo base_url('cadmarcas/setmarca'); ?>",
							data: $('form').serialize(),
							contentType: "application/x-www-form-urlencoded;charset=utf-8",
							async: false,
							success: function (data) {							
								var obj = $.parseJSON(data);
									
								if(obj.inputs_required == 1){	                             
									window.location.href = '<?php echo base_url('lista'); ?>';					
								}else{
									alert("Tente novamente em instantes!");
								}
							},
							error:function(){
								alert("Tente novamente em instantes!");
							}
													
						});
						
						return false;
					}else{
						alert("Campo marca está em branco!");
					}
				
				
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
                <input type="hidden" name="admin" value="0"> 
                <div id="register_pos"><p id="register_label">Cadastro Nova Marca</p></div>  
                              
                <div id="register_pos" style="margin-top:20px">
 					<span id="form_label">
                    <label>Marcas já cadastradas:</label></span>               
                </div>  
				<div id="register_pos">
                	<select>	
						<?php                        
                        $array = array(); $id = array();
                        foreach($marcas as $row ){
                            echo'<option value="'.$row->id.'">'.$row->mar_marca.'</option>';
                        }                          
                        ?>
					</select>   					
                </div>    
                    
                <div id="name_content">
                    <span id="form_label">
                    <label>Nova Marca de Carro</label></span>
                    <input type="text" class="gp-input-text-25 gp-250" name="marca" id="marca" maxlength="45" autofocus>
                    <div id="name_msg"></div>
                </div><br>                
                <div id="name_content">
	                <input type="button" class="pure-button pure-button-primary" id="criar" value="Cadastrar Marca">
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