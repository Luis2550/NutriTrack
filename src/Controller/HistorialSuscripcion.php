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


    public function verHistorialSuscripcionSecuencial(){

        $historialsuscripciones = new historialSuscripcionModel();
            // Obtener el valor de 'ci_usuario' de la URL
        $ci_usuario = isset($_GET['ci_usuario']) ? $_GET['ci_usuario'] : null;

        $data['ci_usuario'] = $ci_usuario;

        $data['titulo'] = ' Historial Suscripcion';
        $data['historialsuscripciones'] = $historialsuscripciones->get_HistorialSuscripciones();
        
        require_once(__DIR__ . '/../View/historialSuscripcion/ver_HistorialSuscripcionSecuencial.php');
    }

     

    public function nuevoHistorialSuscripcion(){
        $historialsuscripciones = new historialSuscripcionModel();
        $data['usuarios'] = $historialsuscripciones->getCiPaciente();
        $data['opciones_suscripcion'] = $historialsuscripciones->getSuscripcion();
       
        $data['titulo'] = ' Historial Suscripcion';
        require_once(__DIR__ . '/../View/historialSuscripcion/nuevoHistorialSuscripcion.php');
    }
    

    public function guardarHistorialSuscripcion() {
        $id_suscripcion = $_POST['id_suscripcion'];
        $ci_usuario = isset($_POST['ci_usuario']) ? $_POST['ci_usuario'] : null;
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $estado = "SUSCRITO";
    
        $historialsuscripciones = new historialSuscripcionModel();
    
        // Verificar si el número de cédula ya existe
        $historialExistente = $historialsuscripciones->getSuscripcionUsuarios($ci_usuario);
    
        // Modificación en la condición para verificar la fecha_inicio
        if (!empty($historialExistente) && ($historialExistente[0]['fecha_inicio'] == null || $historialExistente[0]['fecha_inicio'] == '0000-00-00')) {
            // No hay historial existente o la fecha_inicio es nula o igual a '0000-00-00', intentar insertar
            try {
                // Intentar insertar el historial de suscripción
                $historialsuscripciones->modificarHistorialSuscripcion($id_suscripcion, $ci_usuario, $fecha_inicio, $fecha_fin, $estado);
                $data["titulo"] = "Historial Suscripcion";
    
                // Agrega mensajes de depuración
                echo '<div class="success-message">Historial de Suscripción insertado correctamente</div>';
                $this->verHistorialSuscripcion();
            } catch (Exception $e) {
                // Agrega mensajes de depuración
    
                // Manejar la excepción general
                echo '<div class="error-message">Error al guardar historial de suscripción: ' . $e->getMessage() . '</div>';
            }
        } else {
            echo '<div class="error-message">El historial de suscripción ya existe para este número de cédula. No se realizó ninguna inserción.</div>';
        }
    }
    
    
    
    public function modificarHistorialSuscripcion($id){
			
        $historialsuscripciones = new historialSuscripcionModel();
        $data["historialsuscripciones"] = $historialsuscripciones->get_HistorialSuscripcion($id);
        $data2['opciones_suscripcion'] = $historialsuscripciones->getSuscripcion();
        $data["titulo"] = " Historial Suscripcion";
        require_once(__DIR__ . '/../View/historialSuscripcion/modificarHistorialSuscripcion.php');
    }

    public function datosUsuarioSuscrito($id){
			
        $historialsuscripciones = new historialSuscripcionModel();
        $data["historialsuscripciones"] = $historialsuscripciones->get_suscripcion_historialSuscrito($id);
        $data["titulo"] = " Historial Suscripcion";
        // require_once(__DIR__ . '/../View/historialSuscripcion/modificarHistorialSuscripcion.php');
    }
    
    public function actualizarHistorialSuscripcion(){

        $id_suscripcion = $_POST['id_suscripcion'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $estado="SUSCRITO";
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->modificarHistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado);
        $data["titulo"] = " Historial Suscripcion";
        header('Location: http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=verHistorialSuscripcionSecuencial&ci_usuario='. $ci_paciente);
        exit();
    }

    public function eliminarHistorialSuscripcion($id){
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->eliminarHistorialSuscripcion($id);
        $data["titulo"] = " Historial Suscripcion";
        $this->verHistorialSuscripcion();
    }

    
   
}

?>