<?php

class actividadController{

    public function __construct(){
        require_once __DIR__ . "/../Model/actividadModel.php";
    }

    public function verActividad(){

        $acti = new actividadModel();
        $data['titulo'] = 'actividad';
        $data['actividad'] = $acti->get_actividades();

        require_once(__DIR__ . '/../View/actividades/verActividad.php');
    }

    public function nuevoActividad() {
        $data['titulo'] = 'actividad';

        // Instancia de la clase planNutricionalModel
        $acti = new actividadModel();
        
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $acti->getCIpaciente();

        require_once(__DIR__ . '/../View/actividades/nuevoActividad.php');
    }

    public function guardarActividad(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $actividad = $_POST['actividad'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
   

        $acti = new actividadModel();
        $acti->insertar_actividad($ci_paciente,$actividad,$descripcion,$fecha);
        $data["titulo"] = "actividad";
        $this->verActividad();
    }

    public function modificarActividad($id){
			
        $acti = new actividadModel();
        $data["id_actividad"] = $id;
        $data["actividad"] = $acti->get_actividad($id);
        $data["titulo"] = "actividad";
        require_once(__DIR__ . '/../View/actividades/modificarActividad.php');
    }
    
    public function actualizarActividad(){
        $id = $_POST['id'];
        $ci_paciente = $_POST['ci_paciente'];
        $actividad = $_POST['actividad'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];

        
        $acti= new actividadModel();
        $acti->modificar_actividad($id,$ci_paciente,$actividad,$descripcion,$fecha);
        $data["titulo"] = "actividad";
        $this->verActividad();
    }
    
    
    public function eliminarActividad($id){
        
        $acti = new actividadModel();
        $acti->eliminar_Actividad($id);
        $data["titulo"] = "actividad";
        $this->verActividad();
    }

    
}

?>