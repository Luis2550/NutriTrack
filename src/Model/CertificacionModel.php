<?php


class CertificacionModel{
    private $db;
    private $certificacion;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->certificacion = array();
    }

    public function get_Certificaciones(){

        $sql = "SELECT * FROM certificacion";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->certificacion[] = $fila;
        }
        return $this->certificacion;
    }

    public function insertar_Certificacion($ci_nutriologa, $titulo, $archivo){
        $resultado = $this->db->query("INSERT INTO certificacion (ci_nutriologa, titulo, archivo)
        VALUES ('$ci_nutriologa','$titulo','$archivo')");
    }    

    public function modificar_Certificacion($id_certificacion,$ci_nutriologa, $titulo, $archivo){
			
        $resultado = $this->db->query("UPDATE certificacion 
        SET ci_nutriologa='$ci_nutriologa', titulo='$titulo', archivo='$archivo' WHERE id_certificacion = '$id_certificacion'");			
    }

    public function getCINutriologa() {
        $sql = "SELECT ci_nutriologa FROM nutriologa";
        $resultado = $this->db->query($sql);
        $ciNutriologa = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciNutriologa[] = $fila['ci_nutriologa'];
        }

        return $ciNutriologa;
    }

    public function eliminar_Certificacion($id_certificacion){

        // Eliminar el usuario después de haber eliminado los registros relacionados
        $resultado = $this->db->query("DELETE FROM certificacion WHERE id_certificacion = '$id_certificacion'");
        
    }
    
    public function get_Certificacion($id_certificacion)
    {
        $sql = "SELECT * FROM certificacion WHERE id_certificacion='$id_certificacion' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
 
}

?>