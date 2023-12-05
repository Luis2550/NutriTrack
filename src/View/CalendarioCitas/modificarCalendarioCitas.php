<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Cita</title>
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

  <form id="modificarCalendarioCitas" name="modificarCalendarioCitas" method="POST" action="index.php?c=CalendarioCitas&a=actualizarCalendarioCitas" autocomplete="off">
    <h2>Modificar Calendario Cita</h2>

    <input type="hidden" id="id_calendario_citas" name="id_calendario_citas" readonly value="<?php echo $data["calendarioCitas"]["id_calendario_citas"]; ?>" />

    <label for="ci_paciente">Cédula del Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" required readonly value="<?php echo $data["calendarioCitas"]["ci_paciente"]; ?>">

    <label for="ci_nutriologa">Cédula de la Nutrióloga:</label>
    <input type="text" id="ci_nutriologa" name="ci_nutriologa" required readonly value="<?php echo $data["calendarioCitas"]["ci_nutriologa"]; ?>">

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required value="<?php echo $data["calendarioCitas"]["fecha"]; ?>">

    <label for="hora_inicio">Hora de Inicio:</label>
    <input type="text" id="hora_inicio" name="hora_inicio" required value="<?php echo $data["calendarioCitas"]["hora_inicio"]; ?>">

    <label for="hora_fin">Hora de Fin:</label>
    <input type="text" id="hora_fin" name="hora_fin" required value="<?php echo $data["calendarioCitas"]["hora_fin"]; ?>">

    <label for="estado">Estado:</label>
    <?php
      // Supongamos que $estadoDesdeBD contiene el valor almacenado en la base de datos
      $estadoDesdeBD = $data["calendarioCitas"]["estado"];
    ?>

<select id="estado" name="estado" required>
    <option value="DISPONIBLE" <?php echo ($estadoDesdeBD == 'DISPONIBLE') ? 'selected' : ''; ?>>Disponible</option>
    <option value="NO DISPONIBLE" <?php echo ($estadoDesdeBD == 'NO DISPONIBLE') ? 'selected' : ''; ?>>No Disponible</option>
</select>
    
    <button id="actualizarCalendarioCitas" name="actualizarCalendarioCitas" type="submit" class="button">Actualizar Calendario Citas</button>
  </form>

</body>
</html>
