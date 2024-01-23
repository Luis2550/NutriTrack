<?php include("./src/View/templates/header.php")?>

<main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off">
                        <h2 class="text-center">Registro<?php echo $data['titulo'];?></h2>
                        <?php
                        if (isset($data['errors']) && count($data['errors']) > 0) {
                            echo '<div id="error-message" class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
                            foreach ($data['errors'] as $error) {
                                echo '<li>' . $error . '</li>';
                            }
                            echo '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                        }
                        ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cedula">Cédula:</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="10" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>
                            <div class="col-md-6">
                                <label for="apellido">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edad">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="correo">Correo:</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="col-md-6">
                                <label for="clave">Contraseña:</label>
                                <input type="password" class="form-control" id="clave" name="clave" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sexo">Sexo:</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                    <option value="MASCULINO">Masculino</option>
                                    <option value="FEMENINO">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="foto">Foto:</label>
                                <input type="file" class="form-control" id="foto" class="foto" name="foto" accept=".jpg, .jpeg, .png" required>
                                <div id="error-message"><?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?></div>
                            </div>
                        </div>
                        <button id="guardar" name="guardar" type="submit" class="btn btn-primary mt-3">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("./src/View/templates/footer.php")?>

