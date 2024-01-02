<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>


<?php include("./src/View/templates/header_administrador.php")?>
<main class="main mainHistorial" >
<form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=actualizarHistorialSuscripcion" autocomplete="off">
    <h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?></h2>
    <h2>Editar <?php echo $data['titulo'];?></h2>


    <label for="ci_paciente">Cédula Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" readonly required value="<?php echo $data["historialsuscripciones"]["ci_paciente"]?>">
    
    <label for="id_suscripcion">ID Suscripcion:</label>
    <select id="id_suscripcion" name="id_suscripcion" required>
        <?php
        $usuarioSeleccionadoId = $data["historialsuscripciones"]["id_suscripcion"];
        $usuarioSeleccionadoSuscripcion = $data["historialsuscripciones"]["suscripcion"];

        // Mueve el usuario seleccionado al principio del array
        $opcionesSuscripcion = $data2['opciones_suscripcion'];
        usort($opcionesSuscripcion, function($a, $b) use ($usuarioSeleccionadoId) {
            return ($a['id_suscripcion'] == $usuarioSeleccionadoId) ? -1 : 1;
        });

        // Ahora, muestra las opciones
        foreach ($opcionesSuscripcion as $suscripcion) {
        ?>
            <option value="<?php echo $suscripcion['id_suscripcion']; ?>"><?php echo $suscripcion['suscripcion']; ?></option>
        <?php } ?>
    </select>

    
    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" required value="<?php echo $data["historialsuscripciones"]["fecha_inicio"]?>">

    <label for="duracion_cita">Fecha Fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin" required value="<?php echo $data["historialsuscripciones"]["fecha_fin"]?>">
    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
        <option value="SIN SUSCRIPCION" <?php echo ($data["historialsuscripciones"]["estado"] == "SIN SUSCRIPCION") ? "selected" : ""; ?>>SIN SUSCRIPCION</option>
        <option value="SUSCRITO" <?php echo ($data["historialsuscripciones"]["estado"] == "SUSCRITO") ? "selected" : ""; ?>>SUSCRITO</option>
    </select>
    <br>

    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
</form>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>

    

    

    