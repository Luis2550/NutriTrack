<?php

class HistorialSuscripcionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/historialSuscripcionModel.php";
    }

    public function verHistorialSuscripcion(){

        $historialsuscripciones = new historialSuscripcionModel();
        $data['titulo'] = ' Historial Suscripcion';
        $data['historialsuscripciones'] = $historialsuscripciones->get_HistorialSuscripciones();

        require_once(__DIR__ . '/../View/historialSuscripcion/ver_HistorialSuscripcion.php');
    }


    
    public function nuevoHistorialSuscripcion(){
        $historialsuscripciones = new historialSuscripcionModel();
        $data['opciones_paciente'] = $historialsuscripciones->getCiPaciente();
        $data['opciones_suscripcion'] = $historialsuscripciones->getSuscripcion();
        $data['titulo'] = ' Historial Suscripcion';
        require_once(__DIR__ . '/../View/historialSuscripcion/nuevoHistorialSuscripcion.php');
    }



    public function guardarHistorialSuscripcion(){
        
        $id_suscripcion = $_POST['id_suscripcion'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->insertar_HistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin);
        $data["titulo"] = " Historial Suscripcion";
        $this->verHistorialSuscripcion();
    }



    public function modificarHistorialSuscripcion($id){
			
        $historialsuscripciones = new historialSuscripcionModel();
        $data["historialsuscripciones"] = $historialsuscripciones->get_HistorialSuscripcion($id);
        $data2['opciones_suscripcion'] = $historialsuscripciones->getSuscripcion();
        $data["titulo"] = " Historial Suscripcion";
        require_once(__DIR__ . '/../View/historialSuscripcion/modificarHistorialSuscripcion.php');
    }
    
    public function actualizarHistorialSuscripcion(){

        $id_suscripcion = $_POST['id_suscripcion'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->modificarHistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin);
        $data["titulo"] = " Historial Suscripcion";
        $this->verHistorialSuscripcion();
    }

    public function eliminarHistorialSuscripcion($id){
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->eliminarHistorialSuscripcion($id);
        $data["titulo"] = " Historial Suscripcion";
        $this->verHistorialSuscripcion();
    }

   
}

?>