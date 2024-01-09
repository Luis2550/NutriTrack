<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Modificación</title>
  <link rel="stylesheet" href="./public/css/nuevoPlanNutricional.css">
  <script src="public/js/nuevoPlanNutricional.js"></script>

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

  <form id="modificar" name="modificar" method="POST" action="index.php?c=planNutricional&a=actualizarPlanNutricional" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["plan_nutricional"][0]['id_plan_nutricional']; ?>" >

    <input type="hidden" id="ci_nutriologa" name="ci_nutriologa" required value="<?php echo $data["plan_nutricional"][0]["ci_nutriologa"]?>">

    <h3>Datos Paciente</h3>
    <label for="ci_pacientes">Cédula:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" required readonly value="<?php echo $data["plan_nutricional"][0]["ci_usuario"]?>">

    <label for="nombres">Nombres:</label>
    <input type="text" readonly id="nombres" name="nombres" value="<?php echo $data["plan_nutricional"][0]["nombres"]?>">

    <label for="apellidos">Apellidos:</label>
    <input type="text" readonly id="apellidos" name="apellidos" value="<?php echo $data["plan_nutricional"][0]["apellidos"]?>">

    <label for="fechaFinSuscripcion">Fecha Fin Suscripción:</label>
    <input type="date" readonly id="fechaFinSuscripcion" timezone="UTC" name="fechaFinSuscripcion" value="<?php echo $data["plan_nutricional"][0]["fin_suscripcion"]?>" onchange="" readonly required>

    <label for="estado">Estado Suscripción:</label>
    <input type="text" readonly id="estado" value="<?php echo $data['plan_nutricional'][0]['estado']; ?>" name="estado" required>

    <label for="fechaIni">Fecha Inicio:</label>
    <input type="date"  id="fecha_ini" timezone="UTC" name="fecha_ini" onchange="calcularFechas()" required value="<?php echo $data["plan_nutricional"][0]["fecha_inicio"]?>">

    <div id="error-message" class="error-message"><?php echo isset($data['error_message']) ? $data['error_message'] : ""; ?></div>

    <label for="fechaFin">Fecha Fin:</label>
    <input type="date" readonly id="fecha_fin" timezone="UTC" name="fecha_fin" value="<?php echo $data["plan_nutricional"][0]["fecha_fin"]?>" required>

    <label for="duracionDias">Duración en Dias:</label>
    <input type="text" readonly id="duracionDias" name="duracionDias" required value="<?php echo $data["plan_nutricional"][0]["duracion_dias"]?>">

  
    <button id="guardar" name="guardar" type="submit" class="button">Guardar</button>
    <button id="cancelar" onclick="confirmarCancelar()" name="cancelar" type="submit" class="cancelar">Cancelar</button>
  </form>

</body>
</html>
