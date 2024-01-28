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
    if ($cita['fecha'] == $fecha_actual) {
        $citas_actuales[] = $cita;
    } elseif ($cita['fecha'] < $fecha_actual) {
        $citas_pasadas[] = $cita;
    }
}
?>

<?php include("./src/View/templates/header_usuario.php")?>
<br>
<h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
<h1>Citas del Paciente</h1>

<?php if (!empty($citas_actuales)): ?>
    <h2>Cita de hoy</h2>
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
    <p>No hay citas registradas para la fecha actual.</p>
<?php endif; ?>
<br>

<?php if (!empty($citas_pasadas)): ?>
    <h2>Citas pasadas</h2>
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
                <?php foreach ($citas_pasadas as $cita): ?>
                    <tr>
                        <td><?= $cita['id_cita'] ?></td>
                        <td><?= $cita['fecha'] ?></td>
                        <td><?= $cita['horas_disponibles'] ?></td>
                        <td><?= $cita['estado'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No hay citas pasadas registradas para este paciente.</p>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#citas_pasadas').DataTable();
    });
</script>

<?php include("./src/View/templates/footer_usuario.php")?>
