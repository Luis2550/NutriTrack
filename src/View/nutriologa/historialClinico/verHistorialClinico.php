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

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="tabla_id">

            <thead>
                <tr>
                    <th>Código</th>
                    <!-- <th>Cédula Paciente</th> -->
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['historial_clinico'] as $historia): ?>
                    <tr>
                        <td><?php echo $historia['id_historial_clinico']; ?></td>
                        <!-- <td><?php echo $historia['ci_paciente']; ?></td> -->
                        <td><?php echo $historia['nombres']; ?></td>
                        <td><?php echo $historia['apellidos']; ?></td>
                        <td><?php echo $historia['fecha_creacion']; ?></td>
                        <?php echo "<td class='acciones'>
                                    <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=asignarHistorialClinico&id=".$historia['id_historial_clinico']."' class='btn btn-info'>Asignar</a>
                                    <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=modificarHistorialClinico&id=".$historia['id_historial_clinico']."' class='btn btn-warning'>Modificar</a>
                                    <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialPaciente&id=".$historia['id_historial_clinico']."' class='btn btn-success'>Ver historial</a>
                                </td>";?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario=1111111111"
            role="button"
        >
            Regresar
        </a>

        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidas"
            role="button"
        >
            Siguiente
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
