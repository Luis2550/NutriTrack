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

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=actualizarUsuarios" autocomplete="off">
    <h2>Editar<?php echo $data['titulo'];?></h2>

    <input type="hidden" id="id" name="id" value="<?php echo $data["id"]; ?>" />

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombres" name="nombres" required value="<?php echo $data["usuarios"]["nombres"]?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellidos" name="apellidos" required value="<?php echo $data["usuarios"]["apellidos"]?>">

    <label for="usuario">Edad:</label>
    <input type="text" id="edad" name="edad" required value="<?php echo $data["usuarios"]["edad"]?>">

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required value="<?php echo $data["usuarios"]["correo"]?>">

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasenia" name="contrasenia" required value="<?php echo $data["usuarios"]["contrasenia"]?>">
    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

</body>
</html>

