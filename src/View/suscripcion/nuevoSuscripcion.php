<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main mainHistorial">
            <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Suscripcion&a=guardarSuscripcion" autocomplete="off" class="mx-auto col-lg-8 col-sm-12" novalidate>
                <h2 class="mb-4 text-center">Registro del plan<?php echo $data['titulo']; ?></h2>

                <div class="form-group">
                    <label for="suscripciondato">Suscripcion:</label>
                    <input type="text" id="suscripciondato" name="suscripciondato" class="form-control" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                </div>

                <div class="form-group">
                    <label for="duracion_dias">Duracion Dias:</label>
                    <input type="number" id="duracion_dias" name="duracion_dias" class="form-control" required min="0">
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
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
                <div class="form-group">
                    <button id="guardar" name="guardar" type="submit" class="btn btn-primary" style="background-color: #22c55e; border-color: #22c55e">Registrar</button>
                </div>
                <div class="form-group">
                    <button id="volver" name="volver" type="button" class="btn btn-secondary " onclick="window.location.href='index.php?c=Suscripcion&a=verSuscripcion'">Regresar</button>
                </div>
            </form>
            <style>
@media (max-width: 767px) {
    .container,
    .form-group,
    #modificar {
        width: 100%;
        max-width: none;
        min-height: auto;
    }
    
    #modificar {
        max-height: none;
        overflow-y: visible;
    }
    .btn-primary {
    background-color: #22c55e; /* Cambia el color de fondo del botón */
    border-color: #22c55e; /* Cambia el color del borde del botón */
    }
    .btn-primary {
        color: #fff; /* Cambia el color del texto del botón a blanco */
    }

}
</style>
</main>


<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nuevo').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe de manera predeterminada
        event.preventDefault();

        // Muestra la alerta después de unos segundos
        setTimeout(function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Registro plan suscripción realizada con éxito",
                showConfirmButton: false,
            });
        }, 1000); // Cambia el valor del temporizador según tus necesidades

        // Envía el formulario después de mostrar la alerta
        setTimeout(function () {
            document.getElementById('nuevo').submit();
        }, 3000); // Asegúrate de ajustar el valor del temporizador según el tiempo de la alerta
    });
});
</script>
<?php include("./src/View/templates/footer_administrador.php")?>







