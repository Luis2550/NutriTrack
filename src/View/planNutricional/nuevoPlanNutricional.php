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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=planNutricional&a=guardarPlanNutricional" autocomplete="off">
    <h2>Registro<?php echo $data['titulo'];?></h2>

    <label for="ci_nutriologa">CI Nutriologa:</label>
    <select id="ci_nutriologa" name="ci_nutriologa" required>
         
    <?php
        foreach ($data['opciones_nutriologa'] as $ci) {
            echo "<option value='{$ci}'>{$ci}</option>";
        }
    ?>
    </select>
    
    <label for="ci_paciente">CI Paciente:</label>
    <select id="ci_paciente" name="ci_paciente" required>
         
    <?php
        foreach ($data['opciones_paciente'] as $ci) {
            echo "<option value='{$ci}'>{$ci}</option>";
        }
    ?>
    </select>

    <label for="duracionDias">Duración en Dias:</label>
    <input type="text" id="duracionDias" name="duracionDias" required>

    <label for="fechaFin">Fecha Fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin" required>

    <label for="fechaIni">Fecha Inicio:</label>
    <input type="date" id="fecha_ini" name="fecha_ini" required>

    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

</body>
</html>
