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
    <input type="text" id="comida" name="comida" pattern="[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+" required>

    <label for="numero_comidas">Número de Comidas:</label>
    <input type="number" id="numero_comidas" name="numero_comidas" min="3" max="10" required>

    <label for="dia">Día:</label>
    <select id="dia" name="dia" required>
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

    <label for="cantidad_proteina">Cantidad de Proteína:</label>
    <input type="number" id="cantidad_proteina" name="cantidad_proteina" min="10" max="10000" required>

    <label for="cantidad_carbohidratos">Cantidad de Carbohidratos:</label>
    <input type="number" id="cantidad_carbohidratos" name="cantidad_carbohidratos" min="10" max="10000" required>

    <label for="cantidad_grasas_saludables">Cantidad de Grasas Saludables:</label>
    <input type="number" id="cantidad_grasas_saludables" name="cantidad_grasas_saludables" min="10" max="10000" required>

    <button id="guardarComida" name="guardarComida" type="submit" class="button">Registrar Comida</button>
  </form>

</body>
</html>
