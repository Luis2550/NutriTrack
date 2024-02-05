<?php include("./src/View/templates/header.php")?>

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

<div class="container mt-4">
  <div id="form-container" class="col-md-8 mx-auto">
    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off" enctype="multipart/form-data">
      <h2 class="text-center">Registro<?php echo $data['titulo'];?></h2>
      <?php
      if (isset($data['errors']) && count($data['errors']) > 0) {
          echo '<div id="error-message" class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
          foreach ($data['errors'] as $error) {
              echo '<li>' . $error . '</li>';
          }
          echo '</ul><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
      }
      ?>
      <div class="form-row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="text" class="form-control" id="cedula" name="cedula" maxlength="10" requireda>
          </div>
          <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" class="form-control" id="nombres" name="nombres" requireda>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" requireda>
          </div>
          <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d'); ?>">
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" requireda>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="clave">Contraseña:</label>
            <input type="password" class="form-control" id="clave" name="clave" requireda>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select class="form-control" id="sexo" name="sexo" requireda>
              <option value="MASCULINO">Masculino</option>
              <option value="FEMENINO">Femenino</option>
            </select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="imagen-preview">Imagen Preview:</label>
            <img id="imagen-preview" class="img-thumbnail" style="max-width: 100%; max-height: 200px;" />
          </div>
          <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" class="form-control" id="foto" class="foto" name="foto" accept=".jpg, .jpeg, .png" onchange="mostrarImagenPreview(this);" requireda>
          </div>
        </div>
      </div>
      <div class="col-12 mt-3">
        <div class="alert <?php echo isset($data["mensaje"]) ? 'alert-danger' : 'd-none'; ?> alert-dismissible fade show" role="alert">
          <?php echo isset($data["mensaje"]) ? $data["mensaje"] : ""; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="col-md-5 mx-auto mt-3">
        <button id="guardar" name="guardar" type="submit" class="btn btn-lg btn-success btn-block">Registrar</button>
      </div>
    </form>
  </div>
</div>

<script>
  function mostrarImagenPreview(input) {
    var imagenPreview = document.getElementById('imagen-preview');
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        imagenPreview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      imagenPreview.src = '';
    }
  }
</script>

<?php include("./src/View/templates/footer.php")?>






