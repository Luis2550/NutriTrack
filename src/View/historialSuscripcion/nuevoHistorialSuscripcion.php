<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_historial">

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=guardarHistorialSuscripcion" autocomplete="off">
    
  <h2>Registro <?php echo $data['titulo']; ?></h2>

    <label for="ci_usuario">Cédula del Usuario:</label>
    <input type="text" id="ci_usuario" name="ci_usuario" value="<?php echo htmlspecialchars($_GET['ci_usuario'] ?? ''); ?>" readonly>

    <select id="id_suscripcion" name="id_suscripcion" required onchange="actualizarDatos()">
      <?php foreach ($data['opciones_suscripcion'] as $suscripcion) { ?>
        <option value="<?php echo $suscripcion['id_suscripcion']; ?>" data-duracion_dias="<?php echo $suscripcion['duracion_dias']; ?>"><?php echo $suscripcion['suscripcion']; ?></option>
      <?php } ?>
    </select>

    <label for="duracion_dias">Duración Dias:</label>
    <input type="text" readonly id="duracion_dias" name="duracion_dias" value="<?php echo $data['opciones_suscripcion'][0]['duracion_dias']; ?>">

    <label for="fecha_inicio">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" onchange="calcularFechas()" required>

    <label for="fecha_fin">Fecha Fin:</label>
    <input type="date" readonly id="fecha_fin" name="fecha_fin" required>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
      <option value="SUSCRITO">SUSCRITO</option>
      <option value="SIN SUSCRIPCIÓN">SIN SUSCRIPCIÓN</option>
    </select>
    <div id="error-message"><?php echo isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : ""; ?></div>
    <div id="success-message"><?php echo isset($_SESSION["success_message"]) ? $_SESSION["success_message"] : ""; ?></div>
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

  <script>
    function actualizarDatos() {
      var selectSuscripcion = document.getElementById('id_suscripcion');
      var duracionDiasInput = document.getElementById('duracion_dias');

      var selectedOption = selectSuscripcion.options[selectSuscripcion.selectedIndex];
      var duracionDias = selectedOption.getAttribute('data-duracion_dias');

      duracionDiasInput.value = duracionDias;
      calcularFechas(duracionDias);
    }

    function calcularFechas(duracionDias) {
    var fechaInicioInput = document.getElementById("fecha_inicio");
    var fechaFinInput = document.getElementById("fecha_fin");
    var duracionDiasInput = document.getElementById("duracion_dias");

    // Obtener la fecha de inicio
    var fechaInicio = new Date(fechaInicioInput.value);

    // Obtener la fecha actual
    var fechaActual = new Date();
    fechaActual.setHours(0, 0, 0, 0);  // Establecer las horas, minutos, segundos y milisegundos a cero para comparar solo las fechas

    // Verificar que la fecha de inicio no sea menor a la fecha actual (permitiendo que sea el mismo día)
    if (fechaInicio.getTime() < fechaActual.getTime()) {
      alert("La fecha de inicio no puede ser menor al día actual.");
      fechaInicioInput.valueAsDate = fechaActual;
      fechaInicio = new Date(fechaActual);
    }

    // Calcular la fecha de fin sumando la duración en días a la fecha de inicio
    var fecha_fin = new Date(fechaInicio);
    fecha_fin.setDate(fechaInicio.getDate() + parseInt(duracionDiasInput.value));

    // Actualizar los campos en el formulario
    fechaFinInput.valueAsDate = fecha_fin;
}


  document.getElementById("fecha_inicio").addEventListener("change", function () {
    var selectSuscripcion = document.getElementById('id_suscripcion');
    var selectedOption = selectSuscripcion.options[selectSuscripcion.selectedIndex];
    var duracionDias = selectedOption.getAttribute('data-duracion_dias');
    calcularFechas(duracionDias);
  });
  </script>
</main>


<?php include("./src/View/templates/footer_administrador.php")?>
  



