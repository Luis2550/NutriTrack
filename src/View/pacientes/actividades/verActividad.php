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
      background-color: #cbe7ff ;
    }

    .card-body{
        color:black;
    }

    .card-title{
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        color: #1c448c;
    }

    .btn{
        background-color: #3893f9;

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
            confirmButtonText: "Sí, eliminarlo"
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
    <a class="btn btn-primary mb-4" href="http://localhost/nutritrack/index.php?c=Actividad&a=nuevoActividad" role="button">Agregar</a>
    <div class="row">
        <?php
        if (isset($data['actividades']) && is_array($data['actividades'])) {
            foreach ($data['actividades'] as $dato) {
        ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-custom text-white">
                    <div class="card-body">
                        <h5 class="card-title">Actividad: <?php echo $dato['actividad']; ?></h5>
                        <p class="card-text">Descripción: <?php echo $dato['descripcion']; ?></p>
                        <p class="card-text">Fecha: <?php echo $dato['fecha']; ?></p>
                        <div class="text-center">
                            <a href="index.php?c=actividad&a=modificarActividad&id=<?php echo $dato['id_actividad']; ?>" class="btn mr-2">Modificar</a>
                            <button class="btn" onclick="confirmarEliminar(<?php echo $dato['id_actividad']; ?>)">Eliminar</button>
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
