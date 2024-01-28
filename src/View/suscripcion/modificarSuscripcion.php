<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_suscripcion container">
    <div class="row justify-content-center">
        <div class="col-md-15">
        <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Suscripcion&a=actualizarSuscripcion" autocomplete="off" class="needs-validation" novalidate>
                <h2 class="mb-4 text-center">Actualizar <?php echo $data['titulo']; ?></h2>

                <input type="hidden" id="id_suscripcion" name="id_suscripcion" required value="<?php echo $data["suscripcion"]["id_suscripcion"] ?>">

                <div class="form-group">
                    <label for="suscripcion">Suscripcion:</label>
                    <input type="text" id="suscripcion" name="suscripcion" class="form-control" required value="<?php echo isset($data["suscripcion"]["suscripcion"]) ? $data["suscripcion"]["suscripcion"] : ''; ?>">
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                </div>

                <div class="form-group">
                    <label for="duracion_dias">Duracion Dias:</label>
                    <input type="number" id="duracion_dias" name="duracion_dias" class="form-control" required value="<?php echo $data["suscripcion"]["duracion_dias"] ?>">
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
                    <button id="guardar" name="guardar" type="submit" class="btn btn-primary btn-block">Actualizar</button>
                </div>
                
                <div class="form-group">
                    <button id="volver" name="volver" type="button" class="btn btn-secondary btn-block" onclick="window.location.href='index.php?c=Suscripcion&a=verSuscripcion'">Regresar</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>


<!-- ojo esto ya no se esta llamando solo se usa en ver suscripcion -->