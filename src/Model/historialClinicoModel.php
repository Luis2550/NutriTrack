<?php


class historialClinicoModel{
    private $db;
    private $historiaClini;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->historiaClini = array();
    }

    public function get_HistoriasClinicas(){

        $sql = "SELECT * FROM historial_clinico";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->historiaClini[] = $fila;
        }
        return $this->historiaClini;
    }

    public function insertar_historialClinico($ci_paciente, $fecha_creacion){
        $resultado = $this->db->query("INSERT INTO historial_clinico(ci_paciente, fecha_creacion) VALUES ('$ci_paciente', '$fecha_creacion')");

    }

    //aqui poner el get Ci paciente
    public function getCIPacientes() {
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila['ci_paciente'];
        }

        return $ciPacientes;
    }
    public function modificar_historialClinico($id,$ci_paciente, $fecha_creacion){
			
        $resultado = $this->db->query("UPDATE historial_clinico
        SET ci_paciente='$ci_paciente', fecha_creacion='$fecha_creacion' WHERE id_historial_clinico = '$id'");			
    }

    public function eliminar_historialClinico($id){
			
        $resultado = $this->db->query("DELETE FROM historial_clinico WHERE id_historial_clinico = '$id'");
        
    }
    
    
    public function get_historialClinico($id)
    {
        

        $stmt = $this->db->prepare("SELECT * FROM historial_clinico WHERE id_historial_clinico = ?");
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $id);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
    
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                $stmt->close();
                return $fila;
            } else {
                // Manejo del error al obtener el resultado.
                // Puedes agregar un mensaje de registro o lanzar una excepción según tus necesidades.
                $stmt->close();
                return null;
            }
        } else {
            // Manejo del error en la preparación de la
     }
    }
}

?>