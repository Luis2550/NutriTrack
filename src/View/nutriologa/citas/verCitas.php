<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>


<?php include("./src/View/templates/header_administrador.php")?>

<main class="main_citas">

    <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

    <h2 class="titulo_citas">Ver Citas</h2>

    <table id="tabla_id" class="tabla_citas">

        <thead>
            <tr>
                <th>ID Paciente</th>
                <th>Cedula Paciente</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['citas'] as $dato ){
                    echo "<tr>";
                    echo "<td>".$dato['id_cita']."</td>";
                    echo "<td>".$dato['ci_paciente']."</td>";
                    echo "<td>".$dato['fecha']."</td>";
                    echo "<td>".$dato['hora_inicio']."</td>";
                    echo "<td>".$dato['hora_fin']."</td>";
                    echo "<td class='acciones'>
                            <a href='index.php?c=Citas&a=modificarCitas&id=".$dato["id_cita"]."' class='btn-modificar'>Modificar</a>
                            <a href='index.php?c=Citas&a=cancelar&id=".$dato["id_cita"]."' class='btn-eliminar'>Cancelar</a>
                            <a href='index.php?c=Citas&a=eliminarCitas&id=".$dato["id_cita"]."' class='btn-eliminar'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
            ?>

        </tbody>

    </table>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>