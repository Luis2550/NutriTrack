<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_historialCli"> 
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Historial Clinico</h2>

    <div class="row">
    <?php foreach ($data['historial_clinico'] as $historia): ?>
    <?php if ($historia['ci_paciente'] == $data['ci_usuario']): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $historia['nombres'] . " " . $historia['apellidos']; ?></h5>
                    <p class="card-text">Código: <?php echo $historia['id_historial_clinico']; ?></p>
                    <p class="card-text">Fecha Creación: <?php echo $historia['fecha_creacion']; ?></p>
                    <div class="d-flex justify-content-between mt-2">
                        <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=asignarHistorialClinico&id=<?php echo $historia['id_historial_clinico']; ?>' class='btn btn-info'>Asignar</a>
                        <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=modificarHistorialClinico&id=<?php echo $historia['id_historial_clinico']; ?>' class='btn btn-warning'>Modificar</a>
                        <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialPaciente&id=<?php echo $historia['id_historial_clinico']; ?>' class='btn btn-success'>Ver historial</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a name="" id="" class="btn btn-primary" href="http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=verHistorialSuscripcionSecuencial&ci_usuario=<?php echo $data['ci_usuario']; ?>" role="button">Regresar</a>
        <a name="" id="" class="btn btn-primary" href="http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas&ci_usuario=<?php echo $data['ci_usuario']; ?>" role="button">Siguiente</a>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tabla_id').DataTable();
    });
</script>

<?php include("./src/View/templates/footer_administrador.php")?>
