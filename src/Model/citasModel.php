<?php


class CitasModel{
    private $db;
    private $citas;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->citas = array();
    }

    public function get_Citas(){

        $sql = "SELECT * FROM cita";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->citas[] = $fila;
        }
        return $this->citas;
    }

    public function insertar_Citas($ci_paciente, $fecha, $hora_inicio, $duracion_cita){
        $resultado = $this->db->query("INSERT INTO cita (ci_paciente, fecha, hora_inicio, duracion_cita)
        VALUES ('$ci_paciente','$fecha','$hora_inicio','$duracion_cita')");
    }

    public function getCIPacientes() {
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila['ci_paciente'];
        }

        return $ciPacientes;
    }
    

    public function modificar_Citas($id_cita, $ci_paciente, $fecha, $hora_inicio, $duracion_cita){
			
        $resultado = $this->db->query("UPDATE cita 
        SET fecha='$fecha', hora_inicio='$hora_inicio', duracion_cita='$duracion_cita' WHERE id_cita = '$id_cita'");			
    }

    public function eliminar_Citas($id_cita){

        // Eliminar el usuario después de haber eliminado los registros relacionados
        $resultado = $this->db->query("DELETE FROM cita WHERE id_cita = '$id_cita'");
        
    }
    
    public function get_Cita($id_cita)
    {
        $sql = "SELECT * FROM cita WHERE id_cita='$id_cita' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
}

?>