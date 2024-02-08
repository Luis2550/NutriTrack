<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_actividades act_n"> 
    
   <br>
   <h2 class="text-center">Ver Actividades</h2>
    <br>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="tabla_id">

            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Opcion</th>
                </tr>
            </thead>

            <tbody>
            <?php
                // Cambia el bucle para usar las actividades obtenidas del controlador
                foreach ($data['actividad'] as $dato) {
                    if ($dato['ci_paciente'] == $data['ci_usuario']) {
                        echo "<tr>";
                        echo "<td>" . $dato['actividad'] . "</td>";
                        echo "<td>" . $dato['nombres'] . "</td>";
                        echo "<td>" . $dato['apellidos'] . "</td>";
                
                        // Mostrar solo los primeros 50 caracteres de la descripción seguidos de puntos suspensivos
                        $descripcionCorta = strlen($dato['descripcion']) > 50 ? substr($dato['descripcion'], 0, 50) . '...' : $dato['descripcion'];
                        echo "<td>" . $descripcionCorta . "</td>";
                
                        echo "<td>" . $dato['fecha'] . "</td>";
                        echo "<td class='celda-acciones'>
                                <a class='btn btn-info' href='http://localhost/nutritrack/index.php?c=Actividad&a=verActividadPaciente&id=" . $dato["id_actividad"] . "'>Ver Actividad</a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>

            </tbody>
        </table>

    </div>

    <div class="d-flex justify-content-between mt-4">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas&ci_usuario=<?php echo $data['ci_usuario']; ?>"
            role="button"
        >
            Regresar
        </a>

        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional"
            role="button"
        >
            Agregar Plan Nutricional
        </a>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function () {
        $('#tabla_id').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
</script>

<?php include("./src/View/templates/footer_administrador.php")?>
