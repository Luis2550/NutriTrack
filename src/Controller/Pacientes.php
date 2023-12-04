<?php

class PacientesController{

    public function __construct(){
        require_once __DIR__ . "/../Model/pacientesModel.php";
    }

    public function verPacientes(){

        $pacientes = new PacientesModel();
        $data['titulo'] = 'pacientes';
        $data['pacientes'] = $pacientes->get_Pacientes();

        require_once(__DIR__ . '/../View/pacientes/ver_pacientes.php');
    }

    public function nuevoPacientes(){
        $pacientes = new PacientesModel();
        $data['pacientes'] = $pacientes->traer_Usuarios();
        $data['titulo'] = ' pacientes';
         // Obtener opciones para ci_nutriologa y ci_paciente
         $data['opciones_usuario'] = $pacientes->getCiUsuario();
        require_once(__DIR__ . '/../View/pacientes/nuevoPacientes.php');
    }

    public function guardarPacientes(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $id_suscripcion = $_POST['id_suscripcion'];
        
        $pacientes = new PacientesModel();
        $pacientes->insertar_Pacientes($ci_paciente, $id_suscripcion);
        $data["titulo"] = "Pacientes";
        $this->verPacientes();
    }

    public function modificarPacientes($id){
			
        $pacientes = new PacientesModel();
        $data["paciente"] = $pacientes->get_Paciente($id);
        $data["titulo"] = "paciente";
        require_once(__DIR__ . '/../View/pacientes/modificarPacientes.php');
    }
    
    public function actualizarPacientes(){
        $ci_paciente = $_POST['ci_paciente'];
        $id_suscripcion = $_POST['id_suscripcion'];
        
        $pacientes = new PacientesModel();
        $pacientes->modificar_Pacientes($ci_paciente, $id_suscripcion);
        $data["titulo"] = "Pacientes";
        $this->verPacientes();
    }
    
    
    public function eliminarPacientes($id){
        
        $pacientes = new PacientesModel();
        $pacientes->eliminar_Pacientes($id);
        $data["titulo"] = "paciente";
        $this->verPacientes();
    }

    
}

?>