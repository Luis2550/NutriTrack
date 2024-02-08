<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Incluye el modelo necesario o cualquier lógica para obtener los usuarios desde el controlador de historialSuscripcion
require_once __DIR__ . "/../../Model/historialSuscripcionModel.php";
$historialSuscripcionModel = new historialSuscripcionModel();
$data['usuarios'] = $historialSuscripcionModel->getCiPaciente();

?>


<?php include("./src/View/templates/header_administrador.php")?>

    <br>
    <h2 class="text-center">Asignar plan suscripción</h2>
    <br>
    <!-- <button onclick="window.location.href='http://localhost/NutriTrack/index.php?c=Suscripcion&a=verSuscripcion'">Ver Planes</button> -->
    
<div class="container mt-5">
    <div class="row">
    <?php foreach ($data['historialsuscripciones'] as $dato): ?>
    <?php if ($data['ci_usuario'] == $dato['ci_paciente']): ?>
        <div class="col-md-4 mb-6">
            <div class="card custom-card" style="width: 300px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $dato['nombres']." ". $dato['apellidos']?></h5>
                    <p class="card-text">Plan Contratado: <?php echo $dato['suscripcion']; ?></p>
                    <p class="card-text">Fecha Inicio: <?php echo $dato['fecha_inicio']; ?></p>
                    <p class="card-text">Fecha Fin: <?php echo $dato['fecha_fin']; ?></p>
                    <p class="card-text">Estado: <?php echo $dato['estado']; ?></p>
                    <?php if ($dato['estado'] === 'SIN SUSCRIPCIÓN'): ?>
                        <a href='index.php?c=HistorialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario=<?php echo $dato["ci_paciente"]; ?>' class="btn btn-primary">Asignar</a>
                    <?php else: ?>
                        <p>Ya tiene una suscripción. Solo puede editar.</p>
                        <a href='index.php?c=HistorialSuscripcion&a=modificarHistorialSuscripcion&id=<?php echo $dato["id_suscripcion"]; ?>' class="btn btn-warning">Modificar</a>
                        <a href='index.php?c=HistorialSuscripcion&a=eliminarHistorialSuscripcion&id=<?php echo $dato["ci_paciente"]; ?>' class="btn btn-danger">Eliminar</a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
    </div>

    <?php if (isset($_GET['error_message'])): ?>
        <div class="alert alert-danger mt-4" role="alert">
            <?php echo htmlspecialchars($_GET['error_message']); ?>
        </div>
    <?php endif; ?>
</div>


<div class="d-flex justify-content-between mt-4">
        <a>
        </a>

        <a
            name=""
            id=""
            class="btn btn-primary"
            href='http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinicoSecuencial&ci_usuario=<?php echo $data['ci_usuario']; ?>'
            role="button"
        >
            Siguiente
        </a>
</div>

<?php include("./src/View/templates/footer_administrador.php")?>
