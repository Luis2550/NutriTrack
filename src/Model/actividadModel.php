<?php


class actividadModel{
    private $db;
    private $acti;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->acti = array();
    }

    public function get_actividades(){

        $sql = "SELECT * FROM actividad";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->acti[] = $fila;
        }
        return $this->acti;
    }

    public function insertar_actividad($ci_paciente,$actividad,$descripcion,$fecha){
        $resultado = $this->db->query("INSERT INTO actividad(ci_paciente,actividad,descripcion,fecha) VALUES ('$ci_paciente', '$actividad', '$descripcion', '$fecha')");

    }

    //aqui poner el get Ci historial clinico
    public function getCIpaciente() {
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPaci = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPaci[] = $fila['ci_paciente'];
        }

        return $ciPaci;
    }
    public function modificar_actividad($id,$ci_paciente,$actividad,$descripcion,$fecha){
			
        $resultado = $this->db->query("UPDATE actividad
        SET  ci_paciente='$ci_paciente', actividad='$actividad' , descripcion='$descripcion' , fecha='$fecha' WHERE id_actividad = '$id'");			
    }

    public function eliminar_actividad($id){
			
        $resultado = $this->db->query("DELETE FROM actividad WHERE id_actividad = '$id'");
        
    }
    
    
    public function get_actividad($id)
    {
        

        $stmt = $this->db->prepare("SELECT * FROM actividad WHERE id_actividad = ?");
        
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