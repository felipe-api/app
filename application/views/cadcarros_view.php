<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        <script type="text/javascript" src="<?php echo base_url($maskMoney)?>"></script>        
        
        <link rel="stylesheet" href="<?php echo base_url($cssReset)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSS)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSSCustom)?>"> 
    
        <link rel="stylesheet" href="<?php echo base_url($common)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($cssMain)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>">
        
		<script>
  
 			function setVal(val){
				$('#total_juros').val(val);
			}	 
        
            $(document).ready(function () {
				
				// Calcula Juros
				$('#nro_parcelas').click(function () {

					if($('#nro_parcelas').val() > 1){
						var total = $('#valor').val().replace(".", "").replace(",", ".");
						var taxa  = 0.7;
						var parcelas = $('#nro_parcelas').val();
						  
						  
						  
						total = parseFloat(total/parcelas);
						taxa = parseFloat(taxa);					
					
						resultado = total * taxa / 100;
						desconto = total - resultado;
						acrescimo = total + resultado;
						
						$('#total_juros_mes').val((acrescimo).toFixed(2));					
						$('#total_juros').val((acrescimo * parcelas).toFixed(2));
					}else{
						$('#total_juros').val($('#valor').val());
						$('#total_juros_mes').val('');
					}
					
				});
				
				
				

				$('#criar').click(function () {
                
					//$('#criar').attr("disabled", "disabled");               
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('cadcarros/validform'); ?>",
                        data: $('form').serialize(),
						contentType: "application/x-www-form-urlencoded;charset=utf-8",
						async: false,
                        success: function (data) {							
                            var obj = $.parseJSON(data);
            
                            $('#modelo_msg').html('');
							$('#ano_msg').html('');
							$('#valor_msg').html('');							
                            $('#marca_msg').html('');
							    
                            if(obj.inputs_required == 1){	
                                $('#modelo_msg').html(obj.modelo_msg);
                                $('#ano_msg').html(obj.ano_msg);
                                $('#valor_msg').html(obj.valor_msg);
                                $('#marca_msg').html(obj.marca_msg);																
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
			
			
		$(function(){
			$("#valor").maskMoney(
				{
					//symbol:'R$', // Simbolo
					decimal:',',   // Separador do decimal
					precision:2,   // Precisão
					thousands:'.', // Separador para os milhares
					//allowZero:false, // Permite que o digito 0 seja o primeiro caractere
					showSymbol:false   // Exibe/Oculta o símbolo
				}		
			);
		})
                
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
                <form action="cadcarros/register" method="post" enctype="multipart/form-data">
                <div id="register_pos"><p id="register_label">Cadastro Novo Modelo Carro</p></div>                
                <div id="email_content">
                    <span id="form_label"><label>Marcas</label></span>
                	<select name="marca" id="marca">	
						<?php                        
                        $array = array(); $id = array();
                        foreach($marcas as $row ){
                            echo'<option value="'.$row->id.'">'.$row->mar_marca.'</option>';
                        }                          
                        ?>
					</select>
                    <div id="marca_msg"></div>                     
                </div>               
                <div id="email_content">
                    <span id="form_label"><label>Modelo</label></span>
                    <input type="text" class="gp-input-text-25 gp-200" name="modelo" id="modelo" maxlength="100">
                    <div id="modelo_msg"></div>
                </div>                
                <div id="login_content">
                    <span id="form_label"><label>Ano</label></span>
                    <input type="text" class="gp-input-text-25 gp-50" name="ano" id="ano" placeholder="" maxlength="4">
                    <div id="ano_msg"></div>
                </div>
                <div id="pass_content">
                    <span id="form_label"><label>Valor</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" onKeyUp="setVal(this.value)" name="valor" id="valor" placeholder="" maxlength="10">
                    <div id="valor_msg"></div>
                </div> 
                <div id="pass_content">
                    <span id="form_label"><label>Número Parcelas</label></span>
                    <div id="nroparcelas_msg">
                    	<select name="nro_parcelas" id="nro_parcelas">
                        	<option value="1">1</option>
                        	<option value="3">3</option>
                        	<option value="6">6</option>
                        	<option value="12">12</option>                            
                        </select>
                    </div>
                </div>              
                
                <div id="name_content">
                    <span id="form_label">
                    <label>Total com 0,7% ao mês</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" name="total_juros_mes" id="total_juros_mes" placeholder="" maxlength="20">
                    <div id="confpasswd_msg"></div>
                </div>                
                <div id="surname_content">
                    <span id="form_label">
                    <label>Total do parcelamento com 0,7%</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" name="total_juros" id="total_juros" placeholder="" maxlength="20">
                    <div id="confpasswd_msg"></div>
                </div>

                <div id="email_content">
                    <span id="form_label">
                    <label>Foto <font color="#999999"><i>".gif, .jpg ou .png"</i></font></label></span>
                    <input type="file" name="userfile" size="20" />                    
                    <div id="foto_msg"></div>
                </div>                
                

                <div id="btn_register">
	                <input type="submit" class="pure-button pure-button-primary" id="criar" value="Cadastrar Modelo">
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