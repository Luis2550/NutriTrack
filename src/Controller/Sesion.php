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

    public function iniciarSesion($username, $password) {
        // Inicia o reanuda la sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica si se han enviado datos del formulario
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "Por favor, proporciona un nombre de usuario y una contraseña.";
            
            return;
        }
        // Realiza la validación del usuario y contraseña en la base de datos
        $usuario = $this->sesionModel->obtenerUsuarioPorCredenciales($username);
        $intentos = $this->usuariosModel->get_intentos_usuario($username);
        echo $intentos; 

        if ($usuario) {

            if ($usuario['correo'] == $username && $usuario['clave'] == $password)
            {
                // Verifica si la cuenta está activada
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
                    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_p');
                    exit(); // Agregado: evita que el script siga ejecutándose después de la redirección
                } elseif ($rol['rol'] === 'Nutriologa') {
                    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_n');
                    exit(); // Agregado: evita que el script siga ejecutándose después de la redirección
                }
            } else {
                // Cuenta no activada, muestra un mensaje de error
                echo "La cuenta no está activada. Por favor, revisa tu correo electrónico para activar la cuenta.";
                // Agregado: Llamada al método enviarCorreoActivacion
                $hash = md5(rand(0, 1000));
                $this->UsuariosController->enviarCorreoActivacion($usuario['correo'], $hash);
            }

            }else
            {
                if ($intentos <0){
                    echo "Revise su correo electronico";
                }else{
                        $this->usuariosModel->bajar_intentos($username);
                        // Verifica si la cuenta debe ser bloqueada
                        if ( $intentos == 0) {
                            // Muestra un mensaje y solicita revisar el correo para activar la cuenta nuevamente
                            echo "Has excedido el número máximo de intentos.";
             
                                $clave = $this->usuariosModel->get_claveRecuperacion($username);
                                // Verifica si la clave es válida 
                                if ($clave !== null) {
                                    // Envía la contraseña olvidada
                                    $this->UsuariosController->enviarContrasenaOlvidada($username, $clave);
                                    echo "Se ha enviado la contraseña olvidada al correo electrónico asociado a tu cuenta.";
                                } else {
                                    echo "No se pudo recuperar la contraseña. Por favor, contacta al soporte técnico.";
                                }
                        }
                        echo "Usuario o contraseña incorrectos";
                    }
            }
            
        } else {
            
          echo "usuario no registrado";  
        }
    }

    // Otros métodos relacionados con la gestión de sesiones podrían ir aquí

}

// Uso del controlador al recibir la solicitud del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sesionController = new SesionController();
    $sesionController->iniciarSesion($_POST['username'], $_POST['password']);
}
?>
