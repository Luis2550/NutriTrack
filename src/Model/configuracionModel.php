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

    public function getNombreNutriologa() {
        $sql = "SELECT u.nombres, u.apellidos, n.ci_nutriologa FROM usuario as u inner join nutriologa as n on n.ci_nutriologa = u.ci_usuario;";
        $resultado = $this->db->query($sql);

        return $resultado;
    }

   
    public function insertar_Configuraciones($ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita){
        $resultado = $this->db->query("INSERT INTO configuracion (ci_nutriologa, hora_inicio_manana, hora_fin_manana, hora_inicio_tarde, hora_fin_tarde, dias_semana, duracion_cita)
        VALUES ('$ci_nutriologa', '$hora_inicio_manana', '$hora_fin_manana', '$hora_inicio_tarde', '$hora_fin_tarde', '$dias_semana', '$duracion_cita')");
    }
    

    
    public function get_Configuracion($id){
        $resultado = $this->db->query("SELECT * FROM configuracion WHERE id_configuracion = '$id'");
        return $resultado->fetch_assoc();
    }
    
    public function modificar_Configuraciones($id_configuracion, $ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita){
        $resultado = $this->db->query("UPDATE configuracion
            SET ci_nutriologa='$ci_nutriologa', hora_inicio_manana='$hora_inicio_manana', hora_fin_manana='$hora_fin_manana', hora_inicio_tarde='$hora_inicio_tarde', hora_fin_tarde='$hora_fin_tarde', dias_semana='$dias_semana', duracion_cita='$duracion_cita'
            WHERE id_configuracion = '$id_configuracion'");
    }
    
    public function eliminarConfiguraciones($id){
			
        $resultado = $this->db->query("DELETE FROM configuracion WHERE id_configuracion = '$id'");
        
    }

}

?>