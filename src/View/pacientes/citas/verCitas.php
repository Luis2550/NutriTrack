<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Establecer la zona horaria de Ecuador
date_default_timezone_set('America/Guayaquil');

// Obtener la fecha y hora actual
$fecha_actual = (new DateTime())->format('Y-m-d');
// Separar las citas en dos arreglos: una para las citas de la fecha actual y otra para las fechas menores a la actual
$citas_actuales = [];
$citas_pasadas = [];

foreach ($data['citas'] as $cita) {
    if ($cita['fecha'] >= $fecha_actual) {
        $citas_actuales[] = $cita;
    }
}
?>

<?php include("./src/View/templates/header_usuario.php")?>
<br>
<h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
<h3>Cita de Hoy</h3>

<?php if (!empty($citas_actuales) && array_filter($citas_actuales, function($cita) { return $cita['estado'] == 'Reservado'; })): ?>
    
    <div class="table-responsive">
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>Numero cita</th>
                    <th>Fecha</th>
                    <th>Hora de la cita</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas_actuales as $cita): ?>
                   
                        <tr>
                            <td><?= $cita['id_cita'] ?></td>
                            <td><?= $cita['fecha'] ?></td>
                            <td><?= $cita['horas_disponibles'] ?></td>
                            <td><?= $cita['estado'] ?></td>
                            <td>
                                <a href='index.php?c=Citas&a=modificarCitas&id=<?= $cita['id_cita']?>' class="btn btn-info">Modificar</a>
                                <a href='index.php?c=Citas&a=eliminarCitasPaciente&id=<?= $cita['id_cita'] ?>' class="btn btn-danger">Cancelar</a>
                            </td>
                        </tr>
                   
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No hay citas registradas para la fecha actual o no hay citas con el estado "Reservado".</p>
<?php endif; ?>
<br>



    <h3>Historial Citas</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-sm dataTable" id="citas_pasadas">
            <thead>
                <tr>
                    <th style="width: 10%">Numero cita</th>
                    <th style="width: 20%">Fecha</th>
                    <th style="width: 20%">Hora de la cita</th>
                    <th style="width: 20%">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['citas']as $cita): ?>
                    <?php if ($cita['estado'] != 'Reservado'): ?>
                        <tr>
                            <td><?= $cita['id_cita'] ?></td>
                            <td><?= $cita['fecha'] ?></td>
                            <td><?= $cita['horas_disponibles'] ?></td>
                            <td><?= $cita['estado'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#citas_pasadas').DataTable({
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

<?php include("./src/View/templates/footer_usuario.php")?>
