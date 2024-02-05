<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>

<div class="container nuevo-actividades justify-content-center align-items-center" style="height: 100vh;">

    <form id="form-actividad" name="nuevo" method="POST" action="index.php?c=actividad&a=guardarActividad" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">
        
        <h2>Agregar Actividad</h2>
        <br>

        <div class="col-sm-12">
            <div class="card text-center">
                <div class="card-body">
                    <p class="card-text">
                        Nota: Solo puede ingresar una actividad por día
                    </p>
                </div>
            </div>
        </div>

        <br>
       
        <input type="hidden" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario']; ?>" class="form-control">

        <div class="form-group">
            <label for="actividad">Actividad:</label>
            <input type="text" id="actividad" name="actividad" required class="form-control">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" style="height: 180px;" required></textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly class="form-control">
        </div>

        <?php
        // Verificar si hay un mensaje de error presente
        $error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

        // Mostrar el mensaje de error si está presente
        if (!empty($error_message)) {
            // Mostrar la alerta de error con el mensaje correspondiente
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error",
                            text: "' . htmlspecialchars($error_message) . '",
                            showConfirmButton: true,
                        });
                    });
                  </script>';
        }
        ?>

        <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<style>
@media (max-width: 767px) {
    .container,
    .form-group,
    #form-actividad {
        width: 100%;
        max-width: none;
        min-height: auto;
    }
    
    #form-actividad {
        max-height: none;
        overflow-y: visible;
    }
}
</style>

<?php include("./src/View/templates/footer_usuario.php")?>
