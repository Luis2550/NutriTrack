<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php
// Array para almacenar los días permitidos
$diasPermitidos = [];

// Iterar sobre el array $configuraciones e imprimir el campo dias_semana
foreach ($configuraciones as $configuracion) {
    // Convertir la cadena de días_semana a un array
    $diasConfiguracion = explode(',', $configuracion['dias_semana']);

    // Agregar los días al array $diasPermitidos
    $diasPermitidos = array_merge($diasPermitidos, $diasConfiguracion);
}

// Eliminar duplicados y ordenar alfabéticamente (opcional)
$diasPermitidos = array_unique($diasPermitidos);
sort($diasPermitidos);
?>

<?php include("./src/View/templates/header_usuario.php")?>

<main class="main main_ingresar_cita"> 

    <h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=guardarCitas" autocomplete="off">

        <h2>Registro de Citas</h2>

        <h2 class="diaslaborales">Dias Laborales: <?php
            // Iterar sobre el array $configuraciones e imprimir el campo dias_semana
            foreach ($configuraciones as $configuracion) {
                echo $configuracion['dias_semana'];
            }?></h2> 

        <h2 class="diaslaborales">Dias Feriados: <?php echo $configuraciones[0]['dias_Feriados']?></h2>

        <label for="ci_paciente">Paciente:</label>
        <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario'];?>">

        <label for="fecha2">Fecha:</label>
        <input type="date" id="fecha2" name="fecha2" min="<?= $fecha_actual; ?>" max="<?= $fecha_maxima?>" required>

        <label for="horas_disponibles">Horas Disponibles:</label>
        <select id="horas_disponibles" name="horas_disponibles" required>
            <?php foreach ($data['horas_disponibles'] as $hora) : ?>
                <option value="<?= $hora ?>"><?= $hora ?></option>
            <?php endforeach; ?>
        </select>

        <label for="ci_nutriologa">Nutrióloga:</label>
        <input type="text" id="ci_nutriologa" name="ci_nutriologa" readonly value="<?php echo $data['ci_nutriologa']; ?>">

        <?php if (isset($_GET['error_message'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['error_message']); ?></p>
        <?php endif; ?>

        <br>
        <button id="agendar" name="agendar" type="submit">Agendar</button>
    </form>
</main>

<?php include("./src/View/templates/footer_usuario.php")?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nuevo').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe de manera predeterminada
        event.preventDefault();

        // Muestra la alerta después de unos segundos
        setTimeout(function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cita agendada con éxito",
                showConfirmButton: false,
            });
        }, 1000); // Cambia el valor del temporizador según tus necesidades

        // Envía el formulario después de mostrar la alerta
        setTimeout(function () {
            document.getElementById('nuevo').submit();
        }, 3000); // Asegúrate de ajustar el valor del temporizador según el tiempo de la alerta
    });
});
</script>
