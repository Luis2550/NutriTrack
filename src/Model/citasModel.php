<?php


class CitasModel{
    private $db;
    private $citas;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->citas = array();
    }

    public function get_Citas(){

        $sql = "SELECT cita.*, usuario.nombres, usuario.apellidos
        FROM cita
        JOIN usuario ON cita.ci_paciente = usuario.ci_usuario
        WHERE DATE(cita.fecha) = CURDATE() AND cita.estado = 'Reservado'
        ORDER BY cita.fecha;
        ";
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

    public function marcar_Cita_Asistida($id_cita) {
        $sql = "UPDATE cita SET estado = 'Asistido' WHERE id_cita = $id_cita";
        $resultado = $this->db->query($sql);
    
        return $resultado; // Devuelve true si la actualización fue exitosa, o false si hubo un error.
    }    

    public function marcar_Cita_No_Asistida($id_cita) {
        $sql = "UPDATE cita SET estado = 'No Asistido' WHERE id_cita = $id_cita";
        $resultado = $this->db->query($sql);
    
        return $resultado; // Devuelve true si la actualización fue exitosa, o false si hubo un error.
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


    public function obtenerDatosNutriologa() {
        $sql = "SELECT 
                    u.ci_usuario AS ci_nutriologa,
                    CONCAT(u.nombres, ' ', u.apellidos) AS nombre_completo
                FROM nutriologa n
                JOIN usuario u ON n.ci_nutriologa = u.ci_usuario
                LIMIT 1";
        $resultado = $this->db->query($sql);
    
        if ($resultado) {
            // Obtener el primer valor directamente, asumiendo que solo hay una fila y columna
            $datosNutriologa = $resultado->fetch_assoc();
    
            $resultado->free();
    
            return $datosNutriologa;
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

    public function getCorreo($id_cita) {
        $sql = "SELECT u.correo
                FROM cita c
                JOIN usuario u ON c.ci_paciente = u.ci_usuario
                WHERE c.id_cita = '$id_cita'
                LIMIT 1";
    
        $resultado = $this->db->query($sql);
    
        if ($resultado && $resultado->num_rows > 0) {
            // Obtener el valor del correo directamente
            $correo = $resultado->fetch_assoc()['correo'];
    
            $resultado->free();
    
            return $correo;
        } else {
            // Devolver null en lugar de lanzar una excepción si no se encuentra el correo
            return null;
        }
    }
    
    
    public function modificar_Citas($id_cita, $ci_paciente, $fecha, $horas_disponibles){
			
        $resultado = $this->db->query("UPDATE cita 
        SET ci_paciente='$ci_paciente', fecha='$fecha', horas_disponibles='$horas_disponibles' WHERE id_cita = '$id_cita'");			
    }

    public function eliminar_Citas($id_cita){
        // Eliminar la cita después de haber eliminado los registros relacionados
        // $resultado = $this->db->query("DELETE FROM cita WHERE id_cita = '$id_cita'");

        $sql = "UPDATE cita SET estado = 'Cancelada' WHERE id_cita = $id_cita";
        $resultado = $this->db->query($sql);
    
        return $resultado; 
    }

    public function eliminar_CitasFutura($id_cita){
        // Eliminar la cita después de haber eliminado los registros relacionados
        $resultado = $this->db->query("DELETE FROM cita WHERE id_cita = '$id_cita'");
    
        return $resultado; 
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