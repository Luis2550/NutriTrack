<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Lógica de manejo de la inserción aquí...

?>

<?php include("./src/View/templates/header_usuario.php")?>


<style>
    .bg-custom {
      background: linear-gradient(to bottom, #9cb6dd, #4a5989);
    }
</style>

<main class="main"> 
    <h2 class="mt-3 mb-4">Ver Actividades</h2>
    <a class="btn btn-primary mb-4" href="http://localhost/nutritrack/index.php?c=Actividad&a=nuevoActividad" role="button">Agregar</a>
    <div class="row">
        <?php
        if (isset($data['actividades']) && is_array($data['actividades'])) {
            foreach ($data['actividades'] as $dato) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-custom text-white">
                    <div class="card-body">
                        <h5 class="card-title">Cédula Paciente: <?php echo $dato['ci_paciente']; ?></h5>
                        <p class="card-text">Actividad: <?php echo $dato['actividad']; ?></p>
                        <p class="card-text">Descripción: <?php echo $dato['descripcion']; ?></p>
                        <p class="card-text">Fecha: <?php echo $dato['fecha']; ?></p>
                        <div class="text-center">
                            <a href="index.php?c=actividad&a=modificarActividad&id=<?php echo $dato['id_actividad']; ?>" class="btn btn-warning mr-2">Modificar</a>
                            <a href="index.php?c=actividad&a=eliminarActividadPaciente&id=<?php echo $dato['id_actividad']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            // No hay actividades para mostrar
            echo "<p class='col-md-12'>No hay actividades disponibles.</p>";
        }
        ?>
    </div>
</main>



<?php include("./src/View/templates/footer_usuario.php")?>
