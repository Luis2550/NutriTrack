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
    
        $suscripcion = new SuscripcionModel();
        
        // Verificar si la suscripción ya existe
        $suscripcionExistente = $suscripcion->getSuscripcionExistente($suscripciondato);
    
        if (!empty($suscripcionExistente)) {
            // La suscripción ya existe
            $data["mensaje"] = '<div class="error-message">La suscripción ya existe. No se realizó ninguna inserción.</div>';
        } else {
            // No hay suscripción existente, intentar insertar
            try {
                // Intentar insertar la suscripción
                $resultado = $suscripcion->insertar_Suscripcion($suscripciondato, $duracion_dias);
    
                if ($resultado) {
                    $data["mensaje"] = '<div class="success-message">La suscripción se ha guardado correctamente.</div>';
                } else {
                    $data["mensaje"] = '<div class="error-message">Hubo un problema al guardar la suscripción. Inténtalo de nuevo.</div>';
                }
            } catch (Exception $e) {
                // Manejar la excepción general
                $data["mensaje"] = '<div class="error-message">Error al guardar la suscripción: ' . $e->getMessage() . '</div>';
            }
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

        $suscripcion = new SuscripcionModel();
        $suscripcion->modificar_Suscripcion($id_suscripcion, $suscripciondato, $duracion_dias);
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