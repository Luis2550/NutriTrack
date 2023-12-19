<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Moderno</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    form {
      width: 300px;
      padding: 20px;
      margin-top: 500px; /* Añade un margen superior de 20px */
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-top: 10px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=Configuracion&a=actualizarConfiguraciones" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id_configuracion" name="id_configuracion" value="<?php echo $data["configuraciones"]["id_configuracion"]; ?>" />

    <label for="ci_nutriologa">Cédula Nutrióloga:</label>
    <input type="text" id="ci_nutriologa" name="ci_nutriologa" readonly required value="<?php echo $data["configuraciones"]["ci_nutriologa"]?>">

    <label for="dias_laborales">Días Laborales:</label>
    <input type="number" id="dias_laborales" readonly min="1" max="7" name="dias_laborales" required value="<?php echo $data["configuraciones"]["dias_laborales"]?>">

    <label for="duracion_cita">Duración Cita (minutos):</label>
    <select id="duracion_cita" name="duracion_cita" required>
      <?php
        // Generar opciones para el selector (de 15 a 60 en incrementos de 5)
        for ($i = 15; $i <= 60; $i += 5) {
          $selected = ($i == $data["configuraciones"]["duracion_cita"]) ? "selected" : "";
          echo "<option value=\"$i\" $selected>$i</option>";
        }
      ?>
    </select>

    <label for="dia_inicio">Día Inicio Laboral:</label>
    <select id="dia_inicio" name="dia_inicio" required>
      <?php
        // Días de la semana
        $diasSemana = ['LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO'];

        // Generar opciones para el selector
        foreach ($diasSemana as $dia) {
          $selected = ($dia == $data["configuraciones"]["dia_inicio"]) ? "selected" : "";
          echo "<option value=\"$dia\" $selected>$dia</option>";
        }
      ?>
    </select>

    <label for="dia_fin">Día Fin Laboral:</label>
    <select id="dia_fin" name="dia_fin" required>
      <?php
        // Generar opciones para el selector
        foreach ($diasSemana as $dia) {
          $selected = ($dia == $data["configuraciones"]["dia_fin"]) ? "selected" : "";
          echo "<option value=\"$dia\" $selected>$dia</option>";
        }
      ?>
    </select>
    
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" placeholder="Ingrese una corta descripción" name="descripcion" maxlength="300" value="<?php echo $data["configuraciones"]["descripcion"] ?>">

    <label for="hora_inicio">Hora Laboral Inicio:</label>
    <input type="time" id="hora_inicio" min="07:00" max="19:00" value="<?php echo $data["configuraciones"]["hora_inicio"] ?>" name="hora_inicio">

    <label for="hora_fin">Hora Laboral Fin:</label>
    <input type="time" id="hora_fin" min="07:00" max="19:00" value="<?php echo $data["configuraciones"]["hora_fin"] ?>" name="hora_fin">

    <label for="hora_descanso_inicio">Hora Descanso Inicio:</label>
    <input type="time" id="hora_descanso_inicio" min="07:00" max="19:00" value="<?php echo $data["configuraciones"]["hora_descanso_inicio"] ?>" name="hora_descanso_inicio">

    <label for="hora_descanso_fin">Hora Descanso Fin:</label>
    <input type="time" id="hora_descanso_fin" min="07:00" max="19:00" value="<?php echo $data["configuraciones"]["hora_descanso_fin"] ?>" name="hora_descanso_fin">

    <label for="cantidad_horas_laborales">Cantidad Horas Laborales:</label>
    <input type="text" id="cantidad_horas_laborales" readonly min="1" max="10" value="<?php echo $data["configuraciones"]["cantidad_horas_laborales"] ?>" name="cantidad_horas_laborales">

    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
    </form>

</body>
</html>

