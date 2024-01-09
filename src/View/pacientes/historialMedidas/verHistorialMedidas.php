<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>

<main class="main main_historialCli"> 
    <h2>Historial de Medidas</h2>

    <?php if (!empty($data['historial_medidas'])) : ?>
        <?php foreach ($data['historial_medidas'] as $medida) : ?>
            <ul>
                <li><strong>ID Historial de Medidas:</strong> <?php echo $medida['id_historial_medidas']; ?></li>
                <li><strong>ID Historial Clínico:</strong> <?php echo $medida['id_historial_clinico']; ?></li>
                <li><strong>Peso:</strong> <?php echo $medida['peso']; ?> KG</li>
                <li><strong>Estatura:</strong> <?php echo $medida['estatura']; ?> CM</li>
                <li><strong>Presión Arterial Sistólica:</strong> <?php echo $medida['presion_arterial_sistolica']; ?> mmHg</li>
                <li><strong>Presión Arterial Diastólica:</strong> <?php echo $medida['presion_arterial_diastolica']; ?> mmHg</li>
                <li><strong>Fecha:</strong> <?php echo $medida['fecha']; ?></li>
            </ul>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No hay historial de medidas disponible.</p>
    <?php endif; ?>

    <!-- Puedes agregar más detalles o estilos según tus necesidades -->
</main>

<?php include("./src/View/templates/footer_usuario.php")?>
