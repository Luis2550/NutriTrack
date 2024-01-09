
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="public/js/nuevoPlanNutricional.js"></script>
  <link rel="stylesheet" href="./public/css/nuevoPlanNutricional.css">

  <title>Formulario Moderno</title>
  <!-- Incluir el archivo de script.js -->
  
  <style>
    

  </style>
</head>


<body>

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=planNutricional&a=guardarPlanNutricional" autocomplete="off">
    <h2>Registro<?php echo $data['titulo'];?></h2>
    
    <!-- <h3>Datos Nutriolog@</h3>

    <label for="ci_nutriologa">Cédula:</label>!-->
    <select hidden id="ci_nutriologa" onchange="cambiarCINutriologa()" name="ci_nutriologa" required>
         
    <?php
        foreach ($data['opciones_nutriologa'] as $ci) {
            echo "<option value='{$ci}'>{$ci}</option>";
        }
    ?>
    </select>

    <h3>Datos Paciente</h3>

    <label for="ci_paciente">Cédula:</label>
    <select id="ci_paciente" name="ci_paciente" required onchange="actualizarDatos()">
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

    <label for="nombres">Nombres:</label>
    <input type="text" readonly id="nombres" name="nombres" value="<?php echo $data['opciones_paciente'][0]['nombres']; ?>">

    <label for="apellidos">Apellidos:</label>
    <input type="text" readonly id="apellidos" name="apellidos" value="<?php echo $data['opciones_paciente'][0]['apellidos']; ?>">

    <label for="fechaFinSuscripcion">Fecha Fin Suscripción:</label>
    <input type="date" id="fechaFinSuscripcion" timezone="UTC" name="fechaFinSuscripcion" value="<?php echo $data['opciones_paciente'][0]['fecha_fin']; ?>" onchange="" readonly required>

    <label for="estado">Estado Suscripción:</label>
    <input type="text" readonly id="estado" value="<?php echo $data['opciones_paciente'][0]['estado']; ?>" name="estado" required>

    <label for="fechaIni">Fecha Inicio:</label>
    <input type="date" id="fecha_ini" timezone="UTC" name="fecha_ini" onchange="calcularFechas()" required>

    <div id="error-message" class="error-message"><?php echo isset($data['error_message']) ? $data['error_message'] : ""; ?></div>

    <label for="fechaFin">Fecha Fin:</label>
    <input type="date" readonly id="fecha_fin" timezone="UTC" name="fecha_fin" required>

    <label for="duracionDias">Duración en Dias:</label>
    <input type="text" readonly id="duracionDias" name="duracionDias" required>

    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
    <button id="cancelar" onclick="confirmarCancelar()" name="cancelar" type="submit" class="cancelar">Cancelar</button>
  </form>

</body>
</html>
