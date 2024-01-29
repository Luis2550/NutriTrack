<?php

class historialMedidasController{


    public function __construct() {
        require_once __DIR__ . "/../Model/historialMedidasModel.php";
    }


    public function verHistorialMedidas(){

        $ci_usuario = isset($_GET['ci_usuario']) ? $_GET['ci_usuario'] : null;

        $historiaMedi = new historialMedidasModel();
        $data['titulo'] = 'historial_medidas';
        $data['historial_medidas'] = $historiaMedi->get_HistoriasMedidas();

        $histClinico['datos'] = $historiaMedi->getCIHistoriaClinica();

        $data['ci_usuario'] = $ci_usuario;
    
        require_once(__DIR__ . '/../View/nutriologa/historialMedidas/verHistorialMedidas.php');
    }
    

    public function nuevoHistorialMedidas() {
        $data['titulo'] = 'historial_medidas';
    
        // Instancia de la clase planNutricionalModel
        $historiaMedi = new historialMedidasModel();

        $id_clinico = isset($_GET['id']) ? $_GET['id'] : null;
        $data['id'] = $id_clinico;
    
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


        $ci_usuario_model = new historialMedidasModel();
        $ci_usuario = $ci_usuario_model->buscarUsuario($id_historial_clinico);
    
        // Asegúrate de que $ci_usuario es un valor válido antes de redirigir
        if ($ci_usuario !== null) {
            header('Location: http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas&ci_usuario='.$ci_usuario['ci_paciente']);
            exit();
        } else {
            // Manejo de error si no se encuentra el usuario
            echo "Error al obtener el usuario.";
            echo $id_historial_clinico;
        }
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
        
        $historiaMedi = new historialMedidasModel();
        $historiaMedi->modificar_historialMedidas($id,$id_historial_clinico,$peso,$estatura,$presion_s,$presion_d,$fecha);
        $data["titulo"] = "historial_medidas";
    
        $ci_usuario_model = new historialMedidasModel();
        $ci_usuario = $ci_usuario_model->buscarUsuario($id_historial_clinico);
    
        // Asegúrate de que $ci_usuario es un valor válido antes de redirigir
        if ($ci_usuario !== null) {
            header('Location: http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas&ci_usuario='.$ci_usuario['ci_paciente']);
            exit();
        } else {
            // Manejo de error si no se encuentra el usuario
            echo "Error al obtener el usuario.";
        }
    }
    
    
    
    public function eliminarHistorialMedidas($id){
        
        $historiaMedi = new historialMedidasModel();
        $historiaMedi->eliminar_historialMedidas($id);
        $data["titulo"] = "historial_medidas";

        $ci_usuario = isset($_GET['ci_usuario']) ? $_GET['ci_usuario'] : null;
        
        header('Location: http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas&ci_usuario='.$ci_usuario );
        exit();

    }

    public function verHistorialMedidasPaciente($ci_paciente) {
        $historiaMedidas = new historialMedidasModel();
        $data['titulo'] = 'historial_medidas';
        $data['historial_medidas'] = $historiaMedidas->get_historialMedidasPaciente($ci_paciente);
    
       
            require_once(__DIR__ . '/../View/pacientes/historialMedidas/verHistorialMedidas.php');
    
    }
    
    
}

?>