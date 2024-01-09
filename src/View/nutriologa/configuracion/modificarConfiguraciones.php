<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

include("./src/View/templates/header_administrador.php")
?>

<main class="main main_configuracion">
    <div class="vista_configuracion">
        <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

        <form id="modificar" name="modificar" method="POST" action="index.php?c=Configuracion&a=actualizarConfiguraciones">
            <h2>Modificar Configuración</h2>

            <label for="ci_nutriologa">Cedula:</label>
            <input type="text" id="ci_nutriologa" name="ci_nutriologa" value="<?php echo $data["configuraciones"]['ci_nutriologa']; ?>"><br>

            <label for="hora_inicio_manana">Hora de inicio (mañana):</label>
            <input type="time" id="hora_inicio_manana"  name="hora_inicio_manana" value="<?php echo $data["configuraciones"]['hora_inicio_manana']; ?>"  required><br>

            <label for="hora_fin_manana">Hora de fin (mañana):</label>
            <input type="time" id="hora_fin_manana"  name="hora_fin_manana" value="<?php echo $data["configuraciones"]['hora_fin_manana']; ?>" required><br>

            <label for="hora_inicio_tarde">Hora de inicio (tarde):</label>
            <input type="time" id="hora_inicio_tarde"  name="hora_inicio_tarde" value="<?php echo $data["configuraciones"]['hora_inicio_tarde']; ?>" required><br>

            <label for="hora_fin_tarde">Hora de fin (tarde):</label>
            <input type="time" id="hora_fin_tarde"  name="hora_fin_tarde" value="<?php echo $data["configuraciones"]['hora_fin_tarde']; ?>"required><br>

            <label for="dias_semana">Días de la semana:</label>
            <!-- <input type="text" id="dias_semana"  name="dias_semana" value="<?php echo $data["configuraciones"]['dias_semana']; ?>" placeholder="Ejemplo: Lunes,Martes,Miercoles,Viernes" required><br> -->

            <?php
            // Supongamos que $data["configuraciones"]['dias_semana'] es un string con los días seleccionados, separados por comas
            $diasSeleccionados = $data["configuraciones"]['dias_semana'] ? explode(',', $data["configuraciones"]['dias_semana']) : [];

            // Supongamos que $data["configuraciones"]['duracion_cita'] es la duración seleccionada
            $duracionCita = $data["configuraciones"]['duracion_cita'];
            ?>

            <select id="dias_semana" name="dias_semana[]" multiple>
                <option value="Lunes" <?php echo in_array('Lunes', $diasSeleccionados) ? 'selected' : ''; ?>>Lunes</option>
                <option value="Martes" <?php echo in_array('Martes', $diasSeleccionados) ? 'selected' : ''; ?>>Martes</option>
                <option value="Miércoles" <?php echo in_array('Miércoles', $diasSeleccionados) ? 'selected' : ''; ?>>Miércoles</option>
                <option value="Jueves" <?php echo in_array('Jueves', $diasSeleccionados) ? 'selected' : ''; ?>>Jueves</option>
                <option value="Viernes" <?php echo in_array('Viernes', $diasSeleccionados) ? 'selected' : ''; ?>>Viernes</option>
                <option value="Sábado" <?php echo in_array('Sábado', $diasSeleccionados) ? 'selected' : ''; ?>>Sábado</option>
                <option value="Domingo" <?php echo in_array('Domingo', $diasSeleccionados) ? 'selected' : ''; ?>>Domingo</option>
            </select>
            
            <br><br>
            <label for="duracion_cita">Duración de la cita:</label>
            <select name="duracion_cita" id="duracion_cita" required>
                <option value="00:30:00" <?php echo ($duracionCita === '00:30:00') ? 'selected' : ''; ?>>30 min</option>
                <option value="01:00:00" <?php echo ($duracionCita === '01:00:00') ? 'selected' : ''; ?>>1 hora</option>
            </select><br>


            <input type="hidden" name="id_configuracion" value="<?php echo $data["configuraciones"]['id_configuracion']; ?>">

            <button id="guardar" name="guardar" type="submit">Guardar</button>
        </form>
    </div>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>
