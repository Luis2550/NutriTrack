<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Horario Laboral</title>
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

  <form id="modificarHorarioLaboral" name="modificarHorarioLaboral" method="POST" action="index.php?c=HorarioLaboral&a=actualizarHorarioLaboral" autocomplete="off">
    <h2>Modificar Horario Laboral</h2>

    <input type="hidden" id="id_horario_laboral" name="id_horario_laboral" readonly value="<?php echo $data["horarioLaboral"]["id_horario_laboral"]; ?>">

    <label for="id_configuracion">ID Configuración:</label>
    <input type="number" id="id_configuracion" name="id_configuracion" readonly value="<?php echo $data["horarioLaboral"]["id_configuracion"]; ?>">    

    <label for="dia_inicio">Día Inicio:</label>
    <?php
    // Supongamos que $diaDesdeBD contiene el valor almacenado en la base de datos
    $diaDesdeBD = $data["horarioLaboral"]["dia_inicio"];
    ?>
    <select id="dia_inicio" name="dia_inicio" required>
        <option value="LUNES" <?php echo ($diaDesdeBD == 'LUNES') ? 'selected' : ''; ?>>LUNES</option>
        <option value="MARTES" <?php echo ($diaDesdeBD == 'MARTES') ? 'selected' : ''; ?>>MARTES</option>
        <option value="MIÉRCOLES" <?php echo ($diaDesdeBD == 'MIÉRCOLES') ? 'selected' : ''; ?>>MIÉRCOLES</option>
        <option value="JUEVES" <?php echo ($diaDesdeBD == 'JUEVES') ? 'selected' : ''; ?>>JUEVES</option>
        <option value="VIERNES" <?php echo ($diaDesdeBD == 'VIERNES') ? 'selected' : ''; ?>>VIERNES</option>
        <option value="SÁBADO" <?php echo ($diaDesdeBD == 'SÁBADO') ? 'selected' : ''; ?>>SÁBADO</option>
        <option value="DOMINGO" <?php echo ($diaDesdeBD == 'DOMINGO') ? 'selected' : ''; ?>>DOMINGO</option>
    </select>

    <label for="dia_fin">Día Fin:</label>
    <?php
    // Supongamos que $diaDesdeBD contiene el valor almacenado en la base de datos
    $diafDesdeBD = $data["horarioLaboral"]["dia_fin"];
    ?>
    <select id="dia_fin" name="dia_fin" required>
        <option value="LUNES" <?php echo ($diafDesdeBD == 'LUNES') ? 'selected' : ''; ?>>LUNES</option>
        <option value="MARTES" <?php echo ($diafDesdeBD == 'MARTES') ? 'selected' : ''; ?>>MARTES</option>
        <option value="MIÉRCOLES" <?php echo ($diafDesdeBD == 'MIÉRCOLES') ? 'selected' : ''; ?>>MIÉRCOLES</option>
        <option value="JUEVES" <?php echo ($diafDesdeBD == 'JUEVES') ? 'selected' : ''; ?>>JUEVES</option>
        <option value="VIERNES" <?php echo ($diafDesdeBD == 'VIERNES') ? 'selected' : ''; ?>>VIERNES</option>
        <option value="SÁBADO" <?php echo ($diafDesdeBD == 'SÁBADO') ? 'selected' : ''; ?>>SÁBADO</option>
        <option value="DOMINGO" <?php echo ($diafDesdeBD == 'DOMINGO') ? 'selected' : ''; ?>>DOMINGO</option>
    </select>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required value="<?php echo $data["horarioLaboral"]["descripcion"]; ?>">

    <label for="hora_inicio">Hora Inicio:</label>
    <input type="number" id="hora_inicio" name="hora_inicio" min="8" max="19" required value="<?php echo $data["horarioLaboral"]["hora_inicio"]; ?>">

    <label for="hora_fin">Hora Fin:</label>
    <input type="number" id="hora_fin" name="hora_fin" min="8" max="19" required value="<?php echo $data["horarioLaboral"]["hora_fin"]; ?>">

    <label for="cantidad_horas_laborales">Cantidad de Horas Laborales:</label>
    <input type="number" id="cantidad_horas_laborales" name="cantidad_horas_laborales" min="5" max="40" required value="<?php echo $data["horarioLaboral"]["cantidad_horas_laborales"]; ?>">

    <button id="actualizarHorarioLaboral" name="actualizarHorarioLaboral" type="submit" class="button">Actualizar Horario Laboral</button>
  </form>

</body>
</html>