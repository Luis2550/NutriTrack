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
    <link rel="stylesheet" href="./public/css/estilo_formulario_configuracion4.css">
    <link rel="stylesheet" href="./public/css/estilo_historial_medidas1.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Otros enlaces de estilos aquí -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyTq1iUJl5E9l7Ixn0bPbIq9tlRyP1iR6L" crossorigin="anonymous"></script>
    
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Incluye flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Alerta -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            .titulo-img{
                font-size: 16px;
                text-align: center;
                
            }

            .contenedor-img{
                margin-bottom: 30px;
                border: 3px solid white;
                border-radius: 5px;
            }
        }

        @media (max-width: 767px) {
            .navbar {
                width: 100%;
                background-color: #4bdd86; 
                
            }

            .navbar a{
                color: white;
            }

            .main .title{
                font-size: 22px;
                margin-top: 15px;
            }

            .main .titulo_h2{
                text-align: center;
                font-size: 18px;
                margin: 40px 0;
            }

            .card-body .card-title{
                font-size: 18px;
            }
            
            .btn{
                padding: 5px 8px;
            }

            .main_historialCli{
                all: unset;
            }

            .main_historialCli .formulario-intro-container{
                padding: 0;
                all: unset;
                width: 100%
            }

            .main_historialCli .formulario-intro{
                padding: 0;
            }

            .main_historialCli .form-responsive{
                padding: 0;
                width:100%;
            }
            

            .main_historialMed .pizarra{
                all: unset;
                width: 100%;
                background-color: red;
            }

            .main_historialMed .notita{
                width: 100%;
                font-size: 14px;
                margin-bottom: ;
               
            }

            .main_historialMed .grafica{
                width:100%;
            }

            .main_historialMed .grafica{
                width:100%;
            }

            .main_historialMed #pesoChart{
                height: 300px;
            }

            .main_historialMed .notita{
                margin-bottom: 20px;
            }

            /* .navbar .navbar-toggler-icon{
                background-color: black;
                color: red;
            } */

            .titulo-img{
                font-size: 16px;
                text-align: center;
                
            }

            .contenedor-img{
                margin: 10px 0;
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
            <i class="fa-solid fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="sidebar-sticky">
                    <nav class="nav flex-column">
                    <a class="nav-link contenedor-img" href="">
                        <div class="d-flex align-items-center">
                            <img width="50" height="70" src="./uploads/<?= $_SESSION['usuario']['foto'] ?>" class="img-fluid rounded-circle mr-2" alt="">
                            <h3 class="titulo-img">
                                <?php
                                    $nombres = explode(" ", $_SESSION['usuario']['nombres']);
                                    $apellidos = explode(" ", $_SESSION['usuario']['apellidos']);
                                    echo $nombres[0] . " " . $apellidos[0];
                                ?>
                            </h3>
                        </div>
                    </a>

                    
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
                        <a class="nav-link" href="http://localhost/Nutritrack/index.php?c=Usuarios&a=verUsuarios">
                            <i class="fa-solid fa-book"></i> Pacientes
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
 

<script>
    const reloadCookie = document.cookie.replace(/(?:(?:^|.*;\s*)reload_page_once\s*\=\s*([^;]*).*$)|^.*$/, '$1');

    if (reloadCookie === 'true') {
        document.cookie = 'reload_page_once=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

        // Recargar la página después de 100 milisegundos
        setTimeout(() => {
            location.reload();
        }, 100);
    }
</script>
