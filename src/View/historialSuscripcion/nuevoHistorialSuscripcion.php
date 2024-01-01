
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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=HistorialSuscripcion&a=guardarHistorialSuscripcion" autocomplete="off">
    <h2>Registro <?php echo $data['titulo']; ?></h2>
    
    <label for="ci_usuario">Cédula del Usuario:</label>
    <input type="text" id="ci_usuario" name="ci_usuario" value="<?php echo htmlspecialchars($_GET['ci_usuario'] ?? ''); ?>" readonly>



    <label for="id_suscripcion">ID Suscripcion:</label>
    <select id="id_suscripcion" name="id_suscripcion" required>
      <?php foreach ($data['opciones_suscripcion'] as $suscripcion) : ?>
        <option value="<?php echo $suscripcion['id_suscripcion']; ?>"><?php echo $suscripcion['suscripcion']; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="dias_laborales">Fecha Inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" required>

    <!--<label for="duracion_cita">Fecha Fin:</label>
    <input type="date" id="fecha_fin" name="fecha_fin" required>-->
    <label for="duracion_cita">Fecha Fin:</label>
    <input type="hidden" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($data['fecha_fin'] ?? ''); ?>" required>
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

</body>

</html>
