<?php


class SuscripcionModel{
    private $db;
    private $suscripcion;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->suscripcion = array();
    }

    public function get_Suscripcion(){

        $sql = "SELECT * FROM suscripcion";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->suscripcion[] = $fila;
        }
        return $this->suscripcion;
    }

    public function insertar_Suscripcion($suscripciondato, $duracion_dias, $estado) {
        $resultado = $this->db->query("INSERT INTO suscripcion (suscripcion, duracion_dias, estado)
            VALUES ('$suscripciondato', '$duracion_dias', '$estado')");
    }

    
    public function modificar_Suscripcion($id_suscripcion, $suscripciondato, $duracion_dias, $estado){
			
        $resultado = $this->db->query("UPDATE suscripcion 
        SET suscripcion='$suscripciondato',  duracion_dias ='$duracion_dias', estado = '$estado'  WHERE id_suscripcion = '$id_suscripcion'");			
    }

    public function eliminar_Suscripcion($id_suscripcion){

        $resultado = $this->db->query("DELETE FROM suscripcion WHERE id_suscripcion = '$id_suscripcion'");
        
    }
    
    public function get_OneSuscripcion($id_suscripcion)
    {
        $sql = "SELECT * FROM suscripcion WHERE id_suscripcion='$id_suscripcion' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }

}

?>