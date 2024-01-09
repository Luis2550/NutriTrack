<?php

class pacientePlanNutricionalController{

    

    public function __construct(){
        require_once __DIR__ . "/../Model/planNutricionalModel.php";
    }

    public function verPlanNutricional(){
        // Verificar si la variable ci_paciente está presente en la URL
        if (isset($_GET['ci_paciente'])) {
            // Obtener el valor de ci_paciente
            $ci_paciente = $_GET['ci_paciente'];

            $planNutri = new planNutricionalModel();
            $data['titulo'] = ' Plan Nutricional';
            $data['plan_nutricional'] = $planNutri->get_PlanNutricionalesRolPaciente($ci_paciente);
    
            require_once(__DIR__ . '/../View/planNutricional/pacienteVerPlanNutricional.php');
            // Ahora puedes utilizar la variable $ci_paciente en tu código PHP
            //echo "Cédula del paciente: " . $ci_paciente;
        } else {
            // En caso de que ci_paciente no esté presente en la URL
            echo "No se proporcionó la cédula del paciente.";
        }
        
       
    }
    
}

?>