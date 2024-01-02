<?php

class DetalleComidaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/detalleComidaModel.php";
    }

    public function verDetalleComidas(){

        $detalle_comida = new DetalleComidaModel();
        $data['titulo'] = 'detalle comidas';
        $data['detalle_comida'] = $detalle_comida->get_DetalleComidas();

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


    
}

?>