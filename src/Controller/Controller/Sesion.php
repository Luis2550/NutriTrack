<?php

class SesionController {

    private $sesionModel;

    public function __construct() {
        require_once __DIR__ . "/../Model/sesionModel.php";
        $this->sesionModel = new sesionModel();
    }

    public function iniciarSesion($username, $password) {
        // Realiza la validación del usuario y contraseña en la base de datos
        $usuario = $this->sesionModel->obtenerUsuarioPorCredenciales($username, $password);

        if ($usuario) {
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
                'activo' => $activo['activo'],
            ];

            // Redirige según el rol
            if ($rol['rol'] === 'Paciente') {
                header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_p');
            } elseif ($rol['rol'] === 'Nutriologa') {
                header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_n');
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