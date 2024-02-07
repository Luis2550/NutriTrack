<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

function decrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string); // Corregido: base64_decode en lugar de base64_encode
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}

// Obtener la contraseña encriptada de $data["usuarios"]["clave"]
$clave_encriptada = $data["usuarios"]["clave"];
$tu_llave_secreta = 'memocode';

// Desencriptar la contraseña
$clave_desencriptada = decrypt($clave_encriptada, $tu_llave_secreta);

?>


<?php include("./src/View/templates/header_administrador.php")?>

<div class="card"> 
    <div class="card-body">
        <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=actualizarUsuarios" autocomplete="off" enctype="multipart/form-data">
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

                    <!-- <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" id="clave" name="clave" required class="form-control" value="<?php echo $data["usuarios"]["clave"]?>">
                    </div> -->
                    <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" id="clave" name="clave" required class="form-control" value="<?php echo $clave_desencriptada; ?>">
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
                        <img width="100" src="./uploads/<?php echo $data["usuarios"]["foto"];?>" class="img-fluid rounded" alt="">

                        <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required class="form-control" value="<?php echo $data["usuarios"]["foto"]?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
            <div class="col-md-6"> <!-- Aquí especificas el ancho que deseas, en este caso, la mitad -->
            <button id="guardar" name="guardar" type="submit" class="btn btn-primary btn-block" style="background-color: #22c55e; border-color: #22c55e">Actualizar</button>
            </div>
            </div>
            
        </form>
    </div>
    
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nuevo').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe de manera predeterminada
        event.preventDefault();

        // Muestra la alerta después de unos segundos
        setTimeout(function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cambios realizados con éxito",
                showConfirmButton: false,
            });
        }, 1000); // Cambia el valor del temporizador según tus necesidades

        // Envía el formulario después de mostrar la alerta
        setTimeout(function () {
            window.location.href = 'http://localhost/nutritrack/index.php?c=Usuarios&a=verUsuarios';
        }, 3000); // Asegúrate de ajustar el valor del temporizador según el tiempo de la alerta
    });
});


</script>

<?php include("./src/View/templates/footer_administrador.php")?>
