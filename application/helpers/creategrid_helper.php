<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 Helper Baseado no http://keith-wood.name/realPerson.html
 versão 1.1.1
*/

if ( ! function_exists('montagrid')){
	
	function montagrid($list){

			$cont = 0;
			$grid = "";
			$ci = get_instance();
				
			foreach($list as $row){
				($cont % 2 == 0) ? $color = "background-color: #cee6fe;" : $color = "background-color: #fff;"; $cont++;
	
					  $grid .= "<div class='rowDiv' style='$color'>
									<div class='cellDiv'>". date('d-m-Y', strtotime($row->car_data)) ."</div>
									<div class='cellDiv'>". $row->mar_marca ."</div>
									<div class='cellDiv'>". $row->car_modelo ."</div>
									<div class='cellDiv'>". $row->car_ano ."</div>
									<div class='cellDiv'><a href='../../assets/images/uploads/". $row->car_foto ."' class='nivoZoom'>
										<img src='../../assets/images/uploads/". $row->car_foto ."' style='border:none' width='25' height='25'></a></div>
									<div class='cellDiv'>". number_format($row->car_valor,2,',','.') ."</div>
									<div class='cellDiv'>". $row->car_nro_parcelas.'X' ."</div>
									<div class='cellDiv'>". number_format($row->car_valor_total_juros_mes,2,',','.') ."</div>
									<div class='cellDiv'>". $row->cad_nome ."</div>                    
									<div class='cellDiv lastCell'>";
									
									if($ci->session->userdata('admin')){
									  $grid .= "<a style='margin:0;' href='lista/delete/". $row->id ."' style='cursor:pointer; border: 0'>
													<img src='../../assets/images/delete.png' width='16' height='16' title='Excluir Registro'>
												</a>";
									}
						 $grid .= "</div>
								</div>";
		   }                          
			
			return $grid;

	}
	
}