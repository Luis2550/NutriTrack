<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Historial Suscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_historial container-fluid mt-4">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
            <form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=guardarHistorialSuscripcion" autocomplete="off" class="needs-validation" novalidate>

                <h2 class="text-center">Registro <?php echo $data['titulo']; ?></h2>

                <div class="form-group">
                    <label for="id_suscripcion">Suscripción:</label>
                    <select class="form-control" id="id_suscripcion" name="id_suscripcion" required onchange="actualizarDatos()">
                        <?php foreach ($data['opciones_suscripcion'] as $suscripcion) { ?>
                            <option value="<?php echo $suscripcion['id_suscripcion']; ?>" data-duracion_dias="<?php echo $suscripcion['duracion_dias']; ?>"><?php echo $suscripcion['suscripcion']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Por favor, selecciona una suscripción.</div>
                </div>

                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" onchange="calcularFechas()" required>
                    <div class="invalid-feedback">Por favor, selecciona una fecha de inicio válida.</div>
                </div>

                <!-- Espacio para mostrar mensajes de error o éxito -->
                <div class="form-group">
                    <div id="error-message" class="alert alert-danger"><?php echo isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : ""; ?></div>
                    <div id="success-message" class="alert alert-success"><?php echo isset($_SESSION["success_message"]) ? $_SESSION["success_message"] : ""; ?></div>
                </div>

                <!-- Botones para enviar o cancelar el formulario -->
                <div class="form-group text-center">
                    <button id="guardar" name="guardar" type="button" class="btn btn-primary" onclick="mostrarVentanaModal()">Registrar</button>
                    
                </div>

                <!-- Ventana modal de confirmación -->
                <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Registro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas realizar este registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Tu código JavaScript aquí
        function actualizarDatos() {
            var selectSuscripcion = document.getElementById('id_suscripcion');
            var duracionDiasInput = document.getElementById('duracion_dias');

            var selectedOption = selectSuscripcion.options[selectSuscripcion.selectedIndex];
            var duracionDias = selectedOption.getAttribute('data-duracion_dias');

            duracionDiasInput.value = duracionDias;
            calcularFechas(duracionDias);
        }

        function cancelarRegistro() {
            // Puedes redirigir a otra página o realizar otras acciones según tus necesidades.
            alert("Registro cancelado");
        }

        function mostrarVentanaModal() {
            $('#confirmacionModal').modal('show');
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>



