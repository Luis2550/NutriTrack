<?php
require_once __DIR__ . '/../Model/usuariosModel.php';

// Recolectar email y hash del URL
$email = isset($_GET['email']) ? $_GET['email'] : '';
$hash = isset($_GET['hash']) ? $_GET['hash'] : '';

// Verificar si la URL tiene datos en el email y el hash
$urlTieneDatos = !empty($email) && !empty($hash);

// Agregar lógica para activar la cuenta si la URL tiene datos
if ($urlTieneDatos) {
    $usuariosModel = new UsuariosModel();
    $cuentaActivada = $usuariosModel->activarCuenta($email, $hash);

    if ($cuentaActivada) {
        $activacionExitosa = false;
        $mensaje = '<div class="statusmsg">Error al activar la cuenta.</div>';
    } else {
        $activacionExitosa = true;
        $mensaje = '<div class="statusmsg">Tu cuenta ha sido activada, ya puedes iniciar sesión.</div>';
    }
} else {
    $activacionExitosa = false;
    $mensaje = '<div class="statusmsg">URL incompleta. Verifica tu correo electrónico antes de iniciar sesión.</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
    <link rel="stylesheet" href="./public/css/login1.css">
</head>
<body>
<div class="login-container">

    <?php
    // Mostrar mensaje según la activación exitosa o URL incompleta
    echo $mensaje;
    ?>

    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion" method="post" class="login-form">
        <h2>Login</h2>
        <label for="username">Correo:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <!-- Agregar campos ocultos para almacenar email y hash -->
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="hash" value="<?php echo htmlspecialchars($hash); ?>">

        <?php
        // Mostrar o no el botón de entrada según la activación exitosa
        if ($activacionExitosa) {
            echo '<button type="submit">Entrar</button>';
        } else {
            echo '<div class="statusmsg">Tu cuenta aún no ha sido activada. Verifica tu correo electrónico antes de iniciar sesión.</div>';
        }
        ?>
    </form>
</div>
</body>
</html>
