<?php

class SuscripcionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/suscripcionModel.php";
    }

    public function verSuscripcion(){

        $suscripcion = new SuscripcionModel();
        $data['titulo'] = 'suscripcion';
        $data['suscripcion'] = $suscripcion->get_Suscripcion();

        require_once(__DIR__ . '/../View/suscripcion/verSuscripcion.php');
    }

    public function nuevoSuscripcion(){
        $data['titulo'] = ' suscripcion';
        require_once(__DIR__ . '/../View/suscripcion/nuevoSuscripcion.php');
    }

    /*public function guardarSuscripcion(){
        
        $suscripciondato = $_POST['suscripcion'];
        $duracion_dias = $_POST['duracion_dias'];
        $estado = $_POST['estado'];
        
        $suscripcion = new SuscripcionModel();
        $suscripcion->insertar_Suscripcion($suscripciondato, $duracion_dias, $estado);
        $data["titulo"] = "Suscripcion";
        $this->verSuscripcion();
    }*/
    public function guardarSuscripcion() {
        $suscripciondato = $_POST['suscripcion'];
        $duracion_dias = $_POST['duracion_dias'];
        $estado = $_POST['estado'];
    
        $suscripcion = new SuscripcionModel();
        $resultado = $suscripcion->insertar_Suscripcion($suscripciondato, $duracion_dias, $estado);
    
        $data["titulo"] = "Suscripcion";
    
        if ($resultado) {
            $data["mensaje"] = "La suscripción se ha guardado correctamente.";
        } else {
            $data["mensaje"] = "Hubo un problema al guardar la suscripción. Inténtalo de nuevo.";
        }
    
        $this->verSuscripcion($data);
    }
    

    public function modificarSuscripcion($id_suscripcion){
			
        $suscripcion = new SuscripcionModel();
        
        $data["suscripcion"] = $id_suscripcion;
        $data["suscripcion"] = $suscripcion->get_OneSuscripcion($id_suscripcion);
        $data["titulo"] = "suscripcion";
        require_once(__DIR__ . '/../View/suscripcion/modificarSuscripcion.php');
    }
    
    public function actualizarSuscripcion(){
        $id_suscripcion = $_POST['id_suscripcion'];
        $suscripciondato = $_POST['suscripcion'];
        $duracion_dias = $_POST['duracion_dias'];
        $estado = $_POST['estado'];

        $suscripcion = new SuscripcionModel();
        $suscripcion->modificar_Suscripcion($id_suscripcion, $suscripciondato, $duracion_dias, $estado);
        $data["titulo"] = "suscripcion";
        $this->verSuscripcion();
    }

    public function eliminarSuscripcion($id_suscripcion){
        
        $suscripcion = new SuscripcionModel();
        $suscripcion->eliminar_Suscripcion($id_suscripcion);
        $data["titulo"] = "suscripcion";
        $this->verSuscripcion();
    }
    
}

?>