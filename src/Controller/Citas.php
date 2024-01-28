<?php
require __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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


        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    private function calcularHorasDisponibles($configuraciones) {
        $horasDisponibles = array();
    
        foreach ($configuraciones as $configuracion) {
            // Mañana
            $horaInicioManana = new DateTime($configuracion['hora_inicio_manana']);
            $horaFinManana = new DateTime($configuracion['hora_fin_manana']);
            $duracionCitaManana = ($configuracion['duracion_cita'] === '00:30:00') ? 'PT30M' : 'PT1H';
    
            while ($horaInicioManana < $horaFinManana) {
                $horaFinCitaManana = clone $horaInicioManana;
                $horaFinCitaManana->add(new DateInterval($duracionCitaManana));
    
                if ($horaFinCitaManana > $horaFinManana) {
                    $horaFinCitaManana = $horaFinManana;
                }
    
                $horasDisponibles[] = $horaInicioManana->format('H:i:s') . ' - ' . $horaFinCitaManana->format('H:i:s');
    
                $horaInicioManana->add(new DateInterval($duracionCitaManana));
            }
    
            // Tarde
            $horaInicioTarde = new DateTime($configuracion['hora_inicio_tarde']);
            $horaFinTarde = new DateTime($configuracion['hora_fin_tarde']);
            $duracionCitaTarde = (isset($configuracion['duracion_cita']) && $configuracion['duracion_cita'] === '00:30:00') ? 'PT30M' : 'PT1H';
    
            while ($horaInicioTarde < $horaFinTarde) {
                $horaFinCitaTarde = clone $horaInicioTarde;
                $horaFinCitaTarde->add(new DateInterval($duracionCitaTarde));
    
                if ($horaFinCitaTarde > $horaFinTarde) {
                    $horaFinCitaTarde = $horaFinTarde;
                }
    
                $horasDisponibles[] = $horaInicioTarde->format('H:i:s') . ' - ' . $horaFinCitaTarde->format('H:i:s');
    
                $horaInicioTarde->add(new DateInterval($duracionCitaTarde));
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
            $error_message =  $e;
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
        
    }

    public function marcarAsistenciaCita($ci_usuario) {
        $citas = new CitasModel();
        $data["id_cita"] = $id_cita;
        // $cita = $citas->marcar_Cita_Asistida($id_cita);
        header('Location: http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario='. $ci_usuario);
        exit();;
    }

    public function marcarNoAsistenciaCita($id_cita) {
        $citas = new CitasModel();
        $data["id_cita"] = $id_cita;
        $cita = $citas->marcar_Cita_No_Asistida($id_cita);
        $this->verCitas();
    }
    
    public function actualizarCitas() {
        $id_cita = $_POST['id_cita'];
        $ci_paciente = $_POST['ci_paciente'];
        $fecha = $_POST['fecha2'];
        $horas_disponibles = $_POST['horas_disponibles'];
    
        $citas = new CitasModel();
    
    
            // Intentar actualizar la cita
            $citas->modificar_Citas($id_cita, $ci_paciente, $fecha, $horas_disponibles);
            $data["titulo"] = "citas";

            // Redirigir a la acción correspondiente
            $this->ver_citas_paciente($ci_paciente);
        //catch (mysqli_sql_exception $e) {
        //     // Manejar la excepción específica de MySQLi
        //     $error_message = 'Ya existe una cita para la misma fecha y hora de inicio. Por favor, elige otra fecha u hora.';
        //     header('Location: http://localhost/nutritrack/index.php?c=Citas&a=nuevoCitas&error_message=' . urlencode($error_message));
        //     exit();
        // }    

    }
    
    

    public function eliminarCitas($id_cita) {
        $citas = new CitasModel();
        $correo = $citas->getCorreo($id_cita);
    
        // Verifica si $correo no es nulo antes de enviar el correo
        if ($correo !== null) {
            try {
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'nutritrack02@gmail.com';
                $mail->Password   = 'reaq znpz rqhr huac';
                $mail->SMTPSecure = 'SSL';
                $mail->Port       = 587;
    
                $mail->setFrom('nutritrack02@gmail.com', 'Nutritrack');
                $mail->addAddress($correo);
    
                $mail->isHTML(true);
                $mail->Subject = 'Cita Cancelada';
                $mail->Body = 'Cita cancelada';
                $mail->addAttachment('./public/assets/images/Cita-Cancelada.png', 'imagen_cita_cancelada.png', 'base64', 'image/png');


                $mail->send();
                echo 'Correo enviado correctamente';
            } catch (Exception $e) {
                echo "No se pudo enviar el correo. Error del servidor de correo: {$mail->ErrorInfo}";
            }
        } else {
            echo "No se pudo obtener la dirección de correo.";
        }
    
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
