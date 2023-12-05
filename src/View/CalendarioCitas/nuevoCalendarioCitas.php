<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Calendario de Citas</title>
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

  <form id="nuevoCalendarioCitas" name="nuevoCalendarioCitas" method="POST" action="index.php?c=CalendarioCitas&a=guardarCalendarioCitas" autocomplete="off">
    <h2>Nuevo Calendario Citas</h2>

    <label for="ci_paciente">Cédula del Paciente:</label>
    <select id="ci_paciente" name="ci_paciente" required>
    <?php
        // Itera sobre las configuraciones y crea las opciones del select
        foreach($data['calendarioCitasPaciente'] as $dato){
            $id_configuracion = $dato['ci_paciente'];
            $nombres = $dato['nombres'];
            $apellidos = $dato['apellidos'];
            $nombreCompleto = $nombres . ' ' . $apellidos;
            echo "<option value=\"$id_configuracion\">$nombreCompleto</option>";
        }
      ?>
    </select>

    <label for="ci_nutriologa">Cédula de la Nutrióloga:</label>
    <select id="ci_nutriologa" name="ci_nutriologa" required>
    <?php
        // Itera sobre las configuraciones y crea las opciones del select
        foreach($data['calendarioCitasNutriologa'] as $dato){
            $id_configuracion = $dato['ci_nutriologa'];
            $nombres = $dato['nombres'];
            $apellidos = $dato['apellidos'];
            $nombreCompleto = $nombres . ' ' . $apellidos;
            echo "<option value=\"$id_configuracion\">$nombreCompleto</option>";
        }
      ?>
    </select>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="hora_inicio">Hora Inicio:</label>
    <input type="number" id="hora_inicio" name="hora_inicio" min="8" max="19"required>

    <label for="hora_fin">Hora Fin:</label>
    <input type="number" id="hora_fin" name="hora_fin" min="8" max="19"required>
    
    <button id="guardarCalendarioCita" name="guardarCalendarioCita" type="submit" class="button">Registrar Calendario Cita</button>
  </form>

</body>
</html>
