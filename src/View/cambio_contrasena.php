<?php
require_once __DIR__ . '/../Model/usuariosModel.php';

// Recolectar email y hash del URL
$username = isset($_GET['username']) ? $_GET['username'] : '';


// Verificar si la URL tiene datos en el email y el hash
$urlTieneDatos = !empty($email) ;
$mensaje = '<div class="statusmsg">Lo sentimos, parece que has olvidado tu contraseña anterior. Por favor, sigue los siguientes pasos para restablecerla. Ingresa tu nueva contraseña y confírmala para continuar. Recuerda elegir una contraseña segura que contenga una combinación de letras, números y caracteres especiales para garantizar la seguridad de tu cuenta. Si necesitas ayuda, no dudes en contactar a nuestro equipo de soporte.</div>';
// Agregar lógica para activar la cuenta si la URL tiene datos
if ($urlTieneDatos) {
    $usuariosModel = new UsuariosModel();

} 

?>
<?php include("./src/View/templates/header.php")?>

<main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                     
                <form id="nuevo" name="nuevo" action="http://localhost/nutritrack/index.php?c=Sesion&a=cambio_contrasena" method="post" autocomplete="off" class="login-form">

                        <h2 class="text-center mb-4">Cambio de Contraseña</h2>
                        
                        <!-- <div class="form-group">
                            <label for="username">Correo:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div> -->
                        <div class="form-group">
                            <label for="email">Correo:</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($username); ?>" >

                        </div>

                        <div class="form-group">
                            <label for="password">Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmar">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" id="password_confirmar" name="password_confirmar" required>
                        </div>

                       
                        <div class="col-12 mt-4">
                            <?php
                            // Check for success message
                            if (isset($data["messages"]["success"])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                echo $data["messages"]["success"];
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            }

                            // Check for error message
                            if (isset($data["messages"]["error"])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                echo $data["messages"]["error"];
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            }
                            ?>
                        </div>

                        <button type="submit" id="btnEnviar" class="btn btn-primary btn-block">Enviar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Mensaje de alerta -->
    <?php if(!empty($mensaje)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $mensaje; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
</main>

<?php include("./src/View/templates/footer.php")?>