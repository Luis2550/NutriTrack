<?php

class DetalleComidaController{

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

    public function insertar_or_verDetalleComidas($id){
        $detalle_comida = new DetalleComidaModel();
        $hayComidasPlanNutricional = $detalle_comida->getHayComidasPlanNutricional($id);
        
        if($hayComidasPlanNutricional){
            $data['titulo'] = 'detalle comidas';
            $data['detalle_comida'] = $detalle_comida->get_DetalleComidasId($id);
            $data_comida['comidas'] = $detalle_comida->get_Comidas();
            #$data['datos_paciente'] = $detalle_comida->get_DatosPacienteId
            require_once __DIR__ . "/../View/detalle_comida/verDetalleComida.php";
        }
        else{
            $data['titulo'] = 'detalle comidas';
            $data['detalle_comida'] = $detalle_comida->get_Semana_Plan_Nutri($id);
            $data_comida['comidas'] = $detalle_comida->get_Comidas();
            require_once __DIR__ . "/../View/detalle_comida/insertarDetalleComida.php";
        }
    }

    public function guardarComidaPlanNutricional() {
        
        //echo "Datos recibidos en guardarComidaPlanNutricional: ";
        //$datosComidas = $_POST['datosComidas'];
        //var_dump($datosComidas);
        
        // Crear una instancia del modelo
        //$detalleComidaModel = new DetalleComidaModel();

        // Obtener los datos del cuerpo de la solicitud
        $datosComidas = json_decode($_POST['datosComidas'], true);

        // Crear una instancia del modelo
        $detalleComidaModel = new DetalleComidaModel();

        // Iterar sobre los días y tipos de comida
        foreach ($datosComidas as $dia => $comidasPorDia) {
            foreach ($comidasPorDia as $comida) {
                // Obtener la información relevante
                $idComida = $comida['id_comida'];
                $idPlanNutricional = $comida['id_plan_nutricional'];
                $diaActual = $comida['dia'];

                // Llamar al método del modelo para insertar en la base de datos
                $resultado = $detalleComidaModel->insertarComidaPlanNutricional($idComida, $idPlanNutricional, $diaActual);

                // Verificar el resultado y enviar una respuesta al cliente
                if ($resultado) {
                    $detalle_comida = new DetalleComidaModel();
                    //$hayComidasPlanNutricional = $detalle_comida->getHayComidasPlanNutricional($idPlanNutricional);
                    $data['titulo'] = 'detalle comidas';
                    $data['detalle_comida'] = $detalle_comida->get_DetalleComidasId($idPlanNutricional);
                    $this->verPlanNutricional();
                    
                } else {
                    echo json_encode(["message" => "Error al guardar las comidas en la base de datos."]);
                }
            }
        }
        
    }

    public function verDetalleComidas(){

        $detalle_comida = new DetalleComidaModel();
        $data['titulo'] = 'detalle comidas';
        $data['detalle_comida'] = $detalle_comida->get_DetalleComidas();
        echo $data['detalle_comida']['fecha_inicio'];
        require_once(__DIR__ . '/../View/detalle_comida/verDetalleComida.php');
    }

    public function traerDetalleComidas($id){
        $detalle_comida = new DetalleComidaModel();
        $data['titulo'] = 'detalle comidas';
        $data['detalle_comida'] = $detalle_comida->get_DetalleComidasId($id);

        require_once(__DIR__ . '/../View/detalle_comida/verDetalleComida.php');
    }

    public function nuevoDetalleComida($id_plan_nutri){
        $data['titulo'] = 'Enfermedad Previa';
         $enfermedadesprev = new enfermedadPreviaModel();
         // Obtener opciones para ci_nutriologa y ci_paciente
         $data['opciones_pacientes'] = $enfermedadesprev->getCIPacientes();
        require_once(__DIR__ . '/../View/enfermedad/nuevoEnfermedadPrevia.php');
    }

    public function modificarDetalleComidaPlanNutricional(){
        $id_plan_nutricion = $_POST['id_plan_nutricional'];
        $id_comida_act = $_POST['id_comida_act'];
        $id_comida_nuev = $_POST['id_comida_nuev'];
        $dia = $_POST['dia'];
        //var_dump($id_plan_nutricion, $id_comida_act, $id_comida_nuev, $dia);

        $detalle_comida = new DetalleComidaModel();
        $detalle_comida->actualizarDetalleComida($id_plan_nutricion, $id_comida_act, $id_comida_nuev, $dia );
        $data["titulo"] = "Detalle Comida";
        $this->insertar_or_verDetalleComidas($id_plan_nutricion);
    }

    public function eliminarDetalleComida($id){

        $detalle_comida = new DetalleComidaModel();
        $detalle_comida->eliminarDetalleComida($id);
        $data["titulo"] = "Detalle Comida";
        $this->insertar_or_verDetalleComidas($id);
    }


    
}

?>