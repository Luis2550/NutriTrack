<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
// Obtener la fecha actual
date_default_timezone_set('America/Guayaquil'); // Establecer la zona horaria a Ecuador
    $fecha_actual = (new DateTime())->format('Y-m-d');
// Obtener todas las citas agendadas desde la fecha actual
$citas_agendadas = array_filter($data['citas'], function($cita) use ($fecha_actual) {
    return $cita['fecha'] >= $fecha_actual;
});

// Separar las citas en dos arreglos: una para las citas de hoy y otra para las futuras
$citas_actuales_hoy = [];
$citas_actuales_futuras = [];

foreach ($citas_agendadas as $cita) {
    if ($cita['fecha'] == $fecha_actual) {
        $citas_actuales_hoy[] = $cita;
    } else {
        $citas_actuales_futuras[] = $cita;
    }
}
?>

<?php include("./src/View/templates/header_usuario.php")?>
<br>
<h2 style="text-align:center;">Citas Agendadas</h2>

<?php if (!empty($citas_actuales_hoy) || !empty($citas_actuales_futuras)): ?>
    
    <!-- Citas de Hoy -->
    <?php if (!empty($citas_actuales_hoy)): ?>
    <h3>Cita de Hoy</h3>
    <div class="table-responsive">
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Numero cita</th>
                    <th>Hora de la cita</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas_actuales_hoy as $cita): ?>
                    <?php if ($cita['estado'] == 'Reservado'): ?>
                        <tr>
                            <td><?= $cita['fecha'] ?></td>
                            <td><?= $cita['id_cita'] ?></td>
                            <td><?= $cita['horas_disponibles'] ?></td>
                            <td><?= $cita['estado'] ?></td>
                            <td>
                                <a href='index.php?c=Citas&a=modificarCitas&id=<?= $cita['id_cita']?>' class="btn btn-info"><i class="fa-solid fa-pen-to-square" style="color: #fff;"></i> Modificar</a>
                                <a href="#" class="btn btn-danger" onclick="return confirmarCancelarCita('<?= $cita['id_cita'] ?>');"><i class="fa-solid fa-ban" style="color: #fff;"></i> Cancelar</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>


    <br>
    <br>

    <!-- Citas Futuras -->
    <?php if (!empty($citas_actuales_futuras)): ?>
        <h3>Citas Futuras</h3>
        <div class="table-responsive">
            <table class="table table-bordered dataTable" id="citas_futuras">
                <thead>
                    <tr>
                        
                        <th>Fecha</th>
                        <th>Numero cita</th>
                        <th>Hora de la cita</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($citas_actuales_futuras as $cita): ?>
                        <tr>
                            
                            <td><?= $cita['fecha'] ?></td>
                            <td><?= $cita['id_cita'] ?></td>
                            <td><?= $cita['horas_disponibles'] ?></td>
                            <td><?= $cita['estado'] ?></td>
                            <td>
                                <a href='index.php?c=Citas&a=modificarCitas&id=<?= $cita['id_cita']?>' class="btn btn-info"><i class="fa-solid fa-pen-to-square" style="color: #fff;"></i> Modificar</a>
                                <a href="#" class="btn btn-danger" onclick="return confirmarEliminarCita('<?= $cita['id_cita'] ?>');"><i class="fa-solid fa-trash" style="color: #fff;"></i> Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

<?php else: ?>
    <p>No hay citas registradas para la fecha actual o futuras.</p>
<?php endif; ?>
<br>

<script>
function confirmarCancelarCita(idCita) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Si cancelas la cita no podrás volver a agendar otra cita el día de hoy",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redireccionar a la página de cancelar con la confirmación
            window.location.href = "index.php?c=Citas&a=eliminarCitasPaciente&id=" + idCita;
        }
    });
    return false; // Evitar el comportamiento predeterminado del enlace
}
</script>

<script>
function confirmarEliminarCita(idCita) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Si eliminas la cita podrás registrar otra vez",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, Eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redireccionar a la página de cancelar con la confirmación
            window.location.href = "index.php?c=Citas&a=eliminarCitasPacienteFuturas&id=" + idCita;
        }
    });
    return false; // Evitar el comportamiento predeterminado del enlace
}
</script>


<br>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function () {
        $('#citas_futuras').DataTable({
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
