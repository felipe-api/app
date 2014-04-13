<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        <script type="text/javascript" src="<?php echo base_url($garimpay_captcha_js)?>"></script>
 
        <link rel="stylesheet" href="<?php echo base_url($nivoZoom_css)?>" type="text/css" media="screen" />
        <script src="<?php echo base_url($nivoZoom_js)?>" type="text/javascript"></script>
        
        <link rel="stylesheet" href="<?php echo base_url($garimpay_captcha_css)?>"> 
        
        <link rel="stylesheet" href="<?php echo base_url($cssReset)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSS)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssPureCSSCustom)?>"> 
    
        <link rel="stylesheet" href="<?php echo base_url($common)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($cssMain)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>">
        
        <link rel="stylesheet" href="<?php echo base_url($cssNotificationBox)?>">          
        
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
                

			// ### nivoZoom
			$(window).load(function() {
				$('body').nivoZoom({
					speed:500,
					zoomHoverOpacity:0.8,
					overlay:false,
					overlayColor:'#333',
					overlayOpacity:0.5,
					captionOpacity:0.8
				});
			});
		
		
			// Mensage Box - Confirmação cadastro
			$(document).ready(function() {
				
				<?php if($this->session->flashdata('success')){ ?>
					$('#success').html('<div class="box-icon"></div><p><?php echo $this->session->flashdata('success'); ?><a href="" class="close"></a>').fadeIn(800);
				<?php } ?>

				<?php if($this->session->flashdata('warning')){ ?>
					$('#warning').html('<div class="box-icon"></div><p><?php echo $this->session->flashdata('warning'); ?><a href="" class="close"></a>').fadeIn(800);
				<?php } ?>
							
				<?php if($this->session->flashdata('error')){ ?>
					$('#error').html('<div class="box-icon"></div><p><?php echo $this->session->flashdata('error'); ?><a href="" class="close"></a>').fadeIn(800);
				<?php } ?>

				$(".alert-message").delegate("a.close", "click", function(event) {
					event.preventDefault();
					$(this).closest(".alert-message").fadeOut(function(event){
						$(this).remove();
					});
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
    
        <div id="success" class="alert-message success"></div>
        <div id="warning" class="alert-message warning"></div>
        <div id="error" class="alert-message error"></div>
            

         <div id="menuContainer">
            <ul class="menu">
                <?php echo $menu; ?>                                
            </ul>        	
        </div> 
    
        <div id="main_content">

                <div class="containerDiv">                
                  <div class="rowDivHeader">
                    <div class="cellDivHeader">Data Cad.</div>
                    <div class="cellDivHeader">Marca</div>
                    <div class="cellDivHeader">Modelo</div>
                    <div class="cellDivHeader">Ano</div>
                    <div class="cellDivHeader">Foto<br>(<i>Clique Ampliar</i>)</div>
                    <div class="cellDivHeader">Valor</div>
                    <div class="cellDivHeader">Parcelas</div>
                    <div class="cellDivHeader">Total c/ juros</div>
                    <div class="cellDivHeader">Admin</div>
                    <div class="cellDivHeader lastCell">Excluir</div>
                  </div>
                  	
                  <?php echo $grid; ?>	
                  
                </div>
                 
        </div>
            
    </div> 
    <div id="footer">
   		<?php echo $footer ?> 
    </div>
</div>      
</body>
</html>