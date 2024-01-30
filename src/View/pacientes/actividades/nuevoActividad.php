
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

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=actividad&a=guardarActividad" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">

        <h2>Agregar Actividad</h2>

        <div class="form-group">
            <label for="ci_paciente">CI Paciente:</label>
            <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario']; ?>" class="form-control">
        </div>

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

        <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<style>



@media (max-width: 767px) {
    .container,
    .form-group,
    #nuevo {
        width: 100%;
        max-width: none;
        min-height: auto;
    }
    
    #nuevo {
        max-height: none;
        overflow-y: visible;
    }
}
</style>

<?php include("./src/View/templates/footer_usuario.php")?>
