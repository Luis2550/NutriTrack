<?php


class configuracionModel{
    private $db;
    private $configuraciones;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->configuraciones = array();
    }

    public function get_Configuraciones(){

        $sql = "SELECT * FROM configuracion";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->configuraciones[] = $fila;
        }
        return $this->configuraciones;
    }

    public function getCiNutriologa() {
        $sql = "SELECT ci_nutriologa FROM nutriologa";
        $resultado = $this->db->query($sql);
        $ciNutriologa = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciNutriologa[] = $fila['ci_nutriologa'];
        }

        return $ciNutriologa;
    }

   
    public function insertar_Configuraciones($ci_nutriologa, $dias_laborales, $duracion_cita){
        $resultado = $this->db->query("INSERT INTO configuracion(ci_nutriologa, dias_laborales, duracion_cita) VALUES ('$ci_nutriologa', '$dias_laborales', '$duracion_cita')");

    }

    
    public function modificar_Configuraciones( $id_configuracion, $ci_nutriologa, $dias_laborales, $duracion_cita){
			
        $resultado = $this->db->query("UPDATE configuracion
        SET ci_nutriologa='$ci_nutriologa', dias_laborales='$dias_laborales', duracion_cita='$duracion_cita' WHERE id_configuracion = '$id_configuracion'");			
    }

    public function get_Configuracion($id)
    {
        $sql = "SELECT * FROM configuracion WHERE id_configuracion='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }

    public function eliminarConfiguraciones($id){
			
        $resultado = $this->db->query("DELETE FROM configuracion WHERE id_configuracion = '$id'");
        
    }

}

?>