
<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_nuevo_actividades"> 

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=actividad&a=actualizarActividad" autocomplete="off">
    <h2>Actividad del Paciente <?php echo $data["actividad"]["nombres"]. " " .$data["actividad"]["apellidos"]?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id_actividad"]; ?>" />

    <label for="ci_pacientes">Ci Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $data["actividad"]["ci_paciente"]?>">

    <label for="actividad">Actividad:</label>
    <input type="text" id="actividad" name="actividad" readonly required value="<?php echo $data["actividad"]["actividad"]?>">
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" readonly name="descripcion" class='textarea' required>
    <?php echo htmlspecialchars($data["actividad"]["descripcion"]); ?></textarea>

    <label for="fecha">Fecha :</label>
    <input type="date" readonly id="fecha" name="fecha" readonly value="<?php echo $data["actividad"]["fecha"]?>">

</form>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>
