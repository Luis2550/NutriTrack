<?php


class CitasModel{
    private $db;
    private $citas;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->citas = array();
    }

    public function get_Citas(){

        $sql = "SELECT * FROM cita ORDER BY fecha" ;
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->citas[] = $fila;
        }
        return $this->citas;
    }

    public function insertar_Citas($ci_paciente, $fecha, $horas_disponibles, $nutriologa){
        $resultado = $this->db->query("INSERT INTO cita (ci_paciente, ci_nutriologa, fecha, horas_disponibles, estado)
        VALUES ('$ci_paciente','$nutriologa','$fecha','$horas_disponibles','Reservado')");
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

    public function getCINutriologa() {
        $sql = "SELECT ci_nutriologa FROM nutriologa LIMIT 1";
        $resultado = $this->db->query($sql);
    
        if ($resultado) {
            // Obtener el primer valor directamente, asumiendo que solo hay una fila y columna
            $ciNutriologa = $resultado->fetch_assoc()['ci_nutriologa'];
    
            $resultado->free();
    
            return $ciNutriologa;
        } else {
            throw new Exception("Error en la consulta: " . $this->db->error);
        }
    }

    public function getConfiguraciones($ciNutriologa) {
        $configuraciones = array();

        $sql = "SELECT * FROM configuracion WHERE ci_nutriologa = ?";
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $ciNutriologa);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $configuraciones[] = $row;
            }

            $stmt->close();
        } else {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }

        return $configuraciones;
    }
    

    public function modificar_Citas($id_cita, $ci_paciente, $fecha, $hora_inicio, $hora_fin){
			
        $resultado = $this->db->query("UPDATE cita 
        SET fecha='$fecha', hora_inicio='$hora_inicio', hora_fin='$hora_fin' WHERE id_cita = '$id_cita'");			
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

    public function citaYaReservada($ci_paciente, $fecha, $hora_inicio) {
        $sql = "SELECT 1 FROM cita WHERE ci_paciente = '$ci_paciente' AND fecha = '$fecha' AND hora_inicio = '$hora_inicio'";
        $resultado = $this->db->query($sql);
        return $resultado->num_rows > 0;
    }

    public function getCitasPaciente($ci_paciente) {
        $sql = "SELECT * FROM cita WHERE ci_paciente = ? ORDER BY fecha";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $ci_paciente);
            $stmt->execute();
            $result = $stmt->get_result();
            $citasPaciente = array();
    
            while ($row = $result->fetch_assoc()) {
                $citasPaciente[] = $row;
            }
    
            $stmt->close();
    
            return $citasPaciente;
        } else {
            die("Error en la preparación de la consulta: " . $this->db->error);
        }
    }
    
    
}

?>