
<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main main_nuevo_actividades"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Agregar Actividad</h2>

  <form id="nuevo" name="nuevo" method="POST" action="index.php?c=actividad&a=guardarActividad" autocomplete="off">
    
    <label for="ci_paciente">CI Paciente:</label>
    
    <input type="text" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario'];?>">

    <label for="actividad">Actividad:</label>
    <input type="text" id="actividad" name="actividad" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" class='textarea' required></textarea>
 
    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>

    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>

  </main>

<?php include("./src/View/templates/footer_usuario.php")?>
