<?php include("./src/View/templates/header.php")?>
  
<main class="container mt-4">
    <div class="row justify-content-center">
        <!-- Formulario de inicio de sesión dentro de una carta -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Iniciar Sesión</h2>
                    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion" method="post">
                        <div class="form-group">
                            <label for="username">Correo:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su correo" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                        </div>
                        <div class="form-group">
                            <div id="error-message"><?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

  <?php include("./src/View/templates/footer.php")?>
