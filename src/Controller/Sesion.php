<?php

class SesionController {

    private $sesionModel;
    private $usuarios;
    private $usuariosModel;
    private $usuariosController;

    public function __construct() {
        require_once __DIR__ . "/../Model/sesionModel.php";
        require_once __DIR__ . "/../Model/usuariosModel.php";
        require_once __DIR__ . "/Usuarios.php";

        $this->sesionModel = new sesionModel();
        $this->usuariosModel = new usuariosModel();
        $this->UsuariosController = new usuariosController();
    }
    function encrypt ($password1,$key)
    {
        $result = '';
        for ($i = 0; $i < strlen($password1); $i++) {
            $char = substr($password1, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }
    function decrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string); // Corregido: base64_decode en lugar de base64_encode
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}
    public function iniciarSesion() {

        
        $key='memocode';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $data["messages"] = array();
        // Inicia o reanuda la sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuario = $this->sesionModel->obtenerUsuarioPorCredenciales($username);
        $password_encriptada =SesionController::encrypt($password, $key);

        if ($usuario['correo']==$username && $usuario['clave']==$password_encriptada ) { 
            // && password_verify($password, $usuario['clave'])
            if ($usuario['activo'] == 1) {
                // Obtiene el rol del usuario
                $rol = $this->sesionModel->obtenerRolUsuario($usuario['id_rol']);

                // Inicia sesión y guarda los datos del usuario en la variable de sesión
                $_SESSION['usuario'] = [
                    'ci_usuario' => $usuario['ci_usuario'],
                    'nombres' => $usuario['nombres'],
                    'apellidos' => $usuario['apellidos'],
                    'edad' => $usuario['edad'],
                    'correo' => $usuario['correo'],
                    'sexo' => $usuario['sexo'],
                    'foto' => $usuario['foto'],
                    'rol' => $rol['rol'],
                    'activo' => $usuario['activo'],
                ];
                $numeroIntentos=$this->usuariosModel->regresaNumero_intentos();
                echo $numeroIntentos;
                $this->usuariosModel->reanudar_intentos($username, $numeroIntentos);// Regenera el ID de sesión
                session_regenerate_id(true);

                // Redirige según el rol
                if ($rol['rol'] === 'Paciente') {
                    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_p&ci_usuario=' . $usuario['ci_usuario']);
                    exit(); // Agregado: evita que el script siga ejecutándose después de la redirección
                } elseif ($rol['rol'] === 'Nutriologa') {
                    header('Location: http://localhost/nutritrack/index.php?c=Citas&a=verCitas');
                    exit(); // Agregado: evita que el script siga ejecutándose después de la redirección
                }
            } else {
                // Cuenta no activada, muestra un mensaje de error
                
                $data["messages"]["error"] = "La cuenta no está activada. Por favor, revisa tu correo electrónico para activar la cuenta.";
                require_once(__DIR__ . '/../View/inicio_sesion.php');
                // Agregado: Llamada al método enviarCorreoActivacion
                $hash = md5(rand(0, 1000));
                $this->UsuariosController->enviarCorreoActivacion($usuario['correo'], $hash);
            }
        } else {
            $intentos = $this->usuariosModel->get_intentos_usuario($username);
            // if ($intentos ==1) {
            //     $data["messages"]["error"] = "Has excedido el número máximo de intentos. Se ha enviado la contraseña olvidada al correo electrónico asociado a tu cuenta.";
            //     $clave = $this->usuariosModel->get_claveRecuperacion($username);
            //     $clave_desencriptada= SesionController::decrypt($clave, $key); 
            //     // Verifica si la clave es válida 
            //         $this->UsuariosController->enviarContrasenaOlvidada($username, $clave_desencriptada);
            //         require_once(__DIR__ . '/../View/inicio_sesion.php');
            //         //echo $intentos;
            //         $this->usuariosModel->bajar_intentos($username);

            // } else {
                // Verifica si la cuenta debe ser bloqueada
            $this->usuariosModel->bajar_intentos($username);
                if ($intentos >=1 ) { // Cambiado a 1 para reflejar el decremento anterior
                    // Muestra un mensaje y solicita revisar el correo para activar la cuenta nuevamente
                    
                    $data["messages"]["error"] = "Error: Usuario o contraseña incorrectos";
                    //echo $intentos;
                    require_once(__DIR__ . '/../View/inicio_sesion.php');   

                }
                else{
                    if ($intentos==0)
                    {
                        $data["messages"]["error"] = "Error: Cuenta bloqueada revisa tu correo electronico ";
                        require_once(__DIR__ . '/../View/inicio_sesion.php');
                        $this->UsuariosController->enviarCorreoCambioContrasena($username);
                    }elseif ($intentos <0) {
                        $data["messages"]["error"] = "Error:Su correo electronico ya fue enviado para el cambio de contraseña. Revise!! ";
                        require_once(__DIR__ . '/../View/inicio_sesion.php');
                    }

                    
                }
            //}
        }
    }
    function encryptPassword($password, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($password); $i++) {
            $char = substr($password, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }
    public function cambio_contrasena()
    {
        $tu_llave_secreta = 'memocode';
        $mensaje = ''; // Variable para almacenar el mensaje a mostrar
        $data["messages"] = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $password_confirmar = isset($_POST['password_confirmar']) ? $_POST['password_confirmar'] : '';
            $clave_encriptada = SesionController::encryptPassword($password, $tu_llave_secreta);
            $existe = $this->usuariosModel->EmailExiste($email);
            if ($existe)
            {
                if ($password == $password_confirmar) {
                    $boolean_guardar = $this->usuariosModel->restablecer_contrasena($email, $clave_encriptada);
                    if ($boolean_guardar) {
                        $data["messages"]["success"] = "Nueva contraseña guardada exitosamente";
                    } else {
                        $data["messages"]["error"] = "No se logró guardar la contraseña, inténtelo nuevamente";
                    }
                } else {
                    $data["messages"]["error"] = "No coinciden las contraseñas, verifique";
                }
            }
            else{
                $data["messages"]["error"] = "El correo electronico no esta registrado, intente nuevamente";
            }
            
        }

        // Incluir la vista después de haber definido el mensaje
        require_once(__DIR__ . '/../View/cambio_contrasena.php');
    }




}


?>

