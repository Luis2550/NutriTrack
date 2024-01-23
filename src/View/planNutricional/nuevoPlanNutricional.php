<?php include("./src/View/templates/header_administrador.php")?>

<main class="container mt-5 d-flex justify-content-center">

  <!--<link rel="stylesheet" href="./public/css/nuevoPlanNutricional.css">-->
  <script src="public/js/nuevoPlanNutricional.js"></script>
  <script src="/.public/js/formulariosR.js"></script>


  <form class="formulario bg-light p-4 rounded" id="nuevo" name="nuevo" method="POST" action="index.php?c=planNutricional&a=guardarPlanNutricional" autocomplete="off">
    <h2 class="titulo text-center">Registro<?php echo $data['titulo'];?></h2>
    
    <!-- <h3>Datos Nutriolog@</h3>

    <label for="ci_nutriologa">Cédula:</label>!-->
    <select hidden id="ci_nutriologa" onchange="cambiarCINutriologa()" name="ci_nutriologa" required>
         
    <?php
        foreach ($data['opciones_nutriologa'] as $ci) {
            echo "<option value='{$ci}'>{$ci}</option>";
        }
    ?>
    </select>

    <h3 class="titulo text-left">Datos Paciente</h3>

    <div class="form-group">
      <label for="ci_paciente">Cédula:</label>
      <select id="ci_paciente" class="form-control" name="ci_paciente" required onchange="actualizarDatos()">
        <?php
          foreach ($data['opciones_paciente'] as $ci) {
            $nombre_completo = $ci['nombres'] . ' ' . $ci['apellidos'];
            $ci_nombre_completo = $ci['ci_paciente'] . ' - ' . $nombre_completo;
            $fecha_fin_suscripcion = $ci['fecha_fin'];
            $estado = $ci['estado'];
            
            echo "<option value='{$ci['ci_paciente']}' data-nombres='{$ci['nombres']}' data-apellidos='{$ci['apellidos']}' data-fechaFinSuscripcion='{$ci['fecha_fin']}' data-estado='{$ci['estado']}'>{$ci_nombre_completo}</option>";
          }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="nombres">Nombres:</label>
      <input type="text" class="form-control" readonly id="nombres" name="nombres" value="<?php echo $data['opciones_paciente'][0]['nombres']; ?>">
    </div>
    
    <div class="form-group">
      <label for="apellidos">Apellidos:</label>
      <input type="text" class="form-control" readonly id="apellidos" name="apellidos" value="<?php echo $data['opciones_paciente'][0]['apellidos']; ?>">
    </div>

    <div class="form-group">
      <label for="fechaFinSuscripcion">Fecha Fin Suscripción:</label>
      <input class="form-control" type="date" id="fechaFinSuscripcion" timezone="UTC" name="fechaFinSuscripcion" value="<?php echo $data['opciones_paciente'][0]['fecha_fin']; ?>" onchange="" readonly required>
    </div>

    <div class="form-group">
      <label for="estado">Estado Suscripción:</label>
      <input class="form-control" type="text" readonly id="estado" value="<?php echo $data['opciones_paciente'][0]['estado']; ?>" name="estado" required>
    </div>

    <h3 class="titulo text-left">Datos Paciente</h3>

    <div class="form-group">
      <label for="fechaIni">Fecha Inicio:</label>
      <input  class="form-control"  type="date" id="fecha_ini" timezone="UTC" name="fecha_ini" onchange="calcularFechas()" required>
    </div>
    
    <div id="error-message" class="error-message"><?php echo isset($data['error_message']) ? $data['error_message'] : ""; ?></div>

    <div class="form-group">
      <label for="fechaFin">Fecha Fin:</label>
      <input  class="form-control"  type="date" readonly id="fecha_fin" timezone="UTC" name="fecha_fin" required>
    </div>

    <div class="form-group">
      <label for="duracionDias">Duración en Dias:</label>
      <input class="form-control" type="text" readonly id="duracionDias" name="duracionDias" required>
    </div>

    <button class="btn btn-primary btn-block" id="guardar" name="guardar" type="submit" class="button">Registrar</button>
    <br>
    <button class="btn btn-secondary btn-block" id="cancelar" onclick="confirmarCancelar()" name="cancelar" type="submit" class="cancelar">Cancelar</button>
  </form>

</main>

<?php include("./src/View/templates/footer_administrador.php")?>