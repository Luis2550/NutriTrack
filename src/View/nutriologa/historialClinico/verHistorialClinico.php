<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_historialCli"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Historial Clinico</h2>

    
    <table border="1" width="100%" id="tabla_id">
    <thead>
        <tr>
            <th>Código</th>
            <!-- <th>Cédula Paciente</th> -->
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Fecha Creación</th>

            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['historial_clinico'] as $historia): ?>
            <tr>
                <td><?php echo $historia['id_historial_clinico']; ?></td>
                <!-- <td><?php echo $historia['ci_paciente']; ?></td> -->
                <td><?php echo $historia['nombres']; ?></td>
                <td><?php echo $historia['apellidos']; ?></td>
                <td><?php echo $historia['fecha_creacion']; ?></td>
                <?php echo "<td class='acciones'>
                            <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=asignarHistorialClinico&id=".$historia['id_historial_clinico']."' class='btn'>Asignar</a>
                            <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=modificarHistorialClinico&id=".$historia['id_historial_clinico']."' class='btn'>Modificar</a>
                            <a href='http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialPaciente&id=".$historia['id_historial_clinico']."' class='btn'>Ver historial</a>

                 </td>";?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </main>

<?php include("./src/View/templates/footer_administrador.php")?>