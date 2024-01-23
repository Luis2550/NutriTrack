<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_configuracion">
    <div class="vista">

        <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
        <h2>Ver Configuración</h2>

        <div class="table-responsive">
            <table class="table table-bordered dataTable" id="tabla_id">

                <thead>
                    <tr>
                        <th>Hora inicio mañana</th>
                        <th>Hora fin mañana</th>
                        <th>Hora inicio tarde</th>
                        <th>Hora fin tarde</th>
                        <th>Días Laborales</th>
                        <th>Duración cita</th>
                        <th>Horas totales</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        foreach($data['configuraciones'] as $dato){
                            echo"<tr>";
                                echo"<td>".$dato['hora_inicio_manana']."</td>";
                                echo"<td>".$dato['hora_fin_manana']."</td>";
                                echo"<td>".$dato['hora_inicio_tarde']."</td>";
                                echo"<td>".$dato['hora_fin_tarde']."</td>";
                                echo"<td class='scrollable-cell'>".$dato['dias_semana']."</td>";
                                echo"<td>".$dato['duracion_cita']."</td>";
                                echo"<td>".$dato['horas_laborales']."</td>";
                                echo "<td class='acciones'>
                                    <a href='index.php?c=Configuracion&a=modificarConfiguraciones&id=".$dato["id_configuracion"]."' class='btn btn-warning'>Modificar</a>
                                </td>";
                            echo"</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
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
