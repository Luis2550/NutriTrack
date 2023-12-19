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

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=guardarCitas" autocomplete="off">
    <h2>Registro de Citas</h2>

    <label for="ci_paciente">Paciente:</label>
    <select id="ci_paciente" name="ci_paciente" required>
        <?php
            foreach ($data['opciones_pacientes'] as $ci) {
                echo "<option value='{$ci}'>{$ci}</option>";
            }
        ?>
    </select>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="hora_inicio">Hora Inicio:</label>
    <input type="time" id="hora_inicio" name="hora_inicio" required>

    <label for="hora_fin">Hora fin:</label>
    <input type="time" id="hora_fin" name="hora_fin" required>

    <label for="ci_nutriologa">Nutriologa:</label>
    <select id="ci_nutriologa" name="ci_nutriologa" required>
        <?php
            foreach ($data2['opciones_nutriologa'] as $ci) {
                echo "<option value='{$ci}'>{$ci}</option>";
            }
        ?>
    </select>

    <?php
        // Verificar si hay un mensaje de error y mostrarlo
        if (isset($error_message)) {
            echo "<p style='color: red;'>{$error_message}</p>";
        }
    ?>

    <button id="guardar" name="guardar" type="submit">Registrar</button>
</form>

</body>
</html>




