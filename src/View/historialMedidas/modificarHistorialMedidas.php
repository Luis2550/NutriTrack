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

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=historialMedidas&a=actualizarHistorialMedidas" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id_historial_medidas"]; ?>" />

    <label for="id_historial_clinico">Id historia clinico:</label>
    <input type="text" id="id_historial_clinico" name="id_historial_clinico" required value="<?php echo $data["historial_medidas"]["id_historial_clinico"]?>">
    <label for="peso">peso:</label>
    <input type="text" id="peso" name="peso" required value="<?php echo $data["historial_medidas"]["peso"]?>">
    <label for="estatura">Id historia clinico:</label>
    <input type="text" id="estatura" name="estatura" required value="<?php echo $data["historial_medidas"]["estatura"]?>">
    <label for="presion_s">Presion arterial sistolica:</label>
    <input type="text" id="presion_s" name="presion_s" required value="<?php echo $data["historial_medidas"]["presion_arterial_sistolica"]?>">
    <label for="presion_d">Presion arterial distolica:</label>
    <input type="text" id="presion_d" name="presion_d" required value="<?php echo $data["historial_medidas"]["presion_arterial_diastolica"]?>">
    <label for="fecha">Fecha:</label>
    <input type="text" id="fecha" name="fecha" required value="<?php echo $data["historial_medidas"]["fecha"]?>">
    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
</form>

</body>
</html>
