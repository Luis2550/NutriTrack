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
    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Suscripcion&a=actualizarSuscripcion" autocomplete="off" class="needs-validation" novalidate>
        <h2 class="mt-4 mb-4">Actualizar <?php echo $data['titulo'];?></h2>

        <div class="mb-3">
            <label for="suscripcion" class="form-label">Suscripcion</label>
            <input type="text" class="form-control" id="suscripcion" name="suscripcion" required value="<?php echo $data["suscripcion"]["suscripcion"]?>">
            <div class="valid-feedback">
                ¡Se ve bien!
            </div>
            <div class="invalid-feedback">
                Por favor, ingrese una suscripción válida.
            </div>
        </div>

        <div class="mb-3">
            <label for="duracion_dias" class="form-label">Duracion Dias</label>
            <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" required value="<?php echo $data["suscripcion"]["duracion_dias"]?>">
            <div class="valid-feedback">
                ¡Se ve bien!
            </div>
            <div class="invalid-feedback">
                Por favor, ingrese una duración de días válida.
            </div>
        </div>

        <div class="mb-3">
            <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>

