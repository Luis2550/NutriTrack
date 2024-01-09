<?php

class planNutricionalController{

    public function __construct(){
        require_once __DIR__ . "/../Model/planNutricionalModel.php";
    }

    public function verPlanNutricional(){

        $planNutri = new planNutricionalModel();
        $data['titulo'] = ' Plan Nutricional';
        $data['plan_nutricional'] = $planNutri->get_PlanNutricionales();

        require_once(__DIR__ . '/../View/planNutricional/verPlanNutricional.php');
    }

    public function nuevoPlanNutricional() {
        $data['titulo'] = ' Plan Nutricional';

        // Instancia de la clase planNutricionalModel
        $planNutri = new planNutricionalModel();
        
        // Obtener opciones para ci_nutriologa y ci_paciente
        $data['opciones_nutriologa'] = $planNutri->getCINutriologas();
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $planNutri->getCIPacientes();

        //$data['fechas_suscripcion'] = $planNutri->getFechasSuscripcion();

        //var_dump($data['fechas_suscripcion']);

        require_once(__DIR__ . '/../View/planNutricional/nuevoPlanNutricional.php');
    }
    public function guardarPlanNutricional(){
        try {
            $ci_nutriologa = $_POST['ci_nutriologa'];
            $ci_paciente = $_POST['ci_paciente'];
            $fecha_inicio = $_POST['fecha_ini'];
            $fecha_fin = $_POST['fecha_fin'];
            $duracion_dias = $_POST['duracionDias'];
            
            $planNutri = new  planNutricionalModel();
            $planNutri->insertar_planNutricional($ci_nutriologa, $ci_paciente, $duracion_dias , $fecha_fin, $fecha_inicio);
            $data["titulo"] = ' Plan Nutricional';
            $this->verPlanNutricional();
        } catch (mysqli_sql_exception  $e) {
            $data['error_message'] = "Ya existe un plan nutricional para el paciente en el intervalo de tiempo especificado";
            $data['titulo'] = ' Plan Nutricional';

            // Instancia de la clase planNutricionalModel
            $planNutri = new planNutricionalModel();
            
            // Obtener opciones para ci_nutriologa y ci_paciente
            $data['opciones_nutriologa'] = $planNutri->getCINutriologas();
            
            // Obtener CI de pacientes
            $data['opciones_paciente'] = $planNutri->getCIPacientes();
            require_once(__DIR__ . '/../View/planNutricional/nuevoPlanNutricional.php');
            // Puedes personalizar el mensaje según tu necesidad
        }
    }

    public function modificarPlanNutricional($id){
			
        $planNutri = new  planNutricionalModel();
        $Sid_pn = intval($id);
        //var_dump($Sid_pn);
        $data["id_plan_nutricional"] = $id;
        $data["plan_nutricional"] = $planNutri->get_DatosModificarPlan($Sid_pn);
        //var_dump($data["plan_nutricional"]);
        $data["titulo"] = ' Plan Nutricional';
        require_once(__DIR__ . '/../View/planNutricional/modificarPlanNutricional.php');
    }
    
    public function actualizarPlanNutricional(){

        $id = $_POST['id'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_inicio = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];
        $duracion_dias = $_POST['duracionDias'];
       
        $planNutri = new  planNutricionalModel();
        $planNutri->modificar_planNutricional($id, $ci_nutriologa, $ci_paciente, $duracion_dias , $fecha_fin, $fecha_inicio);
        $data["titulo"] = ' Plan Nutricional';
        $this->verPlanNutricional();
    }
    
    public function eliminarPlanNutricional($id){
        
        $planNutri = new  planNutricionalModel();
        $planNutri->eliminar_planNutricional($id);
        $data["titulo"] = ' Plan Nutricional';
        $this->verPlanNutricional();
    }

    
}

?>