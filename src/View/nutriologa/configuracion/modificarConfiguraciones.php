<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

include("./src/View/templates/header_administrador.php")
?>


    <div class="main_configuracion vista_configuracion">

        <h2 class="title"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

        <form id="modificar" name="modificar" method="POST" action="index.php?c=Configuracion&a=actualizarConfiguraciones">
            <h2>Modificar Configuración</h2>

            <label for="ci_nutriologa">Cedula:</label>
            <input type="text" id="ci_nutriologa" name="ci_nutriologa" value="<?php echo $data["configuraciones"]['ci_nutriologa']; ?>"><br>

            <label for="hora_inicio_manana">Hora de inicio (mañana):</label>
            <select id="hora_inicio_manana" name="hora_inicio_manana" required>
                <?php
                // Define la hora de inicio y fin
                $hora_inicio = strtotime('07:00:00');
                $hora_fin = strtotime('13:00:00');

                // Genera opciones para cada hora en intervalos de 15 minutos
                while ($hora_inicio <= $hora_fin) {
                    $hora_actual = date('H:i:s', $hora_inicio);
                    echo "<option value=\"$hora_actual\"";
                    
                    // Marca la opción como seleccionada si coincide con el valor almacenado
                    if ($data["configuraciones"]['hora_inicio_manana'] == $hora_actual) {
                        echo " selected";
                    }

                    echo ">$hora_actual</option>";

                    // Aumenta la hora en 15 minutos
                    $hora_inicio = strtotime('+1 hour', $hora_inicio);
                }
                ?>
            </select>
            <br><br>

            <label for="hora_fin_manana">Hora de fin (mañana):</label>
            <select id="hora_fin_manana" name="hora_fin_manana" required>
                <?php
                // Define la hora de inicio y fin
                $hora_inicio = strtotime('07:00');
                $hora_fin = strtotime('13:00');

                // Genera opciones para cada hora en intervalos de 1 hora
                while ($hora_inicio <= $hora_fin) {
                    $hora_actual = date('H:i:s', $hora_inicio);
                    echo "<option value=\"$hora_actual\"";
                    
                    // Marca la opción como seleccionada si coincide con el valor almacenado
                    if ($data["configuraciones"]['hora_fin_manana'] == $hora_actual) {
                        echo " selected";
                    }

                    echo ">$hora_actual</option>";

                    // Aumenta la hora en 1 hora
                    $hora_inicio = strtotime('+1 hour', $hora_inicio);
                }
                ?>
            </select><br><br>

            <label for="hora_inicio_tarde">Hora de inicio (tarde):</label>
            <select id="hora_inicio_tarde" name="hora_inicio_tarde" required>
                <?php
                // Define la hora de inicio y fin para la tarde
                $hora_inicio_tarde = strtotime('15:00:00');
                $hora_fin_tarde = strtotime('22:00:00');

                // Genera opciones para cada hora en intervalos de 1 hora
                while ($hora_inicio_tarde <= $hora_fin_tarde) {
                    $hora_actual_tarde = date('H:i:s', $hora_inicio_tarde);
                    echo "<option value=\"$hora_actual_tarde\"";
                    
                    // Marca la opción como seleccionada si coincide con el valor almacenado
                    if ($data["configuraciones"]['hora_inicio_tarde'] == $hora_actual_tarde) {
                        echo " selected";
                    }

                    echo ">$hora_actual_tarde</option>";

                    // Aumenta la hora en 1 hora
                    $hora_inicio_tarde = strtotime('+1 hour', $hora_inicio_tarde);
                }
                ?>
            </select><br><br>

            <label for="hora_fin_tarde">Hora de fin (tarde):</label>
            <select id="hora_fin_tarde" name="hora_fin_tarde" required>
                <?php
                // Define la hora de inicio y fin para la tarde
                $hora_inicio_tarde = strtotime('15:00:00');
                $hora_fin_tarde = strtotime('22:00:00');

                // Genera opciones para cada hora en intervalos de 1 hora
                while ($hora_inicio_tarde <= $hora_fin_tarde) {
                    $hora_actual_tarde = date('H:i:s', $hora_inicio_tarde);
                    echo "<option value=\"$hora_actual_tarde\"";
                    
                    // Marca la opción como seleccionada si coincide con el valor almacenado
                    if ($data["configuraciones"]['hora_fin_tarde'] == $hora_actual_tarde) {
                        echo " selected";
                    }

                    echo ">$hora_actual_tarde</option>";

                    // Aumenta la hora en 1 hora
                    $hora_inicio_tarde = strtotime('+1 hour', $hora_inicio_tarde);
                }
                ?>
            </select><br><br>

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

            <h2>Dias de feriado:</h2>
            <input type="text" id="dias_Feriados" name="dias_Feriados" value="<?php echo $data["configuraciones"]['dias_Feriados'];?>" readonly>
            <!-- <button type="button" class="btn-fecha" id="guardarFechas">Guardar Fechas</button>

            <div id="fechasGuardadas">-->
            
            <br>
            <label for="duracion_cita">Duración de la cita:</label>
            <select name="duracion_cita" id="duracion_cita" required>
                <option value="00:30:00" <?php echo ($duracionCita === '00:30:00') ? 'selected' : ''; ?>>30 min</option>
                <option value="01:00:00" <?php echo ($duracionCita === '01:00:00') ? 'selected' : ''; ?>>1 hora</option>
            </select><br>


            <input type="hidden" name="id_configuracion" value="<?php echo $data["configuraciones"]['id_configuracion']; ?>">

            <button id="guardar" name="guardar" type="submit">Guardar</button>
        </form>
    </div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        // Inicializa flatpickr para seleccionar múltiples fechas
        var fechaPicker = flatpickr("#dias_Feriados", {
            enableTime: false,
            dateFormat: "Y-m-d",
            mode: "multiple",
        });

        // Array para almacenar las fechas seleccionadas
        var fechasSeleccionadas = [];

        // Maneja el evento del botón "Guardar Fechas"
        $("#guardarFechas").on("click", function() {
            // Obtiene las fechas seleccionadas
            var selectedDates = fechaPicker.selectedDates;

            // Agrega las fechas seleccionadas al array
            fechasSeleccionadas = fechasSeleccionadas.concat(selectedDates);

            // Muestra todas las fechas almacenadas debajo del formulario
            mostrarFechas(fechasSeleccionadas);
            
            // Actualiza el campo oculto con las fechas seleccionadas
            actualizarCampoOculto(fechasSeleccionadas);
        });

        // Función para mostrar todas las fechas almacenadas debajo del formulario
        function mostrarFechas(fechas) {
            // Contenedor donde se mostrarán todas las fechas
            var fechasGuardadasContainer = $("#fechasGuardadas");

            // Crea un elemento de lista para cada fecha
            var listaFechas = "<ul>";
            fechas.forEach(function(fecha) {
                listaFechas += "<li>" + fecha.toLocaleDateString() + "</li>";
            });
            listaFechas += "</ul>";

            // Agrega la lista de fechas al contenedor
            fechasGuardadasContainer.html(listaFechas);
        }

        // Función para actualizar el campo oculto con las fechas seleccionadas
        function actualizarCampoOculto(fechas) {
            // Convierte las fechas a formato de texto antes de enviarlas al servidor
            var fechasTexto = fechas.map(function(fecha) {
                return fecha.toISOString().split('T')[0];
            });

            // Actualiza el valor del campo oculto con las fechas seleccionadas
            $("#dias_Feriados").val(fechasTexto.join(','));
        }
    });
</script>


<?php include("./src/View/templates/footer_administrador.php")?>
