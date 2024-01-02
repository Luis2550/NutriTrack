<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main main_citas"> 

<h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> 
</h2>

    <h1>Citas del Paciente</h1>

    <?php if (!empty($data['citas'])): ?>
        <table border="1">
            <tr>
                <th>Numero cita</th>
                <th>Fecha</th>
                <th>Hora de la cita</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($data['citas'] as $cita): ?>
                <tr>
                    <td><?= $cita['id_cita'] ?></td>
                    <td><?= $cita['fecha'] ?></td>
                    <td><?= $cita['horas_disponibles'] ?></td>
                    <td><?= $cita['estado'] ?></td>
                        <td>
                        <a href='index.php?c=Citas&a=modificarCitas&id=<?= $cita['id_cita']?>' class="btn">Modificar</a>
                        <a href='index.php?c=Citas&a=eliminarCitasPaciente&id=<?= $cita['id_cita'] ?>' class="btn btn-eliminar">Cancelar</a>
                        </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay citas registradas para este paciente.</p>
    <?php endif; ?>

    </main>

<?php include("./src/View/templates/footer_usuario.php")?>
