<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_citas">

    <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

    <h2 class="titulo_citas">Ver Citas</h2>

    <div class="vista_tabla">
        
        <table id="tabla_id" class="table table-bordered dataTable" style="width:100%">

            <thead>
                <tr>
                    <!-- <th>Cedula Paciente</th> -->
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                    foreach($data['citas'] as $dato ){
                        echo "<tr>";
                        // echo "<td>".$dato['ci_paciente']."</td>";
                        echo "<td>".$dato['nombres']."</td>";
                        echo "<td>".$dato['apellidos']."</td>";
                        echo "<td>".$dato['fecha']."</td>";
                        echo "<td>".$dato['horas_disponibles']."</td>";
                        echo "<td class='acciones'>
                                <a href='index.php?c=Citas&a=marcarAsistenciaCita&id=".$dato["ci_paciente"]."' class='btn btn-info'>Asistió</a>
                                <a href='index.php?c=Citas&a=marcarNoAsistenciaCita&id=".$dato["id_cita"]."' class='btn btn-warning'>No Asistió</a>
                                <a href='index.php?c=Citas&a=eliminarCitas&id=".$dato["id_cita"]."' class='btn btn-danger'>Cancelar</a>
                        </td>";
                        echo "</tr>";
                    }
                ?>           

            </tbody>

        </table>
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
