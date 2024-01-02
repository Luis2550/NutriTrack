<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main main_ingresar_cita"> 

<h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=guardarCitas" autocomplete="off">
    
  <h2>Registro de Citas</h2>

    <label for="ci_paciente">Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario'];?>">

    <label for="fecha2">Fecha:</label>
    <input type="date" id="fecha2" name="fecha2" required>

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
    <button id="guardar" name="guardar" type="submit">Registrar</button>
</form>
</main>

<?php include("./src/View/templates/footer_usuario.php")?>
