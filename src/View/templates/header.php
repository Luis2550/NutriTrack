<?php
    $urlBase = "http://localhost/nutritrack/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/estilo.css">
    <link rel="stylesheet" href="./public/css/login1.css">
</head>
<body>
    
    <header class="container">
        <nav class="nav">
            <div class="nav__logo">
                <img src="./public/assets/images/logo.png" alt="" class="nav__img">
            </div>
            <div class="nav__links">
                <a href="<?php echo $urlBase;?>index.php" class="nav__link">Inicio</a>
                <a href="<?php echo $urlBase;?>index.php?c=Inicio&a=sobre_nosotros" class="nav__link">Sobre Nosotros</a>
                <a href="<?php echo $urlBase;?>index.php?c=Inicio&a=inicio_sesion" class="nav__link nav__link--inicio">Inicio Sesion</a>
                <a href="http://localhost/nutritrack/index.php?c=Usuarios&a=nuevoUsuarios" class="nav__link">Registrarse</a>
            </div>
        </nav>

        