<?php


class planNutricionalModel{
    private $db;
    private $planNutri;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->planNutri = array();
    }

    public function get_PlanNutricionales(){

        $sql = "SELECT pn.id_plan_nutricional, u.ci_usuario, u.nombres, u.apellidos, u.edad, u.sexo, pn.fecha_inicio, pn.fecha_fin, pn.duracion_dias FROM plan_nutricional AS pn JOIN usuario AS u ON u.ci_usuario = pn.ci_paciente
        order by u.nombres, u.apellidos,pn.fecha_inicio, pn.fecha_fin asc";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->planNutri[] = $fila;
        }
        return $this->planNutri;
    }

    public function get_DatosModificarPlan($id_plan){


        //var_dump($id_plan);

        $sql = "SELECT pn.id_plan_nutricional, pn.ci_nutriologa, u.ci_usuario, u.nombres, u.apellidos, hs.fecha_fin AS fin_suscripcion, hs.estado, pn.fecha_inicio, pn.fecha_fin, pn.duracion_dias FROM plan_nutricional AS pn 
        JOIN usuario AS u ON pn.ci_paciente = u.ci_usuario
        JOIN historial_suscripcion AS hs ON hs.ci_paciente = pn.ci_paciente
        WHERE pn.id_plan_nutricional = '$id_plan' AND (hs.estado = 'SUSCRITO' OR hs.estado = 'suscrito')
        ORDER BY hs.fecha_fin DESC";

        $resultado = $this->db->query($sql);

        

        while($fila = $resultado->fetch_assoc()){
            $this->planNutri[] = $fila;
        }

        //var_dump($this->planNutri);

        return $this->planNutri;
    }

    public function get_PlanNutricionalesRolPaciente($ci){

        $sql = "SELECT pn.id_plan_nutricional, u.ci_usuario, u.nombres, u.apellidos, u.edad, u.sexo, pn.fecha_inicio, pn.fecha_fin, pn.duracion_dias 
        FROM plan_nutricional AS pn 
        JOIN usuario AS u ON u.ci_usuario = pn.ci_paciente
        WHERE u.ci_usuario = '$ci'
        order by u.nombres, u.apellidos,pn.fecha_inicio, pn.fecha_fin asc";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->planNutri[] = $fila;
        }
        return $this->planNutri;
    }

    public function get_comidasDiaPaciente($ci, $dia, $fecha){

        $sql = "SELECT pn.*, u.*, dc.*, c.*, tc.id_tipo_comida, tc.tipo_comida
        FROM plan_nutricional AS pn 
        JOIN usuario AS u ON u.ci_usuario = pn.ci_paciente
        JOIN detalle_comida AS dc ON dc.id_plan_nutricional = pn.id_plan_nutricional
        JOIN comida AS c ON c.id_comida = dc.id_comida
        JOIN tipo_comida AS tc ON tc.id_tipo_comida = c.id_tipo_comida
        WHERE u.ci_usuario = '$ci' AND '$fecha' BETWEEN pn.fecha_inicio AND pn.fecha_fin AND dc.dia = '$dia';";
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

    public function getFechasSuscripcion(){
        $sql = "SELECT hs.fecha_fin, hs.estado, hs.ci_paciente FROM `historial_suscripcion` AS hs 
        JOIN plan_nutricional AS pn ON pn.ci_paciente = hs.ci_paciente
        WHERE (hs.estado = 'SUSCRITO' OR hs.estado = 'suscrito')
        ORDER BY hs.fecha_fin DESC";

        $resultado = $this->db->query($sql);
        $fechas = array();

        while ($fila = $resultado->fetch_assoc()) {
            $fechas[] = $fila;
        }

        return $fechas;
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
        $sql = "SELECT p.ci_paciente, u.nombres, u.apellidos, hs.fecha_fin, hs.estado FROM paciente AS p 
        JOIN usuario AS u on u.ci_usuario = p.ci_paciente
        JOIN historial_suscripcion AS hs ON hs.ci_paciente = p.ci_paciente
        WHERE (hs.estado = 'SUSCRITO' OR hs.estado = 'suscrito')
        ORDER BY hs.fecha_fin DESC";

        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila;
        }

        return $ciPacientes;
    }
    public function getCINutriologas() {
        $sql = "SELECT ci_nutriologa FROM nutriologa WHERE 1";
        $resultado = $this->db->query($sql);
        $ciNutriologas = array();
    
        while ($fila = $resultado->fetch_assoc()) {
            $ciNutriologas[] = $fila['ci_nutriologa'];
        }
    
        return $ciNutriologas;
    }
    
}

?>