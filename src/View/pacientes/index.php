<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_usuario.php")?>


<main class="main"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
</main>

<?php include("./src/View/templates/footer_usuario.php")?>