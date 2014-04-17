// Efeito "Flutuante" + "Sombra" no Header de busca
$(document).scroll(function () {
    var scr = $(this).scrollTop();
    if(scr > 1){
		$("#header").addClass("header_floating"); 
		$("#header").css({"position":"fixed", "top":"0"});
	}else if(scr < 10){		
		$("#header").removeClass("header_floating");
		$("#header").css({"position":"absolute", "top":"0"});		
	}
});
