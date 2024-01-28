<?php
    $urlBase = "http://localhost/nutritrack/src/View/administrador/";
    date_default_timezone_set('America/Guayaquil'); // Establecer la zona horaria a Ecuador
    $fecha_actual = (new DateTime())->format('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Enlace al CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/estilo_administrador3.css">
    <link rel="stylesheet" href="./public/css/estilo_formulario_configuracion.css">
    <link rel="stylesheet" href="./public/css/estilo_historial_medidas1.css">
    <!-- Otros enlaces de estilos aquí -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <style>
        
        /* Personaliza la barra de navegación en dispositivos más grandes */
        @media (min-width: 768px) {
            .navbar {
                height: 100vh; /* Ocupa el 100% de la altura de la ventana */
                background-color: #4bdd86; /* Color de fondo */
                position: fixed; /* Fija la barra de navegación */
                padding-top: 20px; /* Añade espacio en la parte superior para centrar los elementos verticalmente */
            }

            /* Centra verticalmente los elementos de la barra de navegación */
            .navbar-nav {
                flex-direction: column;
                align-items: center;
                margin-top: auto;
                margin-bottom: auto;

            }

            /* Ajusta el contenido principal para tener margen a la izquierda */
            .main-content {
                margin-left: 240px; /* Ajusta el valor según el ancho de tu barra de navegación */
            }

            a{
                text-decoration: none;
                color: white;
                padding: 5px;
            }

            a:hover{
                color: #f0fdf4;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Barra de navegación de Bootstrap -->
        <nav class="navbar navbar-expand-lg  col-md-2">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="sidebar-sticky">
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="http://localhost/nutritrack/index.php?c=Citas&a=verCitas">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                        <a class="nav-link" href="http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional">
                            <i class="fa-brands fa-nutritionix"></i> Agregar Comida
                        </a>
                        <a class="nav-link" href="http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinico">
                        <i class="fa-solid fa-suitcase-medical"></i> Historial Clinico
                        </a>
                        <!-- Agrega otros elementos del menú aquí -->
                        <a class="nav-link" href="http://localhost/Nutritrack/index.php?c=Suscripcion&a=verSuscripcion">
                            <i class="fa-solid fa-book"></i> Planes
                        </a>
                        <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Configuracion&a=verConfiguracion">
                            <i class="fas fa-cog"></i> Configuración Citas
                        </a>
                        <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Usuarios&a=modificarUsuarios_n&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>">
                            <i class="fas fa-user-md"></i> Cuenta
                        </a>
                        <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Inicio&a=cerrar">
                            <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                        </a>
                    </nav>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 main-content">
            <!-- Contenido de la página aquí -->
 