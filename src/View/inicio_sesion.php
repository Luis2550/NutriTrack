<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login</title>
  <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
  <div class="login-container">
  
    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion" method="post" class="login-form">
      <h2>Login</h2>
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
      
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
