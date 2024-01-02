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
        $estado = $_POST['estado'];
    
        $historialsuscripciones = new historialSuscripcionModel();
    
        // Verificar si el número de cédula ya existe
        $historialExistente = $historialsuscripciones->getSuscripcionUsuarios($ci_usuario);
    
        if (!empty($historialExistente)) {
            // El historial de suscripción ya existe para este número de cédula
            echo  "El historial de suscripción ya existe para este número de cédula. No se realizó ninguna inserción.";
        } else {
            // No hay historial existente, intentar insertar
            try {
                // Intentar insertar el historial de suscripción
                $historialsuscripciones->insertar_HistorialSuscripcion($id_suscripcion, $ci_usuario, $fecha_inicio, $fecha_fin, $estado);
                $data["titulo"] = "Historial Suscripcion";
    
                // Agrega mensajes de depuración
                echo "Historial de Suscripción insertado correctamente";
    
                // Evitar llamar a ver_citas_paciente si ha ocurrido una excepción
               
                
            } catch (Exception $e) {
                // Agrega mensajes de depuración
                
    
                // Manejar la excepción general
                echo  'Error al guardar historial de suscripción: ' . $e->getMessage();
                header('Location: http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=verHistorialSuscripcion&error_message=' . urlencode($error_message));
                exit();
            }
        }
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
        $estado=$_POST['estado'];
        
        $historialsuscripciones = new historialSuscripcionModel();
        $historialsuscripciones->modificarHistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado);
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