<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_historialCli"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

<h1>Historial Clínico</h1>

    <div class="formulario-intro-container">
        <div class="formulario-intro">
        <p>
            El objetivo de este formulario es obtener información que nos permita armar tu asesoría con la mayor cantidad de información posible desde el principio. Esto nos ayudará a hacer el seguimiento nutricional lo más individualizado posible para que puedas lograr tus metas.
        </p>
        <p>
            A continuación, encontrarás una serie de preguntas relacionadas a tu salud. Es sumamente importante que las respondas de forma honesta, ya que estas podrían ser trascendentales al planear y ejecutar tu seguimiento.
        </p>
        <p>
            Esta información nos ayudará a tomar todas las precauciones y resguardos necesarios para tu salud, además de contribuir a brindarte un apropiado cuidado en tu salud alimenticia. En caso de no tener seguridad respecto a alguna pregunta planteada, o bien no entender su significado o importancia, o cómo esta se relaciona con tu estado de salud, te rogamos conversarlo con la nutrióloga.
        </p>
    </div>

    <form action="index.php?c=historialClinico&a=actualizarHistorialClinico" method="post">
        
      <input type="hidden" id = "id_historial_clinico" name="id_historial_clinico" value= "<?php echo $data['historial_clinico']['id_historial_clinico']?>">
    
      <label for="fecha_creacion">Fecha Creacion*</label>
        <input type="date" id="fecha_creacion" name="fecha_creacion" readonly required value="<?php echo $fecha_actual ?>">
        
        <label for="nombres">NOMBRES COMPLETOS DEL PACIENTE*</label>
        <input type="text" value="<?php echo $data['historial_clinico']['nombres'] ?>" id="nombres" readonly name="nombres" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" title="Solo se permiten letras y espacios" required>

        <label for="apellidos">APELLIDOS COMPLETOS DEL PACIENTE*</label>
        <input type="text" value="<?php echo $data['historial_clinico']['apellidos'] ?>" id="nombres" readonly name="nombres" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" title="Solo se permiten letras y espacios" required>

        <label for="cedula">NUMERO DE IDENTIFICACION (CÉDULA)*</label>
        <input type="text" value="<?php echo $data['historial_clinico']['ci_paciente'] ?>" readonly id="cedula" name="cedula">

        
        <div class="question-container_m">
        <label for="genero">GÉNERO: ¿CON QUÉ GÉNERO SE IDENTIFICA?*</label>
        <div class="check-container_m">
        <?php
        $sexo = $data['historial_clinico']['sexo'];
        $opciones = ["FEMENINO", "MASCULINO"];

        foreach ($opciones as $opcion) {
            echo "<input type='radio' id='genero-$opcion' class='genero-radio' name='genero' value='$opcion'";
            if ($sexo == $opcion) {
                echo " checked";
            }
            echo ">";
            echo "<label class='option' for='genero-$opcion'>$opcion</label>";
        }
        ?>
    </div>
</div>
      

<label for="edad">EDAD*</label>
<input type="text" readonly id="edad" name="edad" value="<?php echo $data['historial_clinico']['edad'] ?>">


        <label for="correo">CORREO ELECTRÓNICO*</label>
        <input type="text" value="<?php echo $data['historial_clinico']['correo'] ?>" readonly id="cedula" name="cedula">

        <label for="ocupacion">OCUPACIÓN</label>
        <input type="text" value="<?php echo $data['historial_clinico']['ocupacion'] ?>" id="ocupacion" name="ocupacion" required>

        <label for="celular">NUMERO DE CELULAR*</label>
<input type="tel" value="<?php echo $data['historial_clinico']['celular'] ?>" id="celular" name="celular" pattern="\d{10}" required>

<div id="celularError" style="color: red;"></div>

<script>
  function validarCelular() {
    var celularInput = document.getElementById('celular');
    var celularError = document.getElementById('celularError');

    var celular = celularInput.value;

    if (!/^\d{10}$/.test(celular)) {
      celularError.innerHTML = 'Por favor, ingrese un número de celular válido de 10 dígitos.';
    } else {
      celularError.innerHTML = '';
    }
  }

  // Asigna la función de validación al evento oninput del campo de celular
  document.getElementById('celular').addEventListener('input', validarCelular);
</script>


        <label for="direccion">DIRECCIÓN*</label>
        <input type="text" value="<?php echo $data['historial_clinico']['direccion'] ?>" id="direccion" name="direccion" required>

        <label for="enfermedades">ANTECEDENTES MEDICOS PERSONALES: (marque únicamente la opción que aplique)</label>
        <table id="enfermedadesTable">
            <thead>
                <tr>
                    <th>ENFERMEDADES/ CIRUGIAS</th>
                    <th>SI</th>
                    <th>NO</th>
                    <th>No sabe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <tr>
                    <td>Enfermedades Neurológicos: Dolores de cabeza, convulsiones, mareos, parálisis</td>
                    <td><input type="radio" name="neuro"  value="si" <?php if($data['historial_clinico']['neuro'] == 'si') echo 'checked'; ?>></td>
                    <td><input type="radio" name="neuro"  value="no" <?php if($data['historial_clinico']['neuro'] == 'no') echo 'checked'; ?>></td>
                    <td><input type="radio" name="neuro"  value="noSabe" <?php if($data['historial_clinico']['neuro'] == 'noSabe') echo 'checked'; ?>></td>
                   </tr>
                <tr>
                    <td>Enfermedades Hemoglobina: Anemia, desórdenes sanguíneos o problemas de coagulación</td>
                    <td><input type="radio" name="hemoglobina" readonly value="si" <?php if($data['historial_clinico']['hemoglobina'] == 'si') echo 'checked'; ?>></td>
                    <td><input type="radio" name="hemoglobina" readonly value="no" <?php if($data['historial_clinico']['hemoglobina'] == 'no') echo 'checked'; ?>></td>
                    <td><input type="radio" name="hemoglobina" readonly value="noSabe" <?php if($data['historial_clinico']['hemoglobina'] == 'noSabe') echo 'checked'; ?>></td>
                </tr>
                <tr>
                    <td>Enfermedades Gastrointestinales: Problemas digestivos, enfermedad inflamatoria intestinal, úlceras, etc.<td><input type="radio" name="gastro" value="si" <?php if($data['historial_clinico']['gastro'] == 'si') echo 'checked'; ?>></td>
                    <td><input type="radio" name="gastro" value="no" <?php if($data['historial_clinico']['gastro'] == 'no') echo 'checked'; ?>></td>
                    <td><input type="radio" name="gastro" value="noSabe" <?php if($data['historial_clinico']['gastro'] == 'noSabe') echo 'checked'; ?>></td>
                </tr>
                <tr>
                    <td>Enfermedades Respiratorias: Asma, amigdalitis, enfisema, afección laríngea o en bronquios</td>
                    <td><input type="radio" name="respiratorias" value="si" <?php if($data['historial_clinico']['respiratorias'] == 'si') echo 'checked '; ?>></td>
                    <td><input type="radio" name="respiratorias" value="no" <?php if($data['historial_clinico']['respiratorias'] == 'no') echo 'checked '; ?>></td>
                    <td><input type="radio" name="respiratorias" value="noSabe" <?php if($data['historial_clinico']['respiratorias'] == 'noSabe') echo 'checked '; ?>></td>
                </tr>
                <tr>
                    <td>Enfermedades Crónicas: Diabetes, hipertensión, enfermedades cardíacas, enfermedades respiratorias crónicas, artritis, etc.</td>
                    <td><input type="radio" name="cronicas" value="si" <?php if($data['historial_clinico']['cronicas'] == 'si') echo 'checked '; ?>></td>
                    <td><input type="radio" name="cronicas" value="no" <?php if($data['historial_clinico']['cronicas'] == 'no') echo 'checked '; ?>></td>
                    <td><input type="radio" name="cronicas" value="noSabe" <?php if($data['historial_clinico']['cronicas'] == 'noSabe') echo 'checked '; ?>></td>
                </tr>
                <tr>
                    <td>Problemas Endocrinos: Problemas de la tiroides u otras glándulas endocrinas.</td>
                    <td><input type="radio" name="endocrinos" value="si" <?php if($data['historial_clinico']['endocrinos'] == 'si') echo 'checked '; ?>></td>
                    <td><input type="radio" name="endocrinos" value="no" <?php if($data['historial_clinico']['endocrinos'] == 'no') echo 'checked '; ?>></td>
                    <td><input type="radio" name="endocrinos" value="noSabe" <?php if($data['historial_clinico']['endocrinos'] == 'noSabe') echo 'checked '; ?>></td>
                </tr>
                <tr>
                    <td>Cirugías Previas: Cirugías, traumas (accidentes)</td>
                    <td><input type="radio" name="cirugias" value="si" <?php if($data['historial_clinico']['cirugias'] == 'si') echo 'checked '; ?>></td>
                    <td><input type="radio" name="cirugias" value="no" <?php if($data['historial_clinico']['cirugias'] == 'no') echo 'checked '; ?>></td>
                    <td><input type="radio" name="cirugias" value="noSabe" <?php if($data['historial_clinico']['cirugias'] == 'noSabe') echo 'checked '; ?>></td>
                </tr>
                <tr>
                    <td>Alergias e Intolerancias: Alergias alimentarias, alergias a medicamentos, intolerancias, etc.</td>
                    <td><input type="radio" name="alergias" value="si" <?php if($data['historial_clinico']['alergias'] == 'si') echo 'checked '; ?>></td>
                    <td><input type="radio" name="alergias" value="no" <?php if($data['historial_clinico']['alergias'] == 'no') echo 'checked '; ?>></td>
                    <td><input type="radio" name="alergias" value="noSabe" <?php if($data['historial_clinico']['alergias'] == 'noSabe') echo 'checked '; ?>></td>
                </tr>
                <tr>
                <td>Hipertensión, infartos, anginas, soplos, arritmias, enfermedad coronaria</td>
                <td><input type="radio" name="hipertension" value="si" <?php if($data['historial_clinico']['hipertension'] == 'si') echo 'checked '; ?> readonly></td>
                <td><input type="radio" name="hipertension" value="no" <?php if($data['historial_clinico']['hipertension'] == 'no') echo 'checked '; ?> readonly></td>
                <td><input type="radio" name="hipertension" value="noSabe" <?php if($data['historial_clinico']['hipertension'] == 'noSabe') echo 'checked '; ?> readonly></td>


                </tr>
            </tbody>
        </table>
        
<br>
        <label for="motivoConsulta">¿Cuál es el principal motivo de su consulta Nutricional? *</label>
        <select id="motivoConsulta" name="motivoConsulta">
            <option value="perdida_peso" <?php echo ($data['historial_clinico']['motivoConsulta'] === 'perdida_peso') ? 'selected' : ''; ?>>Pérdida de Peso</option>
            <option value="mejora_alimentacion" <?php echo ($data['historial_clinico']['motivoConsulta'] === 'mejora_alimentacion') ? 'selected' : ''; ?>>Mejora de Alimentación</option>
            <option value="condicion_medica" <?php echo ($data['historial_clinico']['motivoConsulta'] === 'condicion_medica') ? 'selected' : ''; ?>>Condición Médica Específica</option>
        </select>


        <div class="question-container">
        <label for="discapacidad">¿TIENE USTED ALGÚNA DISCAPACIDAD?*</label>
        <div class="check-container">
            <input type="radio" id="discapacidad-si" name="discapacidad" value="si" <?php echo ($data['historial_clinico']['discapacidad'] == 'si') ? 'checked' : ''; ?>>
            <label class="option" for="discapacidad-si">Sí</label>

            <input type="radio" id="discapacidad-no" name="discapacidad" value="no" <?php echo ($data['historial_clinico']['discapacidad'] == 'no') ? 'checked' : ''; ?>>
            <label class="option" for="discapacidad-no">No</label>
        </div>
    </div>

        <label for="tipoDiscapacidad">DISCAPACIDAD</label>
        <input type="text" value="<?php echo $data['historial_clinico']['tipoDiscapacidad'] ?>" id="tipoDiscapacidad" name="tipoDiscapacidad">

        <div class="question-container">
        <label for="entrenamiento">¿Actualmente usted entrena(Gimnasio) o realiza algún tipo de actividad física?*</label>
        <div class="check-container">
            <input type="radio" id="entrenamiento-si" name="entrenamiento" value="si" <?php echo ($data['historial_clinico']['entrenamiento'] == 'si') ? 'checked' : ''; ?>>
            <label class="option" for="entrenamiento-si">Sí</label>

            <input type="radio" id="entrenamiento-no" name="entrenamiento" value="no" <?php echo ($data['historial_clinico']['entrenamiento'] == 'no') ? 'checked' : ''; ?>>
            <label class="option" for="entrenamiento-no">No</label>
        </div>
    </div>


    <label for="tiempoEntrenamiento">¿Cuánto tiempo entrena o realiza actividades físicas diariamente?</label>
<div class="radio-container">
    <?php
    $tiempoEntrenamiento = $data['historial_clinico']['tiempoEntrenamiento'];
    
    $opciones = ["10-15", "20-25", "30-40", "40-50", "1hora", "2horas", "3horas"];
    
    foreach ($opciones as $opcion) {
        echo "<input type='radio' id='check$opcion' name='tiempoEntrenamiento' value='$opcion'";
        if ($tiempoEntrenamiento == $opcion) {
            echo " checked";
        }
        echo ">";
        echo "<label for='check$opcion'>$opcion</label>";
    }
    ?>
</div>

<br>
        <div class="question-container">
            <label for="alcohol">ALCOHOL: ¿Toma usted alcohol?*</label>
            <div class="check-container">
            <input type="radio" id="alcohol-si" name="alcohol" value="si" <?php echo ($data['historial_clinico']['alcohol'] == 'si') ? 'checked' : ''; ?>>
            <label class="option" for="alcohol-si">Sí</label>

            <input type="radio" id="alcohol-no" name="alcohol" value="no" <?php echo ($data['historial_clinico']['alcohol'] == 'no') ? 'checked' : ''; ?>>
            <label class="option" for="alcohol-no">No</label>
        </div>
        </div>
    
        <div class="question-container">
            <label for="cafe">CAFE: ¿Toma usted café?*</label>
            <div class="check-container">
            <input type="radio" id="cafe-si" name="cafe" value="si" <?php echo ($data['historial_clinico']['cafe'] == 'si') ? 'checked' : ''; ?>>
            <label class="option" for="cafe-si">Sí</label>

            <input type="radio" id="cafe-no" name="cafe" value="no" <?php echo ($data['historial_clinico']['cafe'] == 'no') ? 'checked' : ''; ?>>
            <label class="option" for="cafe-no">No</label>
        </div>
        </div>
    
        <div class="question-container">
            <label for="medicamentosHabituales">¿Toma usted algún medicamento de forma habitual?*</label>
            <div class="check-container">
            <input type="radio" id="medicamentosHabituales-si" name="medicamentosHabituales" value="si" <?php echo ($data['historial_clinico']['medicamentosHabituales'] == 'si') ? 'checked' : ''; ?>>
            <label class="option" for="medicamentosHabituales-si">Sí</label>

            <input type="radio" id="medicamentosHabituales-no" name="medicamentosHabituales" value="no" <?php echo ($data['historial_clinico']['medicamentosHabituales'] == 'no') ? 'checked' : ''; ?>>
            <label class="option" for="medicamentosHabituales-no">No</label>
        </div>
        </div>
        
        <label for="observaciones">¿QUÉ MEDICAMENTOS TOMA USTED DE FORMA HABITUAL?</label>
        <input type="text" id="observaciones" value="<?php echo $data['historial_clinico']['observacionesSalud'] ?>"  name="observaciones">
        
        <br>
        <label for="observaciones-g">ALGUNA OBSERVACION AL MOMENTO SOBRE SU SALUD</label>
        <input type="text" id="observaciones-g" value="<?php echo $data['historial_clinico']['observacionesGenerales'] ?>"  name="observaciones-g">


        <button type="submit">Enviar
  </form>

  </main>

<?php include("./src/View/templates/footer_administrador.php")?>