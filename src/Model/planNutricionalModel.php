<?php


class planNutricionalModel{
    private $db;
    private $planNutri;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->planNutri = array();
    }

    public function get_PlanNutricionales(){

        $sql = "SELECT * FROM plan_nutricional";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->planNutri[] = $fila;
        }
        return $this->planNutri;
    }

    public function insertar_planNutricional($ci_nutriologa, $ci_paciente, $duracion_dias , $fecha_fin, $fecha_inicio){
        $resultado = $this->db->query("INSERT INTO plan_nutricional(ci_nutriologa,ci_paciente,fecha_inicio,fecha_fin,duracion_dias)
        VALUES ('$ci_nutriologa', '$ci_paciente', '$fecha_inicio', '$fecha_fin', '$duracion_dias')");
    }

    public function modificar_planNutricional($id, $ci_nutriologa, $ci_paciente, $duracion_dias, $fecha_fin, $fecha_inicio){
        $resultado = $this->db->query("UPDATE plan_nutricional 
            SET ci_nutriologa='$ci_nutriologa', ci_paciente='$ci_paciente', duracion_dias='$duracion_dias',  fecha_fin='$fecha_fin', fecha_inicio='$fecha_inicio'  WHERE id_plan_nutricional = '$id'");			
    }

    public function eliminar_planNutricional($id){
			
        $resultado = $this->db->query("DELETE FROM plan_nutricional WHERE id_plan_nutricional = '$id'");
        
    }
    
    public function get_planNutricional($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM plan_nutricional WHERE id_plan_nutricional = ?");
        
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


    public function getCIPacientes() {
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila['ci_paciente'];
        }

        return $ciPacientes;
    }
    public function getCINutriologas() {
        $sql = "SELECT ci_nutriologa FROM nutriologa";
        $resultado = $this->db->query($sql);
        $ciNutriologas = array();
    
        while ($fila = $resultado->fetch_assoc()) {
            $ciNutriologas[] = $fila['ci_nutriologa'];
        }
    
        return $ciNutriologas;
    }
    
}

?>