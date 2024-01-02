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
        
      <input type="text" id = "id_historial_clinico" name="id_historial_clinico" value= "<?php echo $data['historial_clinico']['id_historial_clinico']?>">
    
        <label for="fechaNacimiento">FECHA NACIMIENTO*</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required max="">

        <label for="peso">PESO (KG)*</label>
        <input type="number" id="peso" name="peso" required>

        <label for="porcentajeGrasa">% DE GRASA (opcional)</label>
        <input type="number" id="porcentajeGrasa" name="porcentajeGrasa">

        <label for="talla">TALLA (CM)*</label>
        <input type="number" id="talla" name="talla" required>


        <label for="ocupacion">OCUPACIÓN</label>
        <input type="text" id="ocupacion" name="ocupacion">

        <label for="celular">NUMERO DE CELULAR*</label>
        <input type="tel" id="celular" name="celular" pattern="\d{10}" required>

        <label for="direccion">Dirección*</label>
        <input type="text" id="direccion" name="direccion" required>

        <label for="enfermedades">ANTECEDENTES MEDICOS PERSONALES: (marque únicamente la opción que aplique)</label>
        <table id="enfermedadesTable">
            <thead>
                <tr>
                    <th></th>
                    <th>SI</th>
                    <th>NO</th>
                    <th>No sabe</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <tr>
                    <td>Enfermedades Neurológicos: Dolores de cabeza, convulsiones, mareos, parálisis</td>
                    <td><input type="radio" name="neuro" value="si"></td>
                    <td><input type="radio" name="neuro" value="no"></td>
                    <td><input type="radio" name="neuro" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Enfermedades Hemoglobina: Anemia, desórdenes sanguíneos o problemas de coagulación</td>
                    <td><input type="radio" name="hemoglobina" value="si"></td>
                    <td><input type="radio" name="hemoglobina" value="no"></td>
                    <td><input type="radio" name="hemoglobina" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Enfermedades Gastrointestinales: Problemas digestivos, enfermedad inflamatoria intestinal, úlceras, etc.</td>
                    <td><input type="radio" name="gastro" value="si"></td>
                    <td><input type="radio" name="gastro" value="no"></td>
                    <td><input type="radio" name="gastro" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Enfermedades Respiratorias: Asma, amigdalitis, enfisema, afección laríngea o en bronquios</td>
                    <td><input type="radio" name="respiratorias" value="si"></td>
                    <td><input type="radio" name="respiratorias" value="no"></td>
                    <td><input type="radio" name="respiratorias" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Enfermedades Crónicas: Diabetes, hipertensión, enfermedades cardíacas, enfermedades respiratorias crónicas, artritis, etc.</td>
                    <td><input type="radio" name="cronicas" value="si"></td>
                    <td><input type="radio" name="cronicas" value="no"></td>
                    <td><input type="radio" name="cronicas" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Problemas Endocrinos: Problemas de la tiroides u otras glándulas endocrinas.</td>
                    <td><input type="radio" name="endocrinos" value="si"></td>
                    <td><input type="radio" name="endocrinos" value="no"></td>
                    <td><input type="radio" name="endocrinos" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Cirugías Previas: Cirugías, traumas (accidentes)</td>
                    <td><input type="radio" name="cirugias" value="si"></td>
                    <td><input type="radio" name="cirugias" value="no"></td>
                    <td><input type="radio" name="cirugias" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Alergias e Intolerancias: Alergias alimentarias, alergias a medicamentos, intolerancias, etc.</td>
                    <td><input type="radio" name="alergias" value="si"></td>
                    <td><input type="radio" name="alergias" value="no"></td>
                    <td><input type="radio" name="alergias" value="noSabe"></td>
                </tr>
                <tr>
                    <td>Hipertensión, infartos, anginas, soplos, arritmias, enfermedad coronaria</td>
                    <td><input type="radio" name="hipertension" value="si"></td>
                    <td><input type="radio" name="hipertension" value="no"></td>
                    <td><input type="radio" name="hipertension" value="noSabe"></td>
                </tr>
            </tbody>
        </table>
        

                <label for="motivoConsulta">¿Cuál es el principal motivo de su consulta Nutricional? *</label>
        <select id="motivoConsulta" name="motivoConsulta" required>
            <option value="Problemas Digestivos">Problemas Digestivos</option>
            <option value="Chequeo o Consulta de Rutina">Chequeo o Consulta de Rutina</option>
            <option value="Evaluación Completa">Evaluación Completa</option>
            <option value="Mejora del Rendimiento Deportivo">Mejora del Rendimiento Deportivo</option>
            <option value="Manejo de Enfermedades Crónicas">Manejo de Enfermedades Crónicas</option>
            <option value="Mejora de Hábitos Alimenticios">Mejora de Hábitos Alimenticios</option>
            <option value="Alergias o Intolerancias Alimentarias">Alergias o Intolerancias Alimentarias</option>
            <option value="Embarazo y Lactancia">Embarazo y Lactancia</option>
            <option value="Prevención de Enfermedades">Prevención de Enfermedades</option>
            <option value="Bienestar General">Bienestar General</option>
            <option value="Other">Other</option>
        </select>

        <div class="question-container">
            <label for="discapacidad">¿TIENE USTED ALGÚNA DISCAPACIDAD?*</label>
            <div class="check-container">
                <input type="radio" id="discapacidad-si" name="discapacidad" value="si">
                <label class="option" for="discapacidad-si">Sí</label>
    
                <input type="radio" id="discapacidad-no" name="discapacidad" value="no">
                <label class="option" for="discapacidad-no">No</label>
            </div>
        </div>

        <label for="tipoDiscapacidad">DISCAPACIDAD</label>
        <input type="text" id="tipoDiscapacidad" name="tipoDiscapacidad">

        <label for="entrenamiento">¿Actualmente usted entrena(Gimnasio) o realiza algún tipo de actividad física?*</label>
        <select id="entrenamiento" name="entrenamiento" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>

        <label for="tiempoEntrenamiento">¿Cuánto tiempo entrena o realiza actividades físicas diariamente?</label>
        <div class="radio-container">
            <input type="radio" id="check10-15" name="tiempoEntrenamiento" value="10-15">
            <label for="check10-15">10 - 15 minutos</label>
        
            <input type="radio" id="check20-25" name="tiempoEntrenamiento" value="20-25">
            <label for="check20-25">20 - 25 minutos</label>
        
            <input type="radio" id="check30-40" name="tiempoEntrenamiento" value="30-40">
            <label for="check30-40">30 - 40 minutos</label>
        
            <input type="radio" id="check40-50" name="tiempoEntrenamiento" value="40-50">
            <label for="check40-50">40 - 50 minutos</label>
        
            <input type="radio" id="check1hora" name="tiempoEntrenamiento" value="1hora">
            <label for="check1hora">1 hora o más de una hora</label>
        
            <input type="radio" id="check2horas" name="tiempoEntrenamiento" value="2horas">
            <label for="check2horas">2 horas o más de dos horas</label>
        
            <input type="radio" id="check3horas" name="tiempoEntrenamiento" value="3horas">
            <label for="check3horas">3 horas o más de tres horas</label>
        </div>
        
        
        <div class="question-container">
            <label for="alcohol">ALCOHOL: ¿Toma usted alcohol?*</label>
            <div class="check-container">
                <input type="radio" id="alcohol-si" name="alcohol" value="si">
                <label class="option" for="alcohol-si">Sí</label>
    
                <input type="radio" id="alcohol-no" name="alcohol" value="no">
                <label class="option" for="alcohol-no">No</label>
            </div>
        </div>
    
        <div class="question-container">
            <label for="cafe">CAFE: ¿Toma usted café?*</label>
            <div class="check-container">
                <input type="radio" id="cafe-si" name="cafe" value="si">
                <label class="option" for="cafe-si">Sí</label>
    
                <input type="radio" id="cafe-no" name="cafe" value="no">
                <label class="option" for="cafe-no">No</label>
            </div>
        </div>
    
        <div class="question-container">
            <label for="medicamentosHabituales">¿Toma usted algún medicamento de forma habitual?*</label>
            <div class="check-container">
                <input type="radio" id="medicamentosHabituales-si" name="medicamentosHabituales" value="si">
                <label class="option" for="medicamentosHabituales-si">Sí</label>
        
                <input type="radio" id="medicamentosHabituales-no" name="medicamentosHabituales" value="no">
                <label class="option" for="medicamentosHabituales-no">No</label>
            </div>
        </div>
        
        <label for="observaciones">¿QUÉ MEDICAMENTOS TOMA USTED DE FORMA HABITUAL?</label>
        <textarea id="observaciones" name="observaciones" rows="4"></textarea>
        
        
        
        
        <label for="observaciones-g">ALGUNA OBSERVACION AL MOMENTO SOBRE SU SALUD</label>
        <textarea id="observaciones-g" name="observaciones-g" rows="4"></textarea>

        <button type="submit">Enviar
  </form>

  </main>

<?php include("./src/View/templates/footer_administrador.php")?>