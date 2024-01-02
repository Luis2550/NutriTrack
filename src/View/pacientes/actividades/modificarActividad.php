
<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main main_nuevo_actividades"> 

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=actividad&a=actualizarActividad" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id_actividad"]; ?>" />

    <label for="ci_pacientes">Ci Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $data["actividad"]["ci_paciente"]?>">

    <label for="actividad">Actividad:</label>
    <input type="text" id="actividad" name="actividad" required value="<?php echo $data["actividad"]["actividad"]?>">
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion" class='textarea' required>
    <?php echo htmlspecialchars($data["actividad"]["descripcion"]); ?></textarea>

    <label for="fecha">Fecha :</label>
    <input type="date" id="fecha" name="fecha" readonly value="<?php echo $data["actividad"]["fecha"]?>">

    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
</form>

</main>

<?php include("./src/View/templates/footer_usuario.php")?>
