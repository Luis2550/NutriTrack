<?php

class historialMedidasController{

    public function __construct(){
        require_once __DIR__ . "/../Model/historialMedidasModel.php";
    }

    public function verHistorialMedidas(){

        $historiaMedi = new historialMedidasModel();
        $data['titulo'] = 'historial_medidas';
        $data['historial_medidas'] = $historiaMedi->get_HistoriasMedidas();
    
        require_once(__DIR__ . '/../View/nutriologa/historialMedidas/verHistorialMedidas.php');
    }
    

    public function nuevoHistorialMedidas() {
        $data['titulo'] = 'historial_medidas';
    
        // Instancia de la clase planNutricionalModel
        $historiaMedi = new historialMedidasModel();
    
        // Obtener CI, nombres y apellidos de pacientes
        $data['opciones_paciente'] = $historiaMedi->getCIHistoriaClinica();
    
        require_once(__DIR__ . '/../View/nutriologa/historialMedidas/nuevoHistorialMedidas.php');
    }
    
    public function guardarHistorialMedidas() {
        $id_historial_clinico = $_POST['id_historial_clinico'];
        $peso = $_POST['peso'];
        $estatura = $_POST['estatura'];
        $presion_s = $_POST['presion_s'];
        $presion_d = $_POST['presion_d'];
        $fecha = $_POST['fecha'];
    
        $historiaMedi = new historialMedidasModel();
        $historiaMedi->insertar_historialMedidas($id_historial_clinico, $peso, $estatura, $presion_s, $presion_d, $fecha);
        $data["titulo"] = "historial_medidas";
        $this->verHistorialMedidas();
    }
    

    public function modificarHistorialMedidas($id){
			
        $historiaMedi = new historialMedidasModel();
        $data["id_historial_medidas"] = $id;
        $data["historial_medidas"] = $historiaMedi->get_historialMedidas($id);
        $data["titulo"] = "historial_medidas";
        require_once(__DIR__ . '/../View/nutriologa/historialMedidas/modificarHistorialMedidas.php');
    }
    
    public function actualizarHistorialMedidas(){
        $id = $_POST['id'];
        $id_historial_clinico = $_POST['id_historial_clinico'];
        $peso = $_POST['peso'];
        $estatura = $_POST['estatura'];
        $presion_s = $_POST['presion_s'];
        $presion_d = $_POST['presion_d'];
        $fecha = $_POST['fecha'];
        
        $historiaMedi= new historialMedidasModel();
        $historiaMedi->modificar_historialMedidas($id,$id_historial_clinico,$peso,$estatura,$presion_s,$presion_d,$fecha);
        $data["titulo"] = "historial_medidas";
        $this->verHistorialMedidas();
    }
    
    
    public function eliminarHistorialMedidas($id){
        
        $historiaMedi = new historialMedidasModel();
        $historiaMedi->eliminar_historialMedidas($id);
        $data["titulo"] = "historial_medidas";
        $this->verHistorialMedidas();
    }

    public function verHistorialMedidasPaciente($ci_paciente) {
        $historiaMedidas = new historialMedidasModel();
        $data['titulo'] = 'historial_medidas';
        $data['historial_medidas'] = $historiaMedidas->get_historialMedidasPaciente($ci_paciente);
    
       
            require_once(__DIR__ . '/../View/pacientes/historialMedidas/verHistorialMedidas.php');
    
    }
    
    
}

?>