<?php

class CitasController {

    public function __construct() {
        require_once __DIR__ . "/../Model/citasModel.php";
    }

    public function verCitas() {
        $citas = new CitasModel();
        $data['titulo'] = 'citas';
        $data['citas'] = $citas->get_Citas();
        require_once(__DIR__ . '/../View/citas/verCitas.php');
    }

    public function nuevoCitas() {
        $data['titulo'] = 'citas';
        $citas = new CitasModel();
        $data['opciones_pacientes'] = $citas->getCIPacientes();
        $data2['opciones_nutriologa'] = $citas->getCINutriologa();

        require_once(__DIR__ . '/../View/citas/nuevoCitas.php');
    }

    public function guardarCitas() {
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $nutriologa = $_POST['ci_nutriologa'];
    
        $citas = new CitasModel();
    
        try {
            // Intentar insertar la cita
            $citas->insertar_Citas($ci_paciente, $fecha, $hora_inicio, $hora_fin, $nutriologa);
            $data["titulo"] = "citas";
            $this->verCitas();
        } catch (mysqli_sql_exception $e) {
            // Manejar la excepción
            $error_message = 'Ya existe una cita para la misma fecha y hora de inicio. Por favor, elige otra fecha u hora.';
            $data['titulo'] = 'citas';
            $data['opciones_pacientes'] = $citas->getCIPacientes();
            $data2['opciones_nutriologa'] = $citas->getCINutriologa();
            require_once(__DIR__ . '/../View/citas/nuevoCitas.php');
        }
    }

    public function modificarCitas($id_cita) {
        $citas = new CitasModel();
        $data["id_cita"] = $id_cita;
        $data["citas"] = $citas->get_Cita($id_cita);
        $data["titulo"] = "citas";
        require_once(__DIR__ . '/../View/citas/modificarCitas.php');
    }

    public function actualizarCitas() {
        $id_cita = $_POST['id_cita'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $usuarios = new CitasModel();
        $usuarios->modificar_Citas($id_cita, $ci_paciente, $fecha, $hora_inicio, $hora_fin);
        $data["titulo"] = "citas";
        $this->verCitas();
    }

    public function eliminarCitas($id_cita) {
        $citas = new CitasModel();
        $citas->eliminar_Citas($id_cita);
        $data["titulo"] = "citas";
        $this->verCitas();
    }
}

?>
