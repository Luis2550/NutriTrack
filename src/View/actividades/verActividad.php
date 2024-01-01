<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main main_actividades"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Actividades</h2>
    <table border="1" width="60%">

<thead>
    <tr>
        <th>Cedula Paciente</th>
        <th>Actividad</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
</thead>

<tbody>

    <?php
    // Cambia el bucle para usar las actividades obtenidas del controlador
    foreach ($actividades as $dato) {
        echo "<tr>";
        echo "<td>" . $dato['ci_paciente'] . "</td>";
        echo "<td>" . $dato['actividad'] . "</td>";
        echo "<td>" . $dato['descripcion'] . "</td>";
        echo "<td>" . $dato['fecha'] . "</td>";
        echo "<td>
                    <a href='index.php?c=actividad&a=modificarActividad&id=" . $dato["id_actividad"] . "'>Modificar</a>";
        echo "<a href='index.php?c=actividad&a=eliminarActividad&id=" . $dato["id_actividad"] . "'>Eliminar</a>
                    </td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
    </main>

<?php include("./src/View/templates/footer_usuario.php")?>