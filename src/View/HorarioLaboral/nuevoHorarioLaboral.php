<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Horario Laboral</title>
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

  <form id="nuevoHorarioLaboral" name="nuevoHorarioLaboral" method="POST" action="index.php?c=HorarioLaboral&a=guardarHorarioLaboral" autocomplete="off">
    <h2>Nuevo Horario Laboral</h2>

    <label for="id_configuracion">ID Configuración:</label>
    <select id="id_configuracion" name="id_configuracion" required>
      <?php
        // Itera sobre las configuraciones y crea las opciones del select
        foreach($data['horarioLaboral'] as $dato){
            $id_configuracion = $dato['id_configuracion'];
            echo "<option value=\"$id_configuracion\">$id_configuracion</option>";
        }
      ?>
    </select>

    <label for="dia_inicio">Día Inicio:</label>
    <select id="dia_inicio" name="dia_inicio" required>
      <option value="LUNES">LUNES</option>
      <option value="MARTES">MARTES</option>
      <option value="MIÉRCOLES">MIÉRCOLES</option>
      <option value="JUEVES">JUEVES</option>
      <option value="VIERNES">VIERNES</option>
      <option value="SÁBADO">SÁBADO</option>
      <option value="DOMINGO">DOMINGO</option>
    </select>

    <label for="dia_fin">Día Fin:</label>
    <select id="dia_fin" name="dia_fin" required>
      <option value="LUNES">LUNES</option>
      <option value="MARTES">MARTES</option>
      <option value="MIÉRCOLES">MIÉRCOLES</option>
      <option value="JUEVES">JUEVES</option>
      <option value="VIERNES">VIERNES</option>
      <option value="SÁBADO">SÁBADO</option>
      <option value="DOMINGO">DOMINGO</option>
    </select>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required>

    <label for="hora_inicio">Hora Inicio:</label>
    <input type="number" id="hora_inicio" name="hora_inicio" min="8" max="19" required>

    <label for="hora_fin">Hora Fin:</label>
    <input type="number" id="hora_fin" name="hora_fin" min="8" max="19" required>

    <label for="cantidad_horas_laborales">Cantidad de Horas Laborales:</label>
    <input type="number" id="cantidad_horas_laborales" name="cantidad_horas_laborales" min="5" max="40" required>

    <button id="guardarHorarioLaboral" name="guardarHorarioLaboral" type="submit" class="button">Registrar Horario Laboral</button>
  </form>

</body>
</html>
