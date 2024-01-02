<?php


class DetalleComidaModel{
    private $db;
    private $detalle_comida;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->detalle_comida = array();
    }

    public function get_DetalleComidas(){

        $sql = "SELECT dcpn.*, c.comida, pn.ci_nutriologa, pn.ci_paciente
        FROM detalle_comida_plan_nutricional dcpn
        JOIN comida c ON dcpn.id_comida = c.id_comida
        JOIN plan_nutricional pn ON dcpn.id_plan_nutricional = pn.id_plan_nutricional";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }
    
    public function get_DetalleComidasId($id_plan_nutri){

        $sql = "SELECT * FROM detalle_comida AS dc 
        JOIN plan_nutricional AS pn ON dc.id_plan_nutricional = pn.id_plan_nutricional 
        JOIN comida AS c on c.id_comida = dc.id_comida 
        JOIN tipo_comida AS tc ON tc.id_tipo_comida = c.id_tipo_comida
        WHERE pn.id_plan_nutricional = '$id_plan_nutri'
        ORDER BY dc.dia";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }
    

}

?>