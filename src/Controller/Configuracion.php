<?php

require __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ConfiguracionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/configuracionModel.php";
    }

    public function verConfiguracion(){

        $configuraciones = new configuracionModel();
        $data['titulo'] = ' configuracion';
        $data['configuraciones'] = $configuraciones->get_Configuraciones();

        require_once(__DIR__ . '/../View/nutriologa/configuracion/ver_configuracion.php');
    }

    public function nuevoConfiguraciones(){
        $configuraciones = new configuracionModel();
        require_once(__DIR__ . '/../View/nutriologa/configuracion/nuevoConfiguraciones.php');
    }
								
    public function guardarConfiguraciones(){
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $hora_inicio_manana = $_POST['hora_inicio_manana'];
        $hora_fin_manana = $_POST['hora_fin_manana'];
        $hora_inicio_tarde = $_POST['hora_inicio_tarde'];
        $hora_fin_tarde = $_POST['hora_fin_tarde'];
        $dias_semana = $_POST['dias_semana'];
        $duracion_cita = $_POST['duracion_cita'];
    
        $configuraciones = new configuracionModel();
        $configuraciones->insertar_Configuraciones($ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita);
        $data["titulo"] = "Configuraciones";
        $this->verConfiguracion();
    }
    


    public function modificarConfiguraciones($id){
        $configuraciones = new configuracionModel();
        $data["configuraciones"] = $configuraciones->get_Configuracion($id);
        $data["titulo"] = "Modificar Configuración";
        require_once(__DIR__ . '/../View/nutriologa/configuracion/modificarConfiguraciones.php');
    }
    
    public function actualizarConfiguraciones(){
        $id_configuracion = $_POST['id_configuracion'];
        
        // Recuperar los datos existentes antes de la actualización
        $configuraciones = new configuracionModel();
        $citas = new configuracionModel();
        $datos_existente = $configuraciones->get_Configuracion($id_configuracion);
    
        // Almacenar los datos existentes en un array
        $datos_antiguos = array(
            'ci_nutriologa' => $datos_existente['ci_nutriologa'],
            'hora_inicio_manana' => $datos_existente['hora_inicio_manana'],
            'hora_fin_manana' => $datos_existente['hora_fin_manana'],
            'hora_inicio_tarde' => $datos_existente['hora_inicio_tarde'],
            'hora_fin_tarde' => $datos_existente['hora_fin_tarde'],
            'dias_semana' => $datos_existente['dias_semana'],
            'duracion_cita' => $datos_existente['duracion_cita'],
            'dias_Feriados' => $datos_existente['dias_Feriados']
        );
    
        // Recuperar los datos de la solicitud de actualización
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $hora_inicio_manana = $_POST['hora_inicio_manana'];
        $hora_fin_manana = $_POST['hora_fin_manana'];
        $hora_inicio_tarde = $_POST['hora_inicio_tarde'];
        $hora_fin_tarde = $_POST['hora_fin_tarde'];
        $dias_semana_array = $_POST['dias_semana'];
        $duracion_cita = $_POST['duracion_cita'];
        $dias_Feriados = $_POST['dias_Feriados'];

    
        // Convertir el array de días a una cadena separada por comas
        $dias_semana = implode(',', $dias_semana_array);
    
        // Verificar si se realizaron cambios
        if ($datos_antiguos === array(
            'ci_nutriologa' => $ci_nutriologa,
            'hora_inicio_manana' => $hora_inicio_manana,
            'hora_fin_manana' => $hora_fin_manana,
            'hora_inicio_tarde' => $hora_inicio_tarde,
            'hora_fin_tarde' => $hora_fin_tarde,
            'dias_semana' => $dias_semana,
            'duracion_cita' => $duracion_cita,
            'dias_Feriados' => $dias_Feriados,
        )) {
            // No se realizaron cambios
            echo "<script>alert('No se han realizado cambios');</script>";
        } else {
            // Se realizaron cambios
    
            // Obtener los correos de los usuarios con rol 1
            $usuariosRol1 = $configuraciones->getCorreosUsuariosRol1();
    
            // Enviar correo a cada usuario con rol 1
            foreach ($usuariosRol1 as $correo) {
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
                    $mail->Subject = 'Cambios en el horario citas';
                    $mail->Body    = 'Se han realizado cambios en la configuración. Por favor, agende su cita nuevamente.';
    
                    $mail->send();
                    // echo 'Correo enviado correctamente a ' . $correo . '<br>';
                } catch (Exception $e) {
                    echo "No se pudo enviar el correo a " . $correo . ". Error del servidor de correo: {$mail->ErrorInfo}<br>";
                }
            }
    
            
            // Realizar la actualización de configuraciones
            $configuraciones->modificar_Configuraciones($id_configuracion, $ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita, $dias_Feriados);
            $citas->cancelar_citas_pacientes();
            echo "<script>alert('Se realizaron cambios');</script>";
        }
    
        // Imprimir los datos antiguos (puedes quitar esto después de verificar)
        // echo "Datos Antiguos:<pre>";
        // print_r($datos_antiguos);
        // echo "</pre>";
    
        $data["titulo"] = "Configuraciones";
        $this->verConfiguracion();
    }
    
    
    public function eliminarConfiguraciones($id){
        
        $configuraciones = new configuracionModel();
        $configuraciones->eliminarConfiguraciones($id);
        $data["titulo"] = " Configuracion";
        $this->verConfiguracion();
    }

   
}

?>