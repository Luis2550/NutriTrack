<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva Comida</title>
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


  <form id="nuevaComida" name="nuevaComida" method="POST" action="index.php?c=Comida&a=guardarComida" autocomplete="off">
    <h2>Nueva Comida</h2>

    <label for="comida">Comida:</label>
    <input type="text" id="comida" name="comida" maxlength="30" pattern="[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+" required>

    <label for="id_tipo_comida">Tipo Comida:</label>
    <select id="id_tipo_comida" name="id_tipo_comida" required>
      <?php foreach ($data_comida['data_tipo_comida'] as $tipoComida) { ?>
        <option value="<?php echo $tipoComida['id_tipo_comida']; ?>"><?php echo $tipoComida['tipo_comida']; ?></option>
      <?php } ?>
    </select>

    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" maxlength="300" name="descripcion" required>

    <label for="cantidad_proteina">Cantidad de Proteína:</label>
    <input type="number" id="cantidad_proteina" value="1" name="cantidad_proteina" min="1" max="10000" required>

    <label for="cantidad_carbohidratos">Cantidad de Carbohidratos:</label>
    <input type="number" id="cantidad_carbohidratos" value="1" name="cantidad_carbohidratos" min="1" max="10000" required>

    <label for="cantidad_grasas_saludables">Cantidad de Grasas Saludables:</label>
    <input type="number" id="cantidad_grasas_saludables" value="1" name="cantidad_grasas_saludables" min="1" max="10000" required>

    <button id="guardarComida" name="guardarComida" type="submit" class="button">Registrar Comida</button>
  </form>

</body>
</html>
