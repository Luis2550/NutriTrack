<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_suscripcion" >
<form id="nuevo" name="nuevo" method="POST" action="index.php?c=Suscripcion&a=guardarSuscripcion" autocomplete="off">
    <h2>Registro<?php echo $data['titulo'];?></h2>

    <label for="suscripcion">Suscripcion:</label>
    <input type="text" id="suscripcion" name="suscripcion" required>

    <label for="duracion_dias">Duracion Dias:</label>
    <input type="num" id="duracion_dias" name="duracion_dias" required>
    
    <button id="guardar" name="guardar" type="submit" class="button">Registrar</button>
  </form>
</main>
<?php include("./src/View/templates/footer_administrador.php")?>




