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
        $activacionExitosa = true;
        $mensaje = '<div class="statusmsg">Error al activar la cuenta.</div>';
    } else {
        $activacionExitosa = false;
        $mensaje = '<div class="statusmsg">Tu cuenta ha sido activada, ya puedes iniciar sesión.</div>';
    }
} else {
    $activacionExitosa = true;
    $mensaje = '<div class="statusmsg">Verifica tu correo electrónico antes de iniciar sesión.</div>';
}

?>
<?php include("./src/View/templates/header.php")?>

<main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <?php echo $mensaje; ?>
                    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion" method="post" class="login-form">
                        
                        
                        

                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <input type="hidden" name="hash" value="<?php echo htmlspecialchars($hash); ?>">

                        <?php
                        if ($activacionExitosa) {
                            echo '<div class="statusmsg">Tu cuenta aún no ha sido activada. Verifica tu correo electrónico antes de iniciar sesión.</div>';
                            
                        } else {
                            echo '<h2 class="text-center mb-4">Login</h2>
                            <div class="form-group">
                                <label for="username">Correo:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Verificar si la cookie 'reload_page_once' ya está presente
if (!sessionStorage.getItem('pageReloaded')) {
    // Si la página no se ha recargado, establecer sessionStorage y recargar la página
    sessionStorage.setItem('pageReloaded', 'true');
    location.reload();
}
</script>

<?php include("./src/View/templates/footer.php")?>