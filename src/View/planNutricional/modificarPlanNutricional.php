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

        <script src="./public/js/modificarPlanNutricional.js"></script>
        <script src="./public/js/formulariosR.js"></script>

        <form class="formulario bg-light p-4 rounded" id="modificar" onsubmit="return onSubmitForm()" name="modificar" method="POST" action="index.php?c=planNutricional&a=actualizarPlanNutricional" autocomplete="off">
          
          <h2 class="titulo text-center">Editar <?php echo $data['titulo'];?></h2>

          <input type="hidden" id="id" name="id" value="<?php echo $data["plan_nutricional"][0]['id_plan_nutricional']; ?>" >

          <input type="hidden" id="ci_nutriologa" name="ci_nutriologa" required value="<?php echo $data["plan_nutricional"][0]["ci_nutriologa"]?>">

          <h3 class="titulo text-left">Datos Paciente</h3>

          <div class="form-group">
            <label for="ci_pacientes">Cédula:</label>
            <input class="form-control" type="text" id="ci_paciente" name="ci_paciente" required readonly value="<?php echo $data["plan_nutricional"][0]["ci_usuario"]?>">
          </div>

          <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input class="form-control" type="text" readonly id="nombres" name="nombres" value="<?php echo $data["plan_nutricional"][0]["nombres"]?>">
          </div>

          <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input class="form-control" type="text" readonly id="apellidos" name="apellidos" value="<?php echo $data["plan_nutricional"][0]["apellidos"]?>">
          </div>

          <div class="form-group">
            <label for="fechaFinSuscripcion">Fecha Fin Suscripción:</label>
            <input class="form-control" type="date" readonly id="fechaFinSuscripcion" timezone="UTC" name="fechaFinSuscripcion" value="<?php echo $data["plan_nutricional"][0]["fin_suscripcion"]?>" onchange="" readonly required>
          </div>

          <div class="form-group">
            <label for="estado">Estado Suscripción:</label>
            <input class="form-control" type="text" readonly id="estado" value="<?php echo $data['plan_nutricional'][0]['estado']; ?>" name="estado" required>
          </div>

          <h3 class="titulo text-left">Datos Paciente</h3>
          
          <div class="form-group">
            <label for="fechaIni">Fecha Inicio:</label>
            <input class="form-control" type="date"  id="fecha_ini" timezone="UTC" name="fecha_ini" onchange="calcularFechas()" required value="<?php echo $data["plan_nutricional"][0]["fecha_inicio"]?>">
          </div>

          <div id="error-message" class="error-message"><?php echo isset($data['error_message']) ? $data['error_message'] : ""; ?></div>

          <div class="form-group">
            <label for="fechaFin">Fecha Fin:</label>
            <input class="form-control" type="date" readonly id="fecha_fin" timezone="UTC" name="fecha_fin" value="<?php echo $data["plan_nutricional"][0]["fecha_fin"]?>" required>
          </div>

          <div class="form-group">
            <label for="duracionDias">Duración en Dias:</label>
            <input class="form-control" type="text" readonly id="duracionDias" name="duracionDias" required value="<?php echo $data["plan_nutricional"][0]["duracion_dias"]?>">
          </div>
        
          <button class="btn btn-primary btn-block" id="guardar" name="guardar" onclick="onSubmitForm('guardar')" type="submit" class="button">Guardar</button>
          <button class="btn btn-secondary btn-block" id="cancelar" onclick="onSubmitForm('cancelar')" name="cancelar" type="submit" class="cancelar">Cancelar</button>
          
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