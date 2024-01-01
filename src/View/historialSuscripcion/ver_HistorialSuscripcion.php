<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack2/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Incluye el modelo necesario o cualquier lógica para obtener los usuarios desde el controlador de historialSuscripcion
require_once __DIR__ . "/../../Model/historialSuscripcionModel.php";
$historialSuscripcionModel = new historialSuscripcionModel();
$data['usuarios'] = $historialSuscripcionModel->getCiPaciente();

?>


<?php include("./src/View/templates/header_administrador.php")?>


<main>

    <h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?></h2>
    <h2>Ver Usuarios</h2>
    <button onclick="window.location.href='http://localhost/NutriTrack2/index.php?c=Suscripcion&a=verSuscripcion'">Ver Planes</button>
    <table border="1" width="40%" id="tabla_id">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Agregar Plan</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data['usuarios'] as $dato) {
                echo "<tr>";
                echo "<td>".$dato['ci_usuario']."</td>";
                echo "<td>".$dato['nombres']."</td>";
                echo "<td>".$dato['apellidos']."</td>";
                echo "<td><a href='index.php?c=historialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario=".$dato["ci_usuario"]."'>Asignar Plan</a></td>";


                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>
