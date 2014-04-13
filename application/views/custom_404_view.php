<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="utf-8">
	<title>404 - Página não encontrada</title>           

        <link rel="stylesheet" href="<?php echo base_url($cssMainHeader)?>">   
        <link rel="stylesheet" href="<?php echo base_url($css404)?>">  
        <link rel="stylesheet" href="<?php echo base_url($cssMainFooter)?>">
  
</head>
<body>
<div id="wrapper">
    <div id="header">
    	<?php echo $header ?>  
    </div>
    <div id="main">         
        <div id="main_content">			
            <div id="content">            
            	<div id="content_img"></div>
                <div id="content_img_right">
                    <font id="text_error_sup">404</font><br>
                    <font id="text_error_inf">Opsss, página não encontrada!</font>
                </div>
                <!--<div style="margin: 30px"><img src="http://buzzstream.wpengine.netdna-cdn.com/wp-content/uploads/2012/07/prospector.jpg" width="200"></div>-->
            </div>        
        </div>       
    </div>
    <div id="footer">
    	<?php echo $footer ?>
	</div>
</div>
</body>
</html>