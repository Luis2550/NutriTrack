<?php

class planNutricionalController{

    public function __construct(){
        require_once __DIR__ . "/../Model/planNutricionalModel.php";
    }

    public function verPlanNutricional(){

        $planNutri = new planNutricionalModel();
        $data['titulo'] = 'plan_nutricional';
        $data['plan_nutricional'] = $planNutri->get_PlanNutricionales();

        require_once(__DIR__ . '/../View/planNutricional/verPlanNutricional.php');
    }

    public function nuevoPlanNutricional() {
        $data['titulo'] = ' plan_nutricional';

        // Instancia de la clase planNutricionalModel
        $planNutri = new planNutricionalModel();
        
        // Obtener opciones para ci_nutriologa y ci_paciente
        $data['opciones_nutriologa'] = $planNutri->getCINutriologas();
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $planNutri->getCIPacientes();

        require_once(__DIR__ . '/../View/planNutricional/nuevoPlanNutricional.php');
    }
    public function guardarPlanNutricional(){
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_inicio = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];
        $duracion_dias = $_POST['duracionDias'];
        
        $planNutri = new  planNutricionalModel();
        $planNutri->insertar_planNutricional($ci_nutriologa, $ci_paciente, $duracion_dias , $fecha_fin, $fecha_inicio);
        $data["titulo"] = "plan_nutricional";
        $this->verPlanNutricional();
    }

    public function modificarPlanNutricional($id){
			
        $planNutri = new  planNutricionalModel();
        
        $data["id_plan_nutricional"] = $id;
        $data["plan_nutricional"] = $planNutri->get_PlanNutricional($id);
        $data["titulo"] = "plan_nutricional";
        require_once(__DIR__ . '/../View/planNutricional/modificarPlanNutricional.php');
    }
    
    public function actualizarPlanNutricional(){

        $id = $_POST['id_plan_nutricional'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $ci_paciente = $_POST['ci_paciente'];
        $duracion_dias = $_POST['duracionDias'];
        $fecha_fin = $_POST['fecha_fin'];
        $fecha_inicio = $_POST['fecha_inicio'];
       
        $planNutri = new  planNutricionalModel();
        $planNutri->modificar_planNutricional($id, $ci_nutriologa, $ci_paciente, $duracion_dias , $fecha_fin, $fecha_inicio);
        $data["titulo"] = "plan_nutricional";
        $this->verPlanNutricional();
    }
    
    public function eliminarPlanNutricional($id){
        
        $planNutri = new  planNutricionalModel();
        $planNutri->eliminar_planNutricional($id);
        $data["titulo"] = "plan_nutricional";
        $this->verPlanNutricional();
    }

    
}

?>