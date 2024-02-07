<?php include("./src/View/templates/header.php")?>

<!-- Agrega estas líneas para incluir Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .btn-custom {
        background-color: #82E0AA;
        border-color: #82E0AA;
        padding: 8px 16px; /* Ajusta el padding para cambiar el tamaño en la longitud del botón */
    }

    .alert-danger {
        font-size: 14px;
        padding: 8px 16px; /* Ajusta el padding para cambiar el tamaño en la longitud del mensaje de alerta */
        margin-bottom: 10px;
    }
</style>
<div id="form-container" class="container mt-4">
  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off" enctype="multipart/form-data">
    <h2 class="text-center">Registro <?php echo $data['titulo'];?></h2>
    <?php
    if (isset($data['errors']) && count($data['errors']) > 0) {
        echo '<div id="error-message" class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach ($data['errors'] as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    ?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="cedula">Cédula:</label>
          <input type="text" class="form-control" id="cedula" name="cedula" maxlength="10" required>
        </div>
        <div class="form-group">
          <label for="nombres">Nombres:</label>
          <input type="text" class="form-control" id="nombres" name="nombres" required>
        </div>
        <div class="form-group">
          <label for="apellidos">Apellidos:</label>
          <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
          <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d'); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="correo">Correo:</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
          <label for="clave">Contraseña:</label>
          <input type="password" class="form-control" id="clave" name="clave" required>
        </div>
        <div class="form-group">
          <label for="sexo">Sexo:</label>
          <select class="form-control" id="sexo" name="sexo" required>
            <option value="MASCULINO">Masculino</option>
            <option value="FEMENINO">Femenino</option>
          </select>
        </div>
        <div class="form-group">
          <label for="foto">Foto:</label>
          <input type="file" class="form-control-file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required onchange="mostrarImagenPreview(this)">
          <img id="imagen-preview" class="img-thumbnail mt-2" style="max-width: 100%; max-height: 200px; display: none;" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="alert <?php echo isset($data["error_message"]) ? 'alert-danger' : 'd-none'; ?> alert-dismissible fade show" role="alert">
          <?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <button id="guardar" name="guardar" type="submit" class="btn btn-lg btn-success btn-block">Registrar</button>
      </div>
    </div>
  </form>
</div>

<script>
  function mostrarImagenPreview(input) {
    var imagenPreview = document.getElementById('imagen-preview');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        imagenPreview.src = e.target.result;
        imagenPreview.style.display = 'block'; // Mostrar la imagen después de cargarla
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      imagenPreview.src = '';
      imagenPreview.style.display = 'none'; // Ocultar la imagen si no se selecciona ningún archivo
    }
  }
</script>

<?php include("./src/View/templates/footer.php")?>







