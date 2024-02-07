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
    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=actualizarHistorialSuscripcion" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">
        <h2 class="title"><?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?></h2>
        <h2>Editar Suscripción Paciente </h2>

        <div class="form-group">
        <label for="ci_paciente" class="form-label">Cédula Paciente:</label>
        <input type="text" id="ci_paciente" name="ci_paciente" readonly required value="<?php echo $data["historialsuscripciones"]["ci_paciente"]?>" class="form-control">
    </div>
    <div class="input-group mb-3">
    <label class="input-group-text" for="id_suscripcion">Suscripcion:</label>
    <select id="id_suscripcion" name="id_suscripcion" required onchange="actualizarDatos()" class="form-select">
        <option selected>Escoja un plan ...</option>
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
            <option value="<?php echo $suscripcion['id_suscripcion']; ?>" data-duracion_dias="<?php echo $suscripcion['duracion_dias']; ?>" <?php echo ($suscripcion['id_suscripcion'] == $usuarioSeleccionadoId) ? 'selected' : ''; ?>>
                <?php echo $suscripcion['suscripcion']; ?>
            </option>
        <?php } ?>
    </select>
    <input type="hidden" readonly id="duracion_dias" name="duracion_dias" value="<?php echo $opcionesSuscripcion[0]['duracion_dias']; ?>">
</div>


    <div class="form-group">
        <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required value="<?php echo $data["historialsuscripciones"]["fecha_inicio"]?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="fechaFin" class="form-label">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required value="<?php echo $data["historialsuscripciones"]["fecha_fin"]?>" class="form-control">
    </div>
    
    <button id="guardar" name="guardar" type="submit" class="btn btn-primary" style="background-color: #22c55e; border-color: #22c55e">Actualizar</button>
</form>
<style>
@media (max-width: 767px) {
    .container,
    .form-group,
    #modificar {
        width: 100%;
        max-width: none;
        min-height: auto;
    }
    
    #modificar {
        max-height: none;
        overflow-y: visible;
    }
    .btn-primary {
    background-color: #22c55e; /* Cambia el color de fondo del botón */
    border-color: #22c55e; /* Cambia el color del borde del botón */
    }
    .btn-primary {
        color: #fff; /* Cambia el color del texto del botón a blanco */
    }

}
</style>

<script>
  function actualizarDatos() {
    var selectSuscripcion = document.getElementById('id_suscripcion');
    var duracionDiasInput = document.getElementById('duracion_dias');
    var fechaInicioInput = document.getElementById('fecha_inicio');
    var fechaFinInput = document.getElementById('fecha_fin');

    var selectedOption = selectSuscripcion.options[selectSuscripcion.selectedIndex];
    var duracionDias = selectedOption.getAttribute('data-duracion_dias');

    // Actualizar la duración de días
    duracionDiasInput.value = duracionDias;

    // Calcular la nueva fecha fin solo si el usuario no ha cambiado la fecha inicio manualmente
    if (!fechaInicioInput.getAttribute('data-user-changed')) {
      calcularFechas(duracionDias);
    }
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
    fechaFinInput.value = fecha_fin.toISOString().split('T')[0];

}

  document.getElementById("fecha_inicio").addEventListener("change", function () {
    var selectSuscripcion = document.getElementById('id_suscripcion');
    var selectedOption = selectSuscripcion.options[selectSuscripcion.selectedIndex];
    var duracionDias = selectedOption.getAttribute('data-duracion_dias');

    // Marcar que el usuario ha cambiado la fecha inicio manualmente
    document.getElementById('fecha_inicio').setAttribute('data-user-changed', 'true');

    calcularFechas(duracionDias);
  });
</script>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>

    

    

    