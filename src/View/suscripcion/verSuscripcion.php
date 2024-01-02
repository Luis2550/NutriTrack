<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main>
<h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
<button onclick="window.location.href='http://localhost/NutriTrack/index.php?c=Suscripcion&a=nuevoSuscripcion'">Agregar Plan</button>
<h2>Ver Suscripcion</h2>

<?php if(isset($data['mensaje'])): ?>
        <div class="mensaje"><?php echo $data['mensaje']; ?></div>
    <?php endif; ?>
    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Suscripcion</th>
                <th>Suscripcion</th>
                <th>Duracion Dias</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['suscripcion'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_suscripcion']."</td>";
                        echo"<td>".$dato['suscripcion']."</td>";
                        echo"<td>".$dato['duracion_dias']."</td>";
                        
                        echo "<td><a href='index.php?c=Suscripcion&a=modificarSuscripcion&id=".$dato["id_suscripcion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Suscripcion&a=eliminarSuscripcion&id=".$dato["id_suscripcion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>