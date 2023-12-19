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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off">
    <h2>Registro<?php echo $data['titulo'];?></h2>

    <label for="cedula">Cédula:</label>
    <input type="text" id="cedula" name="cedula" maxlength="10" required>
    <div id="error-message" style="color: red;"><?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?></div>

    <label for="id_rol">Rol:</label>
    <select id="id_rol" name="id_rol" required>
      <?php foreach ($data['roles'] as $rol): ?>
        <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
      <?php endforeach; ?>
    </select>

    <label for="nombre">Nombres:</label>
    <input type="text" id="nombres" name="nombres" required>

    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>

    <label for="edad">Edad:</label>
    <!-- Cambiar input de texto a un selector de edades -->
    <select id="edad" name="edad" required>
      <?php
        for ($i = 5; $i <= 100; $i++) {
          echo "<option value=\"$i\">$i</option>";
        }
      ?>
    </select>

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="clave">Contraseña:</label>
    <input type="password" id="clave" name="clave" required>

    <label for="sexo">Sexo:</label>
    <!-- Cambiar input de texto a un campo de selección de género -->
    <select id="sexo" name="sexo" required>
      <option value="MASCULINO">Masculino</option>
      <option value="FEMENINO">Femenino</option>
    </select>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" class="foto" name="foto" accept=".jpg, .jpeg, .png"  required>
    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

</body>
</html>

