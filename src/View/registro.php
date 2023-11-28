<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Moderno</title>
  <link rel="stylesheet" href="../../public/css/registro.css">
</head>
<body>

  <form>
    <h2>Registro</h2>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required>

    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <input type="submit" value="Registrar">
  </form>

</body>
</html>
