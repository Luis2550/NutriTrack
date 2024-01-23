<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Comida</title>
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

  <form id="modificarComida" name="modificarComida" method="POST" action="index.php?c=Comida&a=actualizarComida" autocomplete="off">
    <h2>Modificar Comida</h2>

    <input type="hidden" id="id_comida" name="id_comida" required value="<?php echo $data["comida"]["id_comida"]; ?>">

    <label for="comida">Comida:</label>
    <input type="text" id="comida" name="comida" pattern="[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+" required value="<?php echo $data["comida"]["comida"]; ?>">

    <label for="id_tipo_comida">Tipo Comida:</label>
    
    <?php
    // Supongamos que $diaDesdeBD contiene el valor almacenado en la base de datos
    $tipoComidaDB = $data["comida"]["id_tipo_comida"];
    ?>
    <select id="id_tipo_comida" name="id_tipo_comida" required>
      <?php foreach ($data_tipos_comida['tipo_comida'] as $tipoComida) { ?>
        <option value="<?php echo $tipoComida['id_tipo_comida'];?>" <?php echo ($tipoComidaDB == $tipoComida['id_tipo_comida']) ? 'selected' : ''; ?>><?php echo $tipoComida['tipo_comida']; ?></option>
      <?php } ?>
    </select>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" maxlength="300" name="descripcion" required value="<?php echo $data["comida"]["descripcion"]; ?>">

    <label for="cantidad_proteina">Cantidad de Proteína:</label>
    <input type="number" id="cantidad_proteina" name="cantidad_proteina" min="10" max="10000" required value="<?php echo $data["comida"]["cantidad_proteina"]; ?>">

    <label for="cantidad_carbohidratos">Cantidad de Carbohidratos:</label>
    <input type="number" id="cantidad_carbohidratos" name="cantidad_carbohidratos" min="10" max="10000" required value="<?php echo $data["comida"]["cantidad_carbohidratos"]; ?>">

    <label for="cantidad_grasas_saludables">Cantidad de Grasas Saludables:</label>
    <input type="number" id="cantidad_grasas_saludables" name="cantidad_grasas_saludables" min="10" max="10000" required value="<?php echo $data["comida"]["cantidad_grasas_saludables"]; ?>">

    <button id="guardarComida" name="guardarComida" type="submit" class="button">Registrar Comida</button>
  </form>

</body>
</html>