<?php
class Lista_Model extends CI_Model{

 
	public function __construct(){
        parent::__construct();
    }


	function getlista(){
        $query = $this->db->query("SELECT 
								   		C.id, car_data, mar_marca, car_modelo, car_ano, car_foto, car_valor, car_nro_parcelas, car_valor_total_juros_mes, cad_nome 
								   FROM carro AS C 
								   INNER JOIN marca AS M 
								   		ON C.id_mar = M.id 
								   INNER JOIN cadastro AS CD 
								   		ON CD.id = C.id_user 
								   ORDER BY car_data");
        return $query->result();
    }	


    function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('carro'); 
		
		return true;
	}

}
?>