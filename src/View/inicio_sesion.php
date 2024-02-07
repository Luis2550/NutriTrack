<?php include("./src/View/templates/header.php")?>
  
<main class="container mt-4">
    <div class="row justify-content-center">
        <!-- Formulario de inicio de sesión dentro de una carta -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Iniciar Sesión</h2>
                    <form action="http://localhost/nutritrack/index.php?c=Sesion&a=iniciarSesion"  method="post">
                        <div class="form-group">
                            <label for="username">Correo:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su correo" required >
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required >
                        </div>
                        <!-- <?php if (isset($_GET['error_message'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($_GET['error_message']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['sucess_message'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($_GET['sucess_message']); ?>
                            </div>
                        <?php endif; ?> -->
                        <div class="col-12 mt-4">
                            <?php
                            // Check for success message
                            if (isset($data["messages"]["success"])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                echo $data["messages"]["success"];
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            }

                            // Check for error message
                            if (isset($data["messages"]["error"])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                echo $data["messages"]["error"];
                                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

  <?php include("./src/View/templates/footer.php")?>
