<?php
    $urlBase = "http://localhost/nutritrack/";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Página de Inicio</title>
    <!-- Enlace a la biblioteca Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Color personalizado para la barra de navegación */
        .footer {
            text-align: center;
        }

        .navbar-custom {
            background-color: #94e1a1;
        }

        /* Alinea el footer en la parte inferior de la página */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Ajustes para la barra de navegación */
        .navbar-brand img {
            height: 40px; /* Ajusta el tamaño del logo */
        }

        .navbar-nav {
            margin-right: 20px; /* Aumenta el espacio a la derecha de los elementos de navegación */
        }

        .nav-link{
            font-size: 18px;
            color:black;
        }
        


    </style>
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <a class="navbar-brand" href="#">
        <img src="./public/assets/images/logo.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link link" href="<?php echo $urlBase?>index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase?>index.php?c=Inicio&a=sobre_nosotros">Sobre nosotros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase?>index.php?c=Inicio&a=inicio_sesion">Inicio Sesión</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $urlBase?>index.php?c=Usuarios&a=nuevoUsuarios">Registrarse</a>
            </li>
        </ul>
    </div>
</nav>
    