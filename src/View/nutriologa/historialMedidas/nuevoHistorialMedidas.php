<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>



<main class="main main_historialMed"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=historialMedidas&a=guardarHistorialMedidas" autocomplete="off">
        <h2>Registro</h2>
        
        <label for="id_historial_clinico">Id Historial Clinico:</label>
        
        <input type="text" name="id_historial_clinico" id="id_historial_clinico" name="id_historial_clinico" readonly value="<?php
            foreach ($data['opciones_paciente'] as $paciente) {
                if ($id_clinico == $paciente['id_historial_clinico']) {
                    echo "{$paciente['id_historial_clinico']}";
                }
            }
        ?>">


        <!-- Agregamos las validaciones directamente en los campos -->
        <label for="peso">Peso (KG)*</label>
        <input type="number" id="peso" min="5" max="500" name="peso" required oninput="validarPeso()">
        <div id="pesoError" style="color: red;"></div>

        <label for="estatura">Estatura (CM)*</label>
        <input type="number" id="estatura" min="50" max="300" name="estatura" required min="50" max="300" oninput="validarTalla()">
        <div id="estaturaError" style="color: red;"></div>

        <label for="presion_s">Presión Arterial Sistólica:</label>
        <input type="number"  id="presion_s" min="70" max="200" name="presion_s" required oninput="validarPresiones()">
        <div id="presion_sError" style="color: red;"></div>

        <label for="presion_d">Presión Arterial Diastólica:</label>
        <input type="number" id="presion_d"  min="40" max="120" name="presion_d" required oninput="validarPresiones()">
        <div id="presion_dError" style="color: red;"></div>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $fecha_actual?>" readonly>

        <button id="guardar" name="guardar" type="submit" class="button">Guardar</button>
    </form>

    <script>
        function validarPeso() {
            var pesoInput = document.getElementById('peso');
            var pesoError = document.getElementById('pesoError');
    
            var peso = pesoInput.value;
    
            if (isNaN(peso) || peso < 5 || peso > 500) {
                pesoError.innerHTML = 'Por favor, ingrese un peso válido entre 5 KG y 500 KG.';
            } else {
                pesoError.innerHTML = '';
            }
        }
    
        function validarTalla() {
            var tallaInput = document.getElementById('estatura');
            var tallaError = document.getElementById('estaturaError');
    
            var talla = tallaInput.value;
    
            if (isNaN(talla) || talla < 50 || talla > 300) {
                tallaError.innerHTML = 'Por favor, ingrese una talla válida entre 50 y 300 CM.';
            } else {
                tallaError.innerHTML = '';
            }
        }

        function validarPresiones() {
            var presionSInput = document.getElementById('presion_s');
            var presionDInput = document.getElementById('presion_d');
            var presionSError = document.getElementById('presion_sError');
            var presionDError = document.getElementById('presion_dError');
    
            var presionS = presionSInput.value;
            var presionD = presionDInput.value;
    
            if (isNaN(presionS) || presionS < 70 || presionS > 200) {
                presionSError.innerHTML = 'Por favor, ingrese una presión sistólica válida entre 70 y 200.';
            } else {
                presionSError.innerHTML = '';
            }
    
            if (isNaN(presionD) || presionD < 40 || presionD > 120) {
                presionDError.innerHTML = 'Por favor, ingrese una presión diastólica válida entre 40 y 120.';
            } else {
                presionDError.innerHTML = '';
            }
        }
    </script>


    <?php include("./src/View/templates/footer_administrador.php")?>
