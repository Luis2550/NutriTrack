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
    

}

?>