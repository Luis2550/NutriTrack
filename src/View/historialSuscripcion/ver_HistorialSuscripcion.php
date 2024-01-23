<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
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
    <button onclick="window.location.href='http://localhost/NutriTrack/index.php?c=Suscripcion&a=verSuscripcion'">Ver Planes</button>
    <table border="1" width="40%" id="tabla_id">

        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['historialsuscripciones'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['fecha_inicio']."</td>";
                        echo"<td>".$dato['fecha_fin']."</td>";
                        echo"<td>".$dato['estado']."</td>";
                        echo "<td><a href='index.php?c=HistorialSuscripcion&a=modificarHistorialSuscripcion&id=".$dato["id_suscripcion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=HistorialSuscripcion&a=eliminarHistorialSuscripcion&id=".$dato["id_suscripcion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
        <?php if (isset($_GET['error_message'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error_message']); ?></p>
        <?php endif; ?>

</main>

    </table>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>
