<?php

class CitasController {

    public function __construct() {
        require_once __DIR__ . "/../Model/citasModel.php";
        require_once __DIR__ . "/../Model/usuariosModel.php";
    }

    public function verCitas() {
        $citasModel = new CitasModel();
    
        $data['titulo'] = 'citas';
        $data['citas'] = $citasModel->get_Citas();
    
        require_once(__DIR__ . '/../View/nutriologa/citas/verCitas.php');
    }
    
    // ...

    public function nuevoCitas() {
        try {
            $data['titulo'] = 'citas';
            $citas = new CitasModel();

            // Obtener la cédula de la nutrióloga directamente
            $data['ci_nutriologa'] = $citas->getCINutriologa();

            // Obtener las configuraciones de horas
            $configuraciones = $citas->getConfiguraciones($data['ci_nutriologa']);

            // Calcular las horas disponibles
            $data['horas_disponibles'] = $this->calcularHorasDisponibles($configuraciones);

            // Obtener la fecha actual en formato Y-m-d
            $fecha_actual_ymd = date('Y-m-d');

            require_once(__DIR__ . '/../View/pacientes/citas/nuevoCitas.php');

            // ...

            echo '<script>';
            echo 'flatpickr("#fecha", {';
            echo 'enableTime: false,';
            echo 'dateFormat: "Y-m-d",';
            echo 'defaultDate: "today",';
            echo 'minDate: "today",';
            echo 'locale: "es",';
            echo 'inline: true,';
            echo 'onDayCreate: function(dObj, dStr, fp, dayElem) {';
            echo 'var now = new Date();';
            echo 'var selectedDate = new Date(dStr);';
            echo 'var diasLaborables = ' . json_encode($configuraciones[0]['dias_semana']) . ';';
            echo 'var esDiaLaborable = diasLaborables.includes((selectedDate.getDay() + 6) % 7 + 1);';
            echo 'if (selectedDate < now || !esDiaLaborable) {';
            echo 'dayElem.classList.add("disabled");';
            echo 'dayElem.title = esDiaLaborable ? "No se puede agendar una cita en una fecha anterior a la actual." : "Día no laborable.";';
            echo '}';
            echo 'if (!esDiaLaborable) {';
            echo 'dayElem.classList.add("no-laborable");'; // Agrega un estilo CSS para días no laborables
            echo '}';
            echo '}';
            echo '});';
            echo '</script>';

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

// ...

    
    //funcion para calcular las horas segun la tabla configuracion

    private function calcularHorasDisponibles($configuraciones) {
        $horasDisponibles = array();
    
        foreach ($configuraciones as $configuracion) {
            // Mañana
            $horaInicioManana = new DateTime($configuracion['hora_inicio_manana']);
            $horaFinManana = new DateTime($configuracion['hora_fin_manana']);
            $duracionCita = 'PT' . intval($configuracion['duracion_cita']) . 'H';
    
            while ($horaInicioManana < $horaFinManana) {
                $horaFinCita = clone $horaInicioManana;
                $horaFinCita->add(new DateInterval($duracionCita));
    
                if ($horaFinCita > $horaFinManana) {
                    $horaFinCita = $horaFinManana;
                }
    
                $horasDisponibles[] = $horaInicioManana->format('H:i:s') . ' - ' . $horaFinCita->format('H:i:s');
    
                $horaInicioManana->add(new DateInterval($duracionCita));
            }
    
            // Tarde
            $horaInicioTarde = new DateTime($configuracion['hora_inicio_tarde']);
            $horaFinTarde = new DateTime($configuracion['hora_fin_tarde']);
    
            while ($horaInicioTarde < $horaFinTarde) {
                $horaFinCitaTarde = clone $horaInicioTarde;
                $horaFinCitaTarde->add(new DateInterval($duracionCita));
    
                if ($horaFinCitaTarde > $horaFinTarde) {
                    $horaFinCitaTarde = $horaFinTarde;
                }
    
                $horasDisponibles[] = $horaInicioTarde->format('H:i:s') . ' - ' . $horaFinCitaTarde->format('H:i:s');
    
                $horaInicioTarde->add(new DateInterval($duracionCita));
            }
        }
    
        return $horasDisponibles;
    }
    
    public function guardarCitas() {
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha2'];
        $horas_disponibles = $_POST['horas_disponibles'];
        $nutriologa = $_POST['ci_nutriologa'];
    
        $citas = new CitasModel();
    
        try {
            // Intentar insertar la cita
            $citas->insertar_Citas($ci_paciente, $fecha, $horas_disponibles, $nutriologa);
            $data["titulo"] = "citas";

            $this->ver_citas_paciente($ci_paciente);
        } catch (mysqli_sql_exception $e) {
            // Manejar la excepción específica de MySQLi
            $error_message = 'Ya existe una cita para la misma fecha y hora de inicio. Por favor, elige otra fecha u hora.';
            header('Location: http://localhost/nutritrack/index.php?c=Citas&a=nuevoCitas&error_message=' . urlencode($error_message));
            exit();
        }
    }
    
    public function modificarCitas($id_cita) {
        $citas = new CitasModel();
        $data["id_cita"] = $id_cita;
        $cita = $citas->get_Cita($id_cita);
    
        // Obtener las configuraciones de horas para calcular las horas disponibles
        $configuraciones = $citas->getConfiguraciones($cita['ci_nutriologa']);
        $data["horas_disponibles"] = $this->calcularHorasDisponibles($configuraciones);
    
        $data["citas"] = $cita;
        $data["titulo"] = "citas";
    
        require_once(__DIR__ . '/../View/pacientes/citas/modificarCitas.php');
        
        echo '<script>';
            echo 'flatpickr("#fecha2", {';
            echo 'enableTime: false,';
            echo 'dateFormat: "Y-m-d",';
            echo 'defaultDate: "today",';
            echo 'minDate: "today",';
            echo 'locale: "es",';
            echo 'inline: true,';
            echo 'onDayCreate: function(dObj, dStr, fp, dayElem) {';
            echo 'var now = new Date();';
            echo 'var selectedDate = new Date(dStr);';
            echo 'var diasLaborables = ' . json_encode($configuraciones[0]['dias_semana']) . ';';
            echo 'var esDiaLaborable = diasLaborables.includes((selectedDate.getDay() + 6) % 7 + 1);';
            echo 'if (selectedDate < now || !esDiaLaborable) {';
            echo 'dayElem.classList.add("disabled");';
            echo 'dayElem.title = esDiaLaborable ? "No se puede agendar una cita en una fecha anterior a la actual." : "Día no laborable.";';
            echo '}';
            echo 'if (!esDiaLaborable) {';
            echo 'dayElem.classList.add("no-laborable");'; // Agrega un estilo CSS para días no laborables
            echo '}';
            echo '}';
            echo '});';
            echo '</script>';
    }
    
    public function actualizarCitas() {
        $id_cita = $_POST['id_cita'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha2'];
        $horas_disponibles = $_POST['horas_disponibles'];
    
        $citas = new CitasModel();
    
        try {
            // Intentar actualizar la cita
            $citas->modificar_Citas($id_cita, $ci_paciente, $fecha, $horas_disponibles);
            $data["titulo"] = "citas";

            // Redirigir a la acción correspondiente
            $this->ver_citas_paciente($ci_paciente);
        } catch (mysqli_sql_exception $e) {
            // Manejar la excepción específica de MySQLi
            $error_message = 'Ya existe una cita para la misma fecha y hora de inicio. Por favor, elige otra fecha u hora.';
            header('Location: http://localhost/nutritrack/index.php?c=Citas&a=nuevoCitas&error_message=' . urlencode($error_message));
            exit();
        }    

            

    }
    

    public function eliminarCitas($id_cita) {
        $citas = new CitasModel();
        $citas->eliminar_Citas($id_cita);
        $data["titulo"] = "citas";
        $this->verCitas();
    }

    public function ver_citas_paciente($ci_paciente) {
        $citasModel = new CitasModel();
        $data['citas'] = $citasModel->getCitasPaciente($ci_paciente);
        $data['titulo'] = 'Citas del Paciente';
    
        require_once(__DIR__ . '/../View/pacientes/citas/verCitas.php');
    }

    public function eliminarCitasPaciente($id_cita) {
        $citas = new CitasModel();
        
        // Obtener el ci_paciente relacionado con la cita
        $cita = $citas->get_Cita($id_cita);
        $ci_paciente = $cita['ci_paciente'];
        
        $citas->eliminar_Citas($id_cita);
        $data["titulo"] = "citas";
        
        // Pasar el $ci_paciente a la función
        $this->ver_citas_paciente($ci_paciente);
    }
    
    
}

?>
