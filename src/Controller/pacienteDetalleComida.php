<?php

class pacienteDetalleComidaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/detalleComidaModel.php";
    }

    public function verPlanNutricional(){
        require_once __DIR__ . '/../Model/planNutricionalModel.php';

        $planNutri = new planNutricionalModel();
        $data['titulo'] = ' Plan Nutricional';
        $data['plan_nutricional'] = $planNutri->get_PlanNutricionales();

        require_once(__DIR__ . '/../View/planNutricional/verPlanNutricional.php');
    }

    public function verDetalleComidas($id){
        $detalle_comida = new DetalleComidaModel();
        $hayComidasPlanNutricional = $detalle_comida->getHayComidasPlanNutricional($id);
        
        if($hayComidasPlanNutricional){
            $data['titulo'] = 'detalle comidas';
            $data['detalle_comida'] = $detalle_comida->get_DetalleComidasId($id);
            $data_comida['comidas'] = $detalle_comida->get_Comidas();
            #$data['datos_paciente'] = $detalle_comida->get_DatosPacienteId
            require_once __DIR__ . "/../View/detalle_comida/pacienteVerDetalleComida.php";
        }
        else{
            $data['titulo'] = 'detalle comidas';
            $data['detalle_comida'] = $detalle_comida->get_Semana_Plan_Nutri($id);
            $data_comida['comidas'] = $detalle_comida->get_Comidas();
            echo "La nutriologa aún no le ha asignado comidas, contáctese con ella";
        }
    }
    
}

?>