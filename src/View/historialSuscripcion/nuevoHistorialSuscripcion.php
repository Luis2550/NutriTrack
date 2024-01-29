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
<form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=guardarHistorialSuscripcion" autocomplete="off" class="container mt-5 d-flex flex-column align-items-center">
    <h2>Registro <?php echo $data['titulo']; ?></h2>

    <div class="mb-3 w-100">
        <label for="ci_usuario" class="form-label">Cédula del Usuario:</label>
        <input type="text" id="ci_usuario" name="ci_usuario" value="<?php echo htmlspecialchars($_GET['ci_usuario'] ?? ''); ?>" readonly class="form-control">
    </div>

    <div class="mb-3 w-100">
        <label for="id_suscripcion" class="form-label">Suscripcion:</label>
        <select id="id_suscripcion" name="id_suscripcion" required onchange="actualizarDatos()" class="form-select">
            <?php foreach ($data['opciones_suscripcion'] as $suscripcion) { ?>
                <option value="<?php echo $suscripcion['id_suscripcion']; ?>" data-duracion_dias="<?php echo $suscripcion['duracion_dias']; ?>"><?php echo $suscripcion['suscripcion']; ?></option>
            <?php } ?>
        </select>
        <input type="hidden" readonly id="duracion_dias" name="duracion_dias" value="<?php echo $data['opciones_suscripcion'][0]['duracion_dias']; ?>">
    </div>

    <div class="mb-3 w-100">
        <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" onchange="calcularFechas()" required class="form-control">
    </div>

    <div class="mb-3 w-100">
        <label for="fecha_fin" class="form-label">Fecha Fin:</label>
        <input type="date" readonly id="fecha_fin" name="fecha_fin" required class="form-control">
    </div>

    <div id="error-message" class="mb-3 w-100"><?php echo isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : ""; ?></div>
    <div id="success-message" class="mb-3 w-100"><?php echo isset($_SESSION["success_message"]) ? $_SESSION["success_message"] : ""; ?></div>

    <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Registrar</button>
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
  if (fechaInicio < fechaActual) {
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