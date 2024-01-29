<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion');
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<!-- Agrega las referencias a Bootstrap -->
<main class="main"> 
    <div class="row">
        <div class="col-12">
            <div class="card"> <!-- Color verde agua -->
                <div class="card-body">
                
                    <p class="card-text"><strong>Actividad:</strong> <?php echo $data["actividad"]["actividad"]?></p>
                    <p class="card-text"><strong>Descripcion:</strong> <?php echo htmlspecialchars($data["actividad"]["descripcion"]); ?></p>
                    <p class="card-text"><strong>Fecha:</strong> <?php echo $data["actividad"]["fecha"]?></p>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between mt-4">
        <a name="" id="" class="btn btn-primary" href="http://localhost/nutritrack/index.php?c=Actividad&a=verActividad&ci_usuario=<?php echo $data["actividad"]['ci_paciente']; ?>" role="button">Regresar</a>
    </div>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>
