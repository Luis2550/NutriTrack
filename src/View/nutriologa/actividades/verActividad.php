<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_actividades"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Actividades</h2>

<table id='tabla_id'>

<thead>
    <tr>
        <th>Cedula Paciente</th>
        <th>Actividad</th>
        <th>Descripcion</th>
        <th>Fecha</th>
    </tr>
</thead>

<tbody>

    <?php
    // Cambia el bucle para usar las actividades obtenidas del controlador
    foreach ($data['actividad'] as $dato) {
        echo "<tr>";
        echo "<td>" . $dato['ci_paciente'] . "</td>";
        echo "<td>" . $dato['actividad'] . "</td>";
        echo "<td>" . $dato['descripcion'] . "</td>";
        echo "<td>" . $dato['fecha'] . "</td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
    </main>

<?php include("./src/View/templates/footer_administrador.php")?>