<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_configuracion">

    <div class="vista_configuracion">

    <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Configuracion&a=guardarConfiguraciones" >
  <h2>Ingresar Configuración</h2>

  
  <label for="ci_nutriologa">Cedula:</label>
  <input type="text" id="ci_nutriologa" name="ci_nutriologa" value="<?php echo $_SESSION['usuario']['ci_usuario']?>"><br>

  <label for="hora_inicio_manana">Hora de inicio (mañana):</label>
    <input type="time" id="hora_inicio_manana"  name="hora_inicio_manana" step="1" required><br>

    <label for="hora_fin_manana">Hora de fin (mañana):</label>
    <input type="time" id="hora_fin_manana"  name="hora_fin_manana" step="1" required><br>

    <label for="hora_inicio_tarde">Hora de inicio (tarde):</label>
    <input type="time" id="hora_inicio_tarde"  name="hora_inicio_tarde" step="1" required><br>

    <label for="hora_fin_tarde">Hora de fin (tarde):</label>
    <input type="time" id="hora_fin_tarde"  name="hora_fin_tarde" step="1" required><br>

    <label for="dias_semana">Días de la semana:</label>
    <input type="text" id="dias_semana"  name="dias_semana" placeholder="Ejemplo: Lunes,Martes,Miercole,Viernes" required><br>

    <label for="duracion_cita">Duración de la cita:</label>
    <input type="time" id="duracion_cita"  name="duracion_cita" step="1" required><br>


    <button id="guardar" name="guardar" type="submit">Guardar</button>
</form>
  </main>

<?php include("./src/View/templates/footer_administrador.php")?>