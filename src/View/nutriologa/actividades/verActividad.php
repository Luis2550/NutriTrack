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
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Actividades</h2>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="tabla_id">

            <thead>
                <tr>
                    <th>Cedula Paciente</th>
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
                        echo "<tr>";
                        echo "<td>" . $dato['ci_paciente'] . "</td>";
                        echo "<td>" . $dato['actividad'] . "</td>";
                        echo "<td>" . $dato['nombres'] . "</td>";
                        echo "<td>" . $dato['apellidos'] . "</td>";
                        echo "<td>" . $dato['descripcion'] . "</td>";
                        echo "<td>" . $dato['fecha'] . "</td>";
                        echo "<td class='celda-acciones'>
                                <a class='btn btn-info' href='http://localhost/nutritrack/index.php?c=Actividad&a=verActividadPaciente&id=" . $dato["id_actividad"] . "'>Ver Actividad</a>
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
        $('#tabla_id').DataTable();
    });
</script>

<?php include("./src/View/templates/footer_administrador.php")?>
