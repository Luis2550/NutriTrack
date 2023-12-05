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

<form id="nuevo" name="nuevo" method="POST" action="index.php?c=historialClinico&a=actualizarHistorialClinico" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id_historial_clinico"]; ?>" />

    <label for="ci_pacientes">Ci Paciente:</label>
    <input type="text" id="ci_paciente" name="ci_paciente" required value="<?php echo $data["historial_clinico"]["ci_paciente"]?>">

    <label for="fecha_creacion">Fecha Creacion:</label>
    <input type="date" id="fecha_creacion" name="fecha_creacion" required value="<?php echo $data["historial_clinico"]["fecha_creacion"]?>">

    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
</form>

</body>
</html>
