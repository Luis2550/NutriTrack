<?php include("./src/View/templates/header.php")?>
  
<div class="main">
  
    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion" method="post" class="login-form">
      <h2>Login</h2>
      <label for="username">Correo:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>
      
      <button type="submit">Entrar</button>
    </form>
  </div>

  <?php include("./src/View/templates/footer.php")?>
