<?php

class actividadController{

    public function __construct(){
        require_once __DIR__ . "/../Model/actividadModel.php";
    }

    public function verActividad(){

        $acti = new actividadModel();
        $data['titulo'] = 'actividad';
        $data['actividad'] = $acti->get_actividades();

        require_once(__DIR__ . '/../View/nutriologa/actividades/verActividad.php');
    }

    public function nuevoActividad() {
        $data['titulo'] = 'actividad';

        // Instancia de la clase planNutricionalModel
        $acti = new actividadModel();
        
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $acti->getCIpaciente();

        require_once(__DIR__ . '/../View/pacientes/actividades/nuevoActividad.php');
    }

    public function guardarActividad(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $actividad = $_POST['actividad'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
   

        $acti = new actividadModel();
        $acti->insertar_actividad($ci_paciente,$actividad,$descripcion,$fecha);
        $data["titulo"] = "actividad";

        $this->verActividadesPacientes($ci_paciente);
    }

    public function modificarActividad($id){
			
        $acti = new actividadModel();
        $data["id_actividad"] = $id;
        $data["actividad"] = $acti->get_actividad($id);
        $data["titulo"] = "actividad";
        require_once(__DIR__ . '/../View/pacientes/actividades/modificarActividad.php');
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
        $this->verActividadesPacientes($ci_paciente);
    }
    
    
    public function eliminarActividad($id){
        
        $acti = new actividadModel();
        $acti->eliminar_Actividad($id);
        $data["titulo"] = "actividad";
        $this->verActividad();
    }

    public function verActividadesPacientes($ci_paciente) {
    
        $actividadModel = new actividadModel();
        $data['actividades'] = $actividadModel->obtenerActividadesPorPaciente($ci_paciente);
    
        // Asegura que la clave 'actividades' siempre esté presente en $data
        if (!isset($data['actividades'])) {
            $data['actividades'] = array(); // o puedes asignar un array vacío
        }
    
        require_once(__DIR__ . '/../View/pacientes/actividades/verActividad.php');
    }

    public function eliminarActividadPaciente($id){
        $acti = new actividadModel();
        
        $actividad = $acti->get_actividad($id);
        
        if ($actividad !== null && isset($actividad['ci_paciente'])) {
            $ci_paciente = $actividad['ci_paciente'];
            
            // Elimina la actividad
            $acti->eliminar_actividad($id); // Asegúrate de que el método se llama eliminar_actividad, según tu modelo
            
            $data["titulo"] = "actividad";
    
            // Redirecciona a la página de verActividadesPacientes con el ci_paciente
            $this->verActividadesPacientes($ci_paciente);
        } else {
            // Manejo de error si no se encuentra la actividad o no tiene la clave 'ci_paciente'
            echo "Error: No se pudo encontrar la actividad o no tiene la clave 'ci_paciente'.";
        }
    }
    
    
    
    
}

?>