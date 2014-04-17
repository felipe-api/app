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
           
				
				// Calcula Juros
				$('#nro_parcelas, #valor').on('keyup keypress blur change', function () {

					if($('#nro_parcelas').val() > 1){
						var total = $('#valor').val().replace(".", "").replace(",", ".");
						var taxa  = parseFloat(0.7);
						var parcelas = $('#nro_parcelas').val();

						total = parseFloat(total)/parseFloat(parcelas);
						taxa = parseFloat(taxa);					
					
						resultado = parseFloat(total) * parseFloat(taxa) / 100;
						desconto = parseFloat(total) - parseFloat(resultado);
						acrescimo = parseFloat(total) + parseFloat(resultado);
						
						$('#total_juros_mes').val((acrescimo).toFixed(2));					
						$('#total_juros').val((parseFloat(acrescimo) * parseFloat(parcelas)).toFixed(2));
					}else{
						$('#total_juros').val($('#valor').val());
						$('#total_juros_mes').val('');
					}
					
				});				
				
				

				$('#criar').click(function () {
                	$("#nro_parcelas").prop('disabled', false);
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
                <form action="/cadcarros/update_carro" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $carro[0]->id ?>">
                 <input type="hidden" name="foto_old" id="foto_old" value="<?php echo $carro[0]->car_foto ?>">
                <div id="register_pos"><p id="register_label">Atualizar Modelo Carro</p></div>                
                <div id="email_content">
                    <span id="form_label"><label>Marcas</label></span>
                	<select name="marca" id="marca">	
						<?php                        
                        $array = array(); $id = array();
                        foreach($marcas as $row ){
							($carro[0]->id_mar == $row->id) ? $slc = "selected" : $slc = "";
                            echo'<option value="'.$row->id.'"  '. $slc .'>'.$row->mar_marca.'</option>';
                        }                          
                        ?>
					</select>
                    <div id="marca_msg"></div>                     
                </div>               
                <div id="email_content">
                    <span id="form_label"><label>Modelo</label></span>
                    <input type="text" class="gp-input-text-25 gp-200" name="modelo" id="modelo" value="<?php echo $carro[0]->car_modelo ?>" maxlength="100">
                    <div id="modelo_msg"></div>
                </div>                
                <div id="login_content">
                    <span id="form_label"><label>Ano</label></span>
                    <input type="text" class="gp-input-text-25 gp-50" name="ano" id="ano" value="<?php echo $carro[0]->car_ano ?>" maxlength="4">
                    <div id="ano_msg"></div>
                </div>
                <div id="pass_content">
                    <span id="form_label"><label>Valor</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" onKeyUp="setVal(this.value)" name="valor" <?php echo $visibilidade; ?> id="valor" value="<?php echo str_replace(".", ",", $carro[0]->car_valor) ?>" maxlength="10">
                    <div id="valor_msg"></div>
                </div> 
                <div id="pass_content">
                    <span id="form_label"><label>Número Parcelas</label></span>
                    <div id="nroparcelas_msg">
                    	<select name="nro_parcelas" id="nro_parcelas" <?php echo $disable; ?> >
                        	<option value="1" <?php echo ($carro[0]->car_nro_parcelas == 1) ? "selected" : ""; ?>>1</option>
                        	<option value="3" <?php echo ($carro[0]->car_nro_parcelas == 3) ? "selected" : ""; ?>>3</option>
                        	<option value="6" <?php echo ($carro[0]->car_nro_parcelas == 6) ? "selected" : ""; ?>>6</option>
                        	<option value="12" <?php echo ($carro[0]->car_nro_parcelas == 12) ? "selected" : ""; ?>>12</option>                            
                        </select>
                    </div>
                </div>              
                
                <div id="name_content">
                    <span id="form_label">
                    <label>Total com 0,7% ao mês</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" readonly name="total_juros_mes" id="total_juros_mes"  maxlength="20">
                    <div id="confpasswd_msg"></div>
                </div>                
                <div id="surname_content">
                    <span id="form_label">
                    <label>Total do parcelamento com 0,7%</label></span>
                    <input type="text" class="gp-input-text-25 gp-150" readonly name="total_juros" id="total_juros" value="<?php echo str_replace(".", ",", $carro[0]->car_valor_total_juros_mes) ?>" placeholder="" maxlength="20">
                    <div id="confpasswd_msg"></div>
                </div>

                <div id="email_content">
                    <span id="form_label">
                    <label>Foto <font color="#999999"><i>".gif, .jpg ou .png"</i></font></label></span>
                    <input type="file" name="userfile" size="20" />                    
                    <div id="foto_msg"></div>
                </div>                
                

                <div id="btn_register">
	                <input type="submit" class="pure-button pure-button-primary" id="criar" value="Atualizar">
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