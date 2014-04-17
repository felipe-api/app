<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title></title>
        <script type="text/javascript" src="<?php echo base_url($jquery)?>"></script> 
        <script type="text/javascript" src="<?php //echo base_url($jsMainHeader)?>"></script>
        
        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($cssMain)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>"> 
        <link rel="stylesheet" href="<?php echo base_url($cssNotificationBox)?>">  

        <style>
			html, body{
				min-height: 1200px !important;
    			height: 100% !important;
				background-color:#fbfbf9 !important;
			}
		</style>
        <script>
			$(document).ready(function() {
				$("#Search").focus(function(){
					$("#search_container").addClass("search_container_focus");
				}).blur(function(){
					$("#search_container").removeClass("search_container_focus");
				})
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

    <div id="header">
    	<div style="margin:0 auto; min-width: 980px; max-width: 1200px;">
            
            <div id="logo" style="height:40px !important">
                 <h1>
                    <a style="background-image:url('../../assets/images/Image3.png'); background-repeat:no-repeat; margin:0; position:absolute; top:40px; left:20px; text-indent:-9000px; width:167px;" href="<?php echo base_url();?>">
						CarrosApi
                    </a>
                </h1>           
            </div>
           
            <div id="access_menu">
            	<?php echo $control_panel ?>
            </div>
        
      </div>
    </div>
    
    
    <div id="main">
    
        <div id="success" class="alert-message success"></div>
        <div id="warning" class="alert-message warning"></div>
        <div id="error" class="alert-message error"></div>
        
         <div style="text-align:left; margin-top: 20px; height: 300px">

            <div id="divp">
  
  				<?php echo $grid; ?>
                
           </div>    		

        </div>       
        
    </div>
    
</body>
</html>