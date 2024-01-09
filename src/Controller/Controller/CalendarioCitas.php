<?php

class CalendarioCitasController{

    public function __construct(){
        require_once __DIR__ . "/../Model/calendarioCitasModel.php";
    }

    public function verCalendarioCitas(){

        $calendarioCitas = new CalendarioCitasModel();
        $data['titulo'] = 'Calendario de Citas';
        $data['calendarioCitas'] = $calendarioCitas->get_CalendarioCitas();

        require_once(__DIR__ . '/../View/CalendarioCitas/verCalendarioCitas.php');
    }

    public function nuevoCalendarioCitas(){
        $data['titulo'] = 'calendarioCitas';
        
        $calendarioCitas1 = new CalendarioCitasModel();
        $calendarioCitas2 = new CalendarioCitasModel();
        
        $data['calendarioCitasPaciente'] = $calendarioCitas1->get_ci_paciente_nombres_apellidos();
        $data['calendarioCitasNutriologa'] = $calendarioCitas2->get_ci_nutriologa_nombres_apellidos();

        require_once(__DIR__ . '/../View/CalendarioCitas/nuevoCalendarioCitas.php');
    }


    public function guardarCalendarioCitas(){
        
        $ci_paciente = $_POST['ci_paciente'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        
        $calendarioCitas = new calendarioCitasModel();
        $calendarioCitas->insertar_Calendario_Citas($ci_paciente, $ci_nutriologa, $fecha, $hora_inicio, $hora_fin);
        $data["titulo"] = "calendarioCitas";
        $this->verCalendarioCitas();
    }

    public function modificarCalendarioCitas($id){
			
        $calendarioCitas = new CalendarioCitasModel();
        
        $data["id_calendario_citas"] = $id;
        $data["calendarioCitas"] = $calendarioCitas->get_Calendario_Citas($id);
        $data["titulo"] = "Calendario Citas por ID";
        require_once(__DIR__ . '/../View/CalendarioCitas/modificarCalendarioCitas.php');
    }
    
    public function actualizarCalendarioCitas(){
        $id_calendario_citas = $_POST['id_calendario_citas'];
        $ci_paciente = $_POST['ci_paciente'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $estado = $_POST['estado'];

        $calendarioCitas = new CalendarioCitasModel();
        $calendarioCitas->modificar_Calendario_Citas($id_calendario_citas,$ci_paciente,$ci_nutriologa, $fecha, $hora_inicio, $hora_fin, $estado);
        $data["titulo"] = "usuarios";
        $this->verCalendarioCitas();
    }

    public function eliminarCalendarioCitas($id){
        
        $calendarioCitas = new CalendarioCitasModel();
        $calendarioCitas->eliminar_Calendario_Citas($id);
        $data["titulo"] = "Eliminar Calendario Citas";
        $this->verCalendarioCitas();
    }
}
?>