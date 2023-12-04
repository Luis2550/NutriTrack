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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=planNutricional&a=actualizarPlanNutricional" autocomplete="off">
    <h2>Editar<?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id_plan_nutricional"]; ?>" />

    <label for="ci_nutriologas">Ci Nutriologa:</label>
    <input type="text" id="ci_nutriologa" name="ci_nutriologa" required value="<?php echo $data["plan_nutricional"]["ci_nutriologa"]?>">

    <label for="ci_pacientes">Ci Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" required value="<?php echo $data["plan_nutricional"]["ci_paciente"]?>">

    <label for="fecha_ini">fecha inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" required value="<?php echo $data["plan_nutricional"]["fecha_inicio"]?>">

    <label for="fecha_fins">fecha fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin" required value="<?php echo $data["plan_nutricional"]["fecha_fin"]?>">
   
    <label for="duracionDiass">Duración dias:</label>
    <input type="text" id="duracionDias" name="duracionDias" required value="<?php echo $data["plan_nutricional"]["duracion_dias"]?>">
    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

</body>
</html>