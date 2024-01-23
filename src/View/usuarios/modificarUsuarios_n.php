<?php include("./src/View/templates/header_administrador.php")?>

<div class="card"> 
    <div class="card-body">
        <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=actualizarUsuarios" autocomplete="off">
            <h2 class="card-title">Editar Datos</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Cédula:</label>
                        <input type="text" id="id" name="id" readonly class="form-control" value="<?php echo $data["ci_usuario"]; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <input type="text" id="rol" name="rol" readonly class="form-control" value="<?php echo $data["usuarios"]["rol"]; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombres:</label>
                        <input type="text" id="nombres" name="nombres" required class="form-control" value="<?php echo $data["usuarios"]["nombres"]?>">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" required class="form-control" value="<?php echo $data["usuarios"]["apellidos"]?>">
                    </div>

                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <select id="edad" name="edad" required class="form-control">
                            <?php
                            $edadActual = $data["usuarios"]["edad"];
                            ?>
                            <?php for ($i = 5; $i <= 100; $i++) : ?>
                                <option value="<?php echo $i; ?>" <?php if ($i == $edadActual) echo "selected"; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" required class="form-control" value="<?php echo $data["usuarios"]["correo"]?>">
                    </div>

                    <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" id="clave" name="clave" required class="form-control" value="<?php echo $data["usuarios"]["clave"]?>">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select id="sexo" name="sexo" required class="form-control">
                            <?php
                            $sexoActual = $data["usuarios"]["sexo"];
                            ?>
                            <option value="MASCULINO" <?php if ($sexoActual === "MASCULINO") echo "selected"; ?>>Masculino</option>
                            <option value="FEMENINO" <?php if ($sexoActual === "FEMENINO") echo "selected"; ?>>Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto:</label>
                        <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required class="form-control" value="<?php echo $data["usuarios"]["foto"]?>">
                    </div>
                </div>
            </div>
            
            <button id="guardar" name="guardar" type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

<?php include("./src/View/templates/footer_administrador.php")?>
