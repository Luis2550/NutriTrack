<?php

class SesionController {

    private $sesionModel;
    private $usuarios;

    public function __construct() {
        require_once __DIR__ . "/../Model/sesionModel.php";
        require_once __DIR__ . "/Usuarios.php";

        $this->sesionModel = new sesionModel();
        $this->UsuariosController = new usuariosController();
    }

    public function iniciarSesion($username, $password) {
        // Realiza la validación del usuario y contraseña en la base de datos
        $usuario = $this->sesionModel->obtenerUsuarioPorCredenciales($username, $password);

        if ($usuario) {
            // Verifica si la cuenta está activada
            if ($usuario['activo'] == 1) {
                // Obtiene el rol del usuario
                $rol = $this->sesionModel->obtenerRolUsuario($usuario['id_rol']);

                // Inicia sesión y guarda los datos del usuario en la variable de sesión
                session_start();
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

                // Regenera el ID de sesión
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
        } else {
            // Manejo de error, por ejemplo, mostrar un mensaje de error en la página de inicio de sesión.
            echo "Usuario o contraseña incorrectos";
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
