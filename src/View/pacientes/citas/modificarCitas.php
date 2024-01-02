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
    <h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?></h2>

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=actualizarCitas" autocomplete="off">
        <h2>Editar <?php echo $data['titulo'];?></h2>

        <input type="hidden" id="id_cita" name="id_cita" required value="<?php echo $data["id_cita"]; ?>">

        <label for="ci_paciente">Paciente:</label>
        <input type="text" id="ci_paciente" name="ci_paciente" required readonly value="<?php echo $data["citas"]["ci_paciente"]?>">

        <label for="fecha2">Fecha: <?php echo $data["citas"]["fecha"];?></label>
        <input type="date" id="fecha2" name="fecha2" required >

        <label for="horas_disponibles">Horas Disponibles:</label>
        <select name="horas_disponibles">
            <?php foreach ($data['horas_disponibles'] as $hora): ?>
                <option value="<?= $hora ?>" <?php echo ($hora == $data["citas"]["horas_disponibles"]) ? 'selected' : ''; ?>><?= $hora ?></option>
            <?php endforeach; ?>
        </select>

        <label for="ci_nutriologa">Nutriologa:</label>
        <input type="text" id="ci_nutriologa" name="ci_nutriologa" required readonly value="<?php echo $data["citas"]["ci_nutriologa"]?>">
        
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
    </form>
</main>



<?php include("./src/View/templates/footer_usuario.php")?>
