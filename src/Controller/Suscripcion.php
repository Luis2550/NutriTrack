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
        
        $suscripcion = new SuscripcionModel();
        $suscripcion->insertar_Suscripcion($suscripciondato, $duracion_dias);
        $data["titulo"] = "Suscripcion";
        $this->verSuscripcion();
    }*/
    public function guardarSuscripcion() {
        $suscripciondato = isset($_POST['suscripciondato']) ? strtoupper($_POST['suscripciondato']) : '';
        $duracion_dias = isset($_POST['duracion_dias']) ? intval($_POST['duracion_dias']) : 0;
        $data["messages"] = array();
        $suscripcion = new SuscripcionModel();
        // Validar campos vacíos
        if (empty($suscripciondato) || empty($duracion_dias)) {
            $data["messages"]["error"] = "Error: Todos los campos son obligatorios.";
            $data['titulo'] = 'suscripcion';
            require_once(__DIR__ . '/../View/suscripcion/nuevoSuscripcion.php');
            return;
        }
    
        // Validar que suscripciondato solo contenga letras
        if (!ctype_alpha($suscripciondato)) {
            $data["messages"]["error"] = "Error: El campo Suscripcion solo puede contener letras.";
            $data['titulo'] = 'suscripcion';
            require_once(__DIR__ . '/../View/suscripcion/nuevoSuscripcion.php');
            return;
        }
    
        // Verificar si la suscripción ya existe
        $suscripcionExistente = $suscripcion->getSuscripcionExiste($suscripciondato);
    
        if ($suscripcionExistente) {
            // La suscripción ya existe
            $data["messages"]["error"] = "Error: La suscripción ya existe. No se realizó ninguna inserción.";
            $data['titulo'] = 'suscripcion';
            require_once(__DIR__ . '/../View/suscripcion/nuevoSuscripcion.php');
        } else {
            // Intentar insertar la suscripción
            $resultado = $suscripcion->insertar_Suscripcion($suscripciondato, $duracion_dias);
            $data["messages"]["success"] = "La suscripción se ha guardado correctamente";
            $data["titulo"] = "Suscripcion";
            // header('Location: http://localhost/Nutritrack/index.php?c=Suscripcion&a=verSuscripcion'); // Redirigir a verSuscripcion
            // exit;
            require_once(__DIR__ . '/../View/suscripcion/nuevoSuscripcion.php');
        }
    }
    

    public function modificarSuscripcion($id_suscripcion){
			
        $suscripcion = new SuscripcionModel();
        
        $data["suscripcion"] = $id_suscripcion;
        $data["suscripcion"] = $suscripcion->get_OneSuscripcion($id_suscripcion);
        $data["titulo"] = "suscripcion";
        require_once(__DIR__ . '/../View/suscripcion/modificarSuscripcion.php');
    }
    
    public function actualizarSuscripcion()
{
    $data = array();
    $data["messages"] = array();

    // Validar que los campos no estén vacíos
    if (empty($_POST['id_suscripcion']) || empty($_POST['suscripcion']) || empty($_POST['duracion_dias'])) {
        $data["messages"]["error"] = "Error: Todos los campos son obligatorios.";
        $data['titulo'] = 'suscripcion';

        // Mostrar el mensaje de error directamente en lugar de redirigir
        $data["suscripcion"]["id_suscripcion"] = $_POST['id_suscripcion'];
        $data["suscripcion"]["suscripcion"] = $_POST['suscripcion'];
        $data["suscripcion"]["duracion_dias"] = $_POST['duracion_dias'];

        require_once(__DIR__ . '/../View/suscripcion/modificarSuscripcion.php');
        return;
    }

    $id_suscripcion = $_POST['id_suscripcion'];
    $suscripciondato = $_POST['suscripcion'];
    $duracion_dias = $_POST['duracion_dias'];

    // Validar que suscripciondato solo contenga letras o números
    if (!ctype_alpha($suscripciondato)) {
        $data["messages"]["error"] = "Error: El campo Suscripcion solo puede contener letras.";
        $data['titulo'] = 'suscripcion';

        // Mostrar el mensaje de error directamente en lugar de redirigir
        $data["suscripcion"]["id_suscripcion"] = $id_suscripcion;
        $data["suscripcion"]["suscripcion"] = $suscripciondato;
        $data["suscripcion"]["duracion_dias"] = $duracion_dias;

        require_once(__DIR__ . '/../View/suscripcion/modificarSuscripcion.php');
        return;
    }

    // Otras validaciones si es necesario

    // Intentar modificar la suscripción
    $suscripcion = new SuscripcionModel();
    $resultado = $suscripcion->modificar_Suscripcion($id_suscripcion, $suscripciondato, $duracion_dias);

    if ($resultado) {
        $data["messages"]["error"] = "Error: No se pudo actualizar la suscripción.";
    } else {
        $data["messages"]["success"] = "La suscripción se ha actualizado correctamente";
    }

    // Agrega las líneas siguientes para mantener los valores en los campos
    $data["suscripcion"]["id_suscripcion"] = $id_suscripcion;
    $data["suscripcion"]["suscripcion"] = $suscripciondato;
    $data["suscripcion"]["duracion_dias"] = $duracion_dias;

    $data['titulo'] = 'suscripcion';
    require_once(__DIR__ . '/../View/suscripcion/modificarSuscripcion.php');
}



    
    
    
    

    public function eliminarSuscripcion($id_suscripcion){
        
        $suscripcion = new SuscripcionModel();
        $suscripcion->eliminar_Suscripcion($id_suscripcion);
        $data["titulo"] = "suscripcion";
        $this->verSuscripcion();
    }
    
}

?>