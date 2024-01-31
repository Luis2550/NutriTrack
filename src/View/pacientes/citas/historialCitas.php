<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_usuario.php")?>

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
            <?php foreach ($data['citas'] as $cita): ?>
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

<p>No hay citas pasadas registradas para este paciente.</p>

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