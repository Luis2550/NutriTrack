<?php include("./src/View/templates/header.php")?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  #form-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 600px; /* Ajusta el ancho según tu preferencia */
    display: grid;
    grid-template-columns: 1fr; /* Cambiado a dos columnas */
    gap: 16px; /* Espacio entre las columnas */
    margin: auto;  /* Ajusta la separación del formulario desde la parte superior */
  }

  form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 16px;
  }

  h2 {
    grid-column: span 2; /* Ocupa ambas columnas */
    margin-bottom: 20px;
    text-align: center;
  }

  label {
    margin-bottom: 8px;
    display: block; /* Mostrar cada etiqueta en una nueva línea */
  }

  input,
  select,
  button {
    margin-bottom: 16px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%; /* Ocupar todo el ancho de la columna */
  }

  select {
    width: calc(100% - 16px); /* Restar el espacio del padding para mantener el ancho total */
  }

  .button {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
    
  }

  .button:hover {
    background-color: #45a049;
  }

  #error-message {
    grid-column: span 2; /* Ocupa ambas columnas */
    margin-top: 10px;
    text-align: center;
    color: #FF0000;
  }
</style>

<div id="form-container">
  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Usuarios&a=guardarUsuarios" autocomplete="off">
    <h2>Registro<?php echo $data['titulo'];?></h2>
    <?php
    if (isset($data['errors']) && count($data['errors']) > 0) {
        echo '<div id="error-message" class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach ($data['errors'] as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    ?>
      <div>
        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" name="cedula" maxlength="10" requireda>
      </div>
      <input type="hidden" id="id_rol" name="id_rol" value="1"> <!-- El valor "1" puede representar el ID del rol de paciente -->
      <div>
        <label for="nombre">Nombres:</label>
        <input type="text" id="nombres" name="nombres" requireda>
      </div>
      <div>
        <label for="apellido">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" requireda>
      </div>
      <div>
      <label for="edad">Fecha de Nacimiento:</label>
      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d'); ?>">
      </div>
      <div>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" requireda>
      </div>
      <div>
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" requireda>
      </div>
      <div>
        <label for="sexo">Sexo:</label>
        <!-- Cambiar input de texto a un campo de selección de género -->
        <select id="sexo" name="sexo" requireda>
          <option value="MASCULINO">Masculino</option>
          <option value="FEMENINO">Femenino</option>
        </select>
      </div>
      <div>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" class="foto" name="foto" accept=".jpg, .jpeg, .png"  requireda>
        <div id="error-message"><?php echo isset($data["error_message"]) ? $data["error_message"] : ""; ?></div>
      </div>
      <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
    </form>
    
</div>

<?php include("./src/View/templates/footer.php")?>

