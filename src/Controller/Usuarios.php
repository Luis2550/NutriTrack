<?php
require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class UsuariosController{

    public function __construct(){
        require_once __DIR__ . "/../Model/usuariosModel.php";
    }
    function validarNombre($nombres) {
        // Verificar que el nombre y el apellido contengan exactamente dos palabras
        $nombrePalabras = explode(' ', trim($nombres));

        if (preg_match('/[0-9!@#$%^&*(),.?":{}|<>]/', $nombres)) {
            // Devolver false si se encuentran números o caracteres especiales 
            return false;
        }elseif(count($nombrePalabras) < 1) {
            // Devolver false si la validación falla
            return false;
        }else{
            return true;
        }
        // Devolver true si la validación es exitosa
        
    }
    function validarApellido($apellidos) {
        // Verificar que el nombre y el apellido contengan exactamente dos palabras
        $apellidoPalabras = explode(' ', trim($apellidos));

        if (preg_match('/[0-9!@#$%^&*(),.?":{}|<>]/', $apellidos)) {
            // Devolver false si se encuentran números o caracteres especiales 
            return false;
        }elseif(count($apellidoPalabras) < 1) {
            // Devolver false si la validación falla
            return false;
        }else{
            return true;
        }
        // Devolver true si la validación es exitosa
        
    }
    function validarCedula($cedula) {
        // Eliminar espacios en blanco y caracteres no numéricos
        $cedula = preg_replace("/[^0-9]/", "", $cedula);
    
        // Verificar que la cédula tenga 10 dígitos
        if (strlen($cedula) === 10) {
            // Obtener los dos primeros dígitos como provincia
            $provincia = (int) substr($cedula, 0, 2);
    
            // Validar que la provincia esté entre 1 y 24
            if ($provincia >= 1 && $provincia <= 24) {
                // Inicializar los coeficientes
                $coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2, 1];
    
                // Inicializar el resultado de la suma
                $suma = 0;
    
                // Calcular la suma ponderada
                for ($i = 0; $i < 9; $i++) {
                    $num = (int) $cedula[$i] * $coeficientes[$i];
                    $suma += $num - ($num > 9 ? 9 : 0);
                }
    
                // Aplicar el módulo 10 al resultado
                $resultado = $suma % 10;
    
                // Obtener el dígito verificador ingresado
                $digitoVerificadorIngresado = (int) $cedula[9];
    
                // Calcular el dígito verificador
                $digitoVerificadorCalculado = ($resultado === 0) ? 0 : 10 - $resultado;
    
                // Comparar el dígito verificador
                if ($digitoVerificadorCalculado === $digitoVerificadorIngresado) {
                    return true; // Cédula válida
                } else {
                    return false; // Cédula inválida
                }
            } else {
                return false; // La provincia en la cédula no es válida
            }
        } else {
            return false; // La longitud de la cédula no es válida
        }
    }

    public function verUsuarios(){

        $usuarios = new UsuariosModel();
        $data['titulo'] = ' Usuarios';
        $data['usuarios'] = $usuarios->get_Usuarios();

        require_once(__DIR__ . '/../View/usuarios/ver_usuarios.php');
    }

    public function nuevoUsuarios(){
        $usuarios = new UsuariosModel();
        $data['titulo'] = ' Usuarios';
        $data['roles'] = $usuarios->get_Roles();
        require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
    }

    public function guardarUsuarios() {

        // Validar y asegurar una contraseña más fuerte (ajusta según sea necesario)
        // if (strlen($_POST['contrasenia']) < 8) {
        //     die("La contraseña debe tener al menos 8 caracteres.");
        // }

        $ci_usuario = mb_strtoupper($_POST['cedula'], 'UTF-8');
        $id_rol = 1;
        $nombres = mb_strtoupper($_POST['nombres'], 'UTF-8');
        $apellidos = mb_strtoupper($_POST['apellidos'], 'UTF-8');
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fechaNacimiento = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        $correo = strtolower($_POST['correo']);
        //$contrasenia = $_POST['clave'];
        $contrasenia = password_hash(htmlspecialchars($_POST['clave']), PASSWORD_DEFAULT);
        $genero = mb_strtoupper($_POST['sexo'], 'UTF-8');
        $foto = $_POST['foto'];
        $intentos=3;

        $usuarios = new UsuariosModel();
        $vacioCampos = $usuarios->esNulo([$ci_usuario, $nombres, $apellidos, $fecha_nacimiento, $correo, $contrasenia, $genero, $foto]);

        if ($vacioCampos) {
            $data["titulo"] = "Usuarios";
            $data["error_message"] = "Error: Se debe llenar todos los campos";
            require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
        } else {
            $usuarioExistente = $usuarios->get_Usuario($ci_usuario);
            $emailExistente = $usuarios->EmailExiste($correo);

            if ($usuarioExistente) {
                $data["titulo"] = "Usuarios";
                $data["error_message"] = "Ya existe un usuario con esa cédula";
                require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
            } elseif ($emailExistente) {
                $data["titulo"] = "Usuarios";
                $data["error_message"] = "Ya existe un usuario con ese correo electrónico";
                require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
            } elseif (UsuariosController::validarCedula($ci_usuario)) {
                if (UsuariosController::validarNombre($nombres) && UsuariosController::validarApellido($apellidos)) {
                    
                    $usuarios->insertar_Usuarios($ci_usuario, $id_rol, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto,$intentos);

                    // Agregar envío de correo de activación
                    $hash = md5(rand(0, 1000));
                    $this->enviarCorreoActivacion($correo, $hash);

                    $data["titulo"] = "usuarios";
                    require_once(__DIR__ . '/../View/inicio_validacion.php');
                } else {
                    $data["error_message"] = 'Error: El nombre y el apellido deben contener exactamente dos palabras y no deben contener caracteres especiales.';
                    $data["titulo"] = "usuarios";
                    require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
                }
            } else {
                $data["error_message"] = 'Error: Cedula ingresada no es correcta';
                $data["titulo"] = "usuarios";
                require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
            }
        }
    }
    
    
    public function enviarCorreoActivacion($email, $hash) {
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
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Activación de cuenta';
            $mail->Body    = "
                Gracias por registrarte!
                Tu cuenta ha sido creada, actívala utilizando el enlace de la parte inferior.
    
                ------------------------
                Por favor haz clic en este enlace para activar tu cuenta:
                http://localhost/nutritrack/index.php?c=Inicio&a=inicio_validacion&email=$email&hash=$hash

            ";
    
            $mail->send();
            echo 'Correo de activación enviado con éxito.';
        } catch (Exception $e) {
            echo "No se pudo enviar el correo de activación. Error del servidor de correo: {$mail->ErrorInfo}";
        }
    }

    public function enviarContrasenaOlvidada($email, $nuevaContraseña) {
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
            $mail->addAddress($email);
    
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de Contraseña';
            $mail->Body    = "
                Hemos recibido una solicitud para recuperar tu contraseña. Aquí está tu contraseña:
    
                Contraseña: $nuevaContraseña
    
    
                ------------------------
                Este es un mensaje automático, por favor no respondas a este correo.
    
            ";
    
            $mail->send();
        } catch (Exception $e) {
            echo "No se pudo enviar el correo de recuperación de contraseña. Error del servidor de correo: {$mail->ErrorInfo}";
        }
    }
    
    

    public function modificarUsuarios($id){
			
        $usuarios = new UsuariosModel();
        
        $data["ci_usuario"] = $id;
        $data["usuarios"] = $usuarios->get_Usuario($id);
        $data["titulo"] = "Usuarios";
        require_once(__DIR__ . '/../View/usuarios/modificarUsuarios.php');
    }


    public function modificarUsuarios_n($id){
			
        $usuarios = new UsuariosModel();
        
        $data["ci_usuario"] = $id;
        $data["usuarios"] = $usuarios->get_Usuario($id);
        $data["titulo"] = "Usuarios";
        require_once(__DIR__ . '/../View/usuarios/modificarUsuarios_n.php');
    }
    
    public function actualizarUsuarios(){
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $correo = $_POST['correo'];
        $contrasenia = $_POST['clave'];
        $genero = $_POST['sexo'];
        $foto = $_POST['foto'];

        $usuarios = new UsuariosModel();
        $usuarios->modificar_Usuarios($id,$nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto);
        $data["titulo"] = "usuarios";
        $this->verUsuarios();
    }
    
    public function eliminarUsuarios($id){
        
        $usuarios = new UsuariosModel();
        $usuarios->eliminar_Usuarios($id);
        $data["titulo"] = "Usuarios";
        $this->verUsuarios();
    }
    
}

?>