<?php

class historialClinicoController{

    public function __construct(){
        require_once __DIR__ . "/../Model/historialClinicoModel.php";
    }

    public function verHistorialClinico(){

        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_HistoriasClinicas();

        require_once(__DIR__ . '/../View/historialClinico/verHistorialClinico.php');
    }

    public function nuevoHistorialClinico() {
        $data['titulo'] = 'historial_clinico';

        // Instancia de la clase planNutricionalModel
        $historiaClini = new historialClinicoModel();
        
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $historiaClini->getCIPacientes();

        require_once(__DIR__ . '/../View/historialClinico/nuevoHistorialClinico.php');
    }

    public function guardarHistorialClinico(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_creacion = $_POST['fecha_creacion'];
        
        $historiaClini = new historialClinicoModel();
        $historiaClini->insertar_historialClinico($ci_paciente, $fecha_creacion);
        $data["titulo"] = "historial_clinico";
        $this->verHistorialClinico();
    }

    public function modificarHistorialClinico($id){
			
        $historiaClini = new historialClinicoModel();
        $data["id_historial_clinico"] = $id;
        $data["historial_clinico"] = $historiaClini->get_historialClinico($id);
        $data["titulo"] = "historial_clinico";
        require_once(__DIR__ . '/../View/historialClinico/modificarHistorialClinico.php');
    }
    
    public function actualizarHistorialClinico(){
        $id = $_POST['id'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha_creacion = $_POST['fecha_creacion'];
        
        $historiaClini= new historialClinicoModel();
        $historiaClini->modificar_historialClinico($id,$ci_paciente, $fecha_creacion);
        $data["titulo"] = "historial_clinico";
        $this->verHistorialClinico();
    }
    
    
    public function eliminarHistorialClinico($id){
        
        $historiaClini = new historialClinicoModel();
        $historiaClini->eliminar_historialClinico($id);
        $data["titulo"] = "historial_clinico";
        $this->verHistorialClinico();
    }

    
}

?>