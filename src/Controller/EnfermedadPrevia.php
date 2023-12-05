<?php

class EnfermedadPreviaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/enfermedadPreviaModel.php";
    }

    public function verEnfermedadPrevia(){

        $enfermedadesprev = new enfermedadPreviaModel(); 
        $data['titulo'] = 'Enfermedad Previa';
        $data['enfermedadesprev'] = $enfermedadesprev->get_EnfermedadPrevia(); 
    
        require_once(__DIR__ . '/../View/enfermedad/ver_enfermedad.php');
    }

    public function nuevoEnfermedadPrevia(){
        $data['titulo'] = 'Enfermedad Previa';
         $enfermedadesprev = new enfermedadPreviaModel();
         // Obtener opciones para ci_nutriologa y ci_paciente
         $data['opciones_pacientes'] = $enfermedadesprev->getCIPacientes();
        require_once(__DIR__ . '/../View/enfermedad/nuevoEnfermedadPrevia.php');
    }


    public function guardarEnfermedadPrevia(){
        
        $id_historial_clinico = $_POST['ci_paciente'];
        $enfermedad_previa = $_POST['enfermedad_previa'];
        $descrip_enfermedad = $_POST['descripcion'];
        $fecha_enfermedad = $_POST['fecha'];
        
        $enfermedadesprev = new enfermedadPreviaModel();
        $enfermedadesprev->insertar_EnfermedadPrevia($id_historial_clinico, $enfermedad_previa, $descrip_enfermedad, $fecha_enfermedad );
        $data["titulo"] = "Enfermedad Previa";
        $this->verEnfermedadPrevia();
    }

    public function modificarEnfermedadPrevia($id){
			
        $enfermedadesprev = new enfermedadPreviaModel();
        $data["enfermedadesprev"] = $enfermedadesprev->get_Paciente($id);
        $data["titulo"] = "Enfermedad Previa";
        require_once(__DIR__ . '/../View/enfermedad/modificarEnfermedadPrevia.php');
    }
    
    public function actualizarEnfermedadPrevia(){
        $id_enfermedad_previa = $_POST['id_enfermedad_previa'];
        $enfermedad_previa = $_POST['enfermedad_previa'];
        $descrip_enfermedad = $_POST['descripcion'];
        $fecha_enfermedad = $_POST['fecha'];
        
        $enfermedadesprev = new enfermedadPreviaModel();
        $enfermedadesprev->modificar_EnfermedadPrevia($id_enfermedad_previa, $enfermedad_previa, $descrip_enfermedad, $fecha_enfermedad );
        $data["titulo"] = "Enfermedad Previa";
        $this->verEnfermedadPrevia();
    }
    
    
    public function eliminarEnfermedadPrevia($id){
        
        $enfermedadesprev = new enfermedadPreviaModel();
        $enfermedadesprev->eliminarEnfermedadPrevia($id);
        $data["titulo"] = "Enfermedad Previa";
        $this->verEnfermedadPrevia();
    }
    
}

?>