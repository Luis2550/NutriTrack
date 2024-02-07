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
<div id="form-container" class="container mt-4 col-md-8 my-auto">
  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off">
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
          <label for="foto">Foto:</label>
          <input type="file" class="form-control" id="foto" class="foto" name="foto" accept=".jpg, .jpeg, .png"  requireda>
        </div>
      </div>
      <div class="col-7 mt-1 mx-auto">
        <div class="alert <?php echo isset($data["error_message"]) ? 'alert-danger' : 'd-none'; ?> alert-dismissible fade show" role="alert">
          <?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="col-7 mt-1 mx-auto">
        <button id="guardar" name="guardar" type="submit" class="btn btn-lg btn-success btn-block">Registrar</button>
      </div>
    </div>
  </form>
</div>

<?php include("./src/View/templates/footer.php")?>







