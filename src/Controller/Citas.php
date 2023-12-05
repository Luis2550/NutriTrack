<?php

class CitasController{

    public function __construct(){
        require_once __DIR__ . "/../Model/citasModel.php";
    }

    public function verCitas(){

        $citas = new CitasModel();
        $data['titulo'] = 'citas';
        $data['citas'] = $citas->get_Citas();

        require_once(__DIR__ . '/../View/citas/verCitas.php');
    }

    public function nuevoCitas(){
        $data['titulo'] = ' citas';
        $citas = new CitasModel();
         // Obtener opciones para ci_nutriologa y ci_paciente
         $data['opciones_pacientes'] = $citas->getCIPacientes();

        require_once(__DIR__ . '/../View/citas/nuevoCitas.php');
    }

    public function guardarCitas(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $duracion_cita = $_POST['duracion_cita'];
        
        $citas = new CitasModel();
        $citas->insertar_Citas($ci_paciente, $fecha, $hora_inicio, $duracion_cita);
        $data["titulo"] = "citas";
        $this->verCitas();
    }

    public function modificarCitas($id_cita){
			
        $citas = new CitasModel();
        
        $data["id_cita"] = $id_cita;
        $data["citas"] = $citas->get_Cita($id_cita);
        $data["titulo"] = "citas";
        require_once(__DIR__ . '/../View/citas/modificarCitas.php');
    }
    
    public function actualizarCitas(){

        $id_cita = $_POST['id_cita'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $duracion_cita = $_POST['duracion_cita'];

        $usuarios = new CitasModel();
        $usuarios->modificar_Citas($id_cita, $ci_paciente, $fecha, $hora_inicio, $duracion_cita);
        $data["titulo"] = "citas";
        $this->verCitas();
    }
    
    public function eliminarCitas($id_cita){
        
        $citas = new CitasModel();
        $citas->eliminar_Citas($id_cita);
        $data["titulo"] = "citas";
        $this->verCitas();
    }

    
}

?>