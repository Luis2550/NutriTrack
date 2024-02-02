<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Lógica de manejo de la inserción aquí...

// Ordena el array de actividades por fecha de forma ascendente
usort($data['actividades'], function($a, $b) {
    return strtotime($a['fecha']) - strtotime($b['fecha']);
});
?>

<?php include("./src/View/templates/header_usuario.php")?>
<style>
    .bg-custom {
        background-color: #cbe7ff;
    }

    .card-body {
        color: black;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-title {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        color: #1c448c;
        margin-bottom: 5px; /* Reducido el espacio entre el título y la fecha */
        /* Limita el título a dos líneas y oculta el exceso */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-date {
        text-align: center;
        margin: 5px 0; /* Reducido el espacio entre la fecha y los botones */
    }

    .card-buttons {
        margin-top: auto;
        text-align: center; /* Alinea los botones al centro */
    }

    .card {
        max-width: 300px;
        height: 250px; /* Altura definida para las cartas */
        padding: 10px;
    }
</style>


<script>
    // Función para mostrar la confirmación antes de eliminar
    function confirmarEliminar(idActividad) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo",
            cancelButtonText: "Cancelar" // Cambia "Cancel" por "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar a la página de eliminar con la confirmación
                window.location.href = "index.php?c=actividad&a=eliminarActividadPaciente&id=" + idActividad;
            }
        });
    }
</script>

<main class="main">
    <h2 class="mt-3 mb-4">Ver Actividades</h2>
    <a class="btn btn-primary mb-4" href="http://localhost/nutritrack/index.php?c=Actividad&a=nuevoActividad" role="button"><i class="fa-solid fa-plus" style="color: #fff;"></i> Agregar</a>

    <div class="row">
        <?php
        if (isset($data['actividades']) && is_array($data['actividades'])) {
            foreach ($data['actividades'] as $dato) {
        ?>
                <div class="col-md-3 mb-2">
                    <div class="card bg-custom text-white">
                        <div class="card-body">
                            <h5 class="card-title">Actividad: <?php echo $dato['actividad']; ?></h5>
                            <p class="card-date">Fecha: <?php echo $dato['fecha']; ?></p>
                        </div>
                        <!-- Mover los botones al final y ajustar estilos -->
                        <div class="card-buttons">
                            <button class="btn btn-info mb-2" data-toggle="modal" data-target="#verActividadModal<?php echo $dato['id_actividad']; ?>"><i class="fa-solid fa-eye" style="color: #fff;"></i> Ver Actividad</button>
                            <a href="index.php?c=actividad&a=modificarActividad&id=<?php echo $dato['id_actividad']; ?>" class="btn btn-success mb-2"><i class="fa-solid fa-pen-to-square" style="color: #fff;"></i> Modificar</a>
                            <button class="btn btn-danger mb-2" onclick="confirmarEliminar(<?php echo $dato['id_actividad']; ?>)"><i class="fa-solid fa-trash" style="color: #fff;"></i> Eliminar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal para mostrar la actividad -->
                <div class="modal fade" id="verActividadModal<?php echo $dato['id_actividad']; ?>" tabindex="-1" role="dialog" aria-labelledby="verActividadModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verActividadModalLabel">Actividad: <?php echo $dato['actividad']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Mostrar la descripción de la actividad -->
                                <p><?php echo $dato['descripcion']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
