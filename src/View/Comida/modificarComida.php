<?php
  #Verificar el inicio de sesión
  session_start();

  // Verifica si hay una sesión activa
  if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
  }

?>


    <?php include("./src/View/templates/header_administrador.php")?>
   
      <main class="container mt-5 d-flex justify-content-center">
        
        <script src="./public/js/modificarComida.js"></script>

        <form class="formulario bg-light p-4 rounded" id="modificarComida" onsubmit="return onSubmitForm()" name="modificarComida" method="POST" action="index.php?c=Comida&a=actualizarComida" autocomplete="off">
          <h2 class="titulo text-center">Modificar Comida</h2>

          <input type="hidden" id="id_comida" name="id_comida" required value="<?php echo $data["comida"]["id_comida"]; ?>">

          <div class="form-group">
            <label for="comida">Comida:</label>
            <input type="text" id="comida" name="comida" class="form-control" pattern="[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+" required value="<?php echo $data["comida"]["comida"]; ?>">
          </div>

          <div class="form-group">
            <label for="id_tipo_comida">Tipo Comida:</label>

            <?php
              // Supongamos que $diaDesdeBD contiene el valor almacenado en la base de datos
              $tipoComidaDB = $data["comida"]["id_tipo_comida"];
            ?>
            <select id="id_tipo_comida" name="id_tipo_comida" class="form-control" required>
              <?php foreach ($data_tipos_comida['tipo_comida'] as $tipoComida) { ?>
                <option value="<?php echo $tipoComida['id_tipo_comida'];?>" <?php echo ($tipoComidaDB == $tipoComida['id_tipo_comida']) ? 'selected' : ''; ?>><?php echo $tipoComida['tipo_comida']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="2" maxlength="300" required ><?php echo $data["comida"]["descripcion"]; ?></textarea>
          </div>

          <div class="form-group">
            <label for="cantidad_proteina">Cantidad de Proteína:</label>
            <input type="number" id="cantidad_proteina" name="cantidad_proteina" class="form-control" min="1" max="10000" required value="<?php echo $data["comida"]["cantidad_proteina"]; ?>">
          </div>

          <div class="form-group">
            <label for="cantidad_carbohidratos">Cantidad de Carbohidratos:</label>
            <input type="number" id="cantidad_carbohidratos" name="cantidad_carbohidratos" class="form-control" min="1" max="10000" required value="<?php echo $data["comida"]["cantidad_carbohidratos"]; ?>">
          </div>

          <div class="form-group">
            <label for="cantidad_grasas_saludables">Cantidad de Grasas Saludables:</label>
            <input type="number" id="cantidad_grasas_saludables" name="cantidad_grasas_saludables" class="form-control" min="1" max="10000" required value="<?php echo $data["comida"]["cantidad_grasas_saludables"]; ?>">
          </div>

          <button id="guardarComida" name="guardarComida" type="submit" onclick="onSubmitForm('guardar')" class="btn btn-primary btn-block">Actualizar Comida</button>
          <button id="cancelar" name="cancelar" type="submit" onclick="onSubmitForm('cancelar')" class="btn btn-secondary btn-block">Cancelar</button>
        </form>
      </main>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  </body>

<?php include("./src/View/templates/footer_administrador.php")?>
