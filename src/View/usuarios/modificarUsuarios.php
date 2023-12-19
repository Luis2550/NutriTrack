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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=actualizarUsuarios" autocomplete="off">
    <h2>Editar <?php echo $data['titulo'];?></h2>

    <label for="nombre">Cédula:</label>
    <input type="text" id="id" name="id" readonly value="<?php echo $data["ci_usuario"]; ?>" />

    <label for="rol">Rol:</label>
    <input type="text" id="rol" name="rol" readonly value="<?php echo $data["usuarios"]["rol"]; ?>" />

    <label for="nombre">Nombres:</label>
    <input type="text" id="nombres" name="nombres" required value="<?php echo $data["usuarios"]["nombres"]?>">

    <label for="apellido">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required value="<?php echo $data["usuarios"]["apellidos"]?>">

    <label for="usuario">Edad:</label>
    <select id="edad" name="edad" required>
      <?php
      $edadActual = $data["usuarios"]["edad"];
      ?>
      <?php for ($i = 5; $i <= 100; $i++) : ?>
          <option value="<?php echo $i; ?>" <?php if ($i == $edadActual) echo "selected"; ?>><?php echo $i; ?></option>
      <?php endfor; ?>
    </select>

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required value="<?php echo $data["usuarios"]["correo"]?>">

    <label for="clave">Contraseña:</label>
    <input type="password" id="clave" name="clave" required value="<?php echo $data["usuarios"]["clave"]?>">

    <label for="sexo">Sexo:</label>
    <!-- Cambiar input de texto a un campo de selección de género -->
    <select id="sexo" name="sexo" required>
      <?php
      $sexoActual = $data["usuarios"]["sexo"];
      ?>
      <option value="MASCULINO" <?php if ($sexoActual === "MASCULINO") echo "selected"; ?>>Masculino</option>
      <option value="FEMENINO" <?php if ($sexoActual === "FEMENINO") echo "selected"; ?>>Femenino</option>
    </select>

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required value="<?php echo $data["usuarios"]["foto"]?>">
    
    <button id="guardar" name="guardar" type="submit" class="button">Actualizar</button>
  </form>

</body>
</html>

