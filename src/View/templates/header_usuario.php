
<?php
    $urlBase = "http://localhost/nutritrack/";
    date_default_timezone_set('America/Guayaquil'); // Establecer la zona horaria a Ecuador
    $fecha_actual = (new DateTime())->format('Y-m-d');
    // $fecha_maxima = date("Y-m-d", strtotime($fecha_actual . " + 9 days"));
    
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
    <link rel="stylesheet" href="./public/css/estilo_formulario_configuracion2.css">
    <link rel="stylesheet" href="./public/css/citas.css">
    
    <!-- Otros enlaces de estilos aquí -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <style>
        
        /* Personaliza la barra de navegación en dispositivos más grandes */
        @media (min-width: 768px) {
            .navbar {
                height: 100vh; /* Ocupa el 100% de la altura de la ventana */
                background-color: #3d90f4; /* Color de fondo */
                position: fixed; /* Fija la barra de navegación */
                padding-top: 20px; /* Añade espacio en la parte superior para centrar los elementos verticalmente */
                color: white;
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
                color: #c0dffd;
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
                background-color: #3d90f4;
                
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

                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Inicio&a=inicio_p&ci_usuario=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-home"></i> Inicio</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Actividad&a=verActividadesPacientes&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-running"></i> Actividades</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Citas&a=nuevoCitas"><i class="far fa-calendar-alt"></i> Agendar Cita</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Citas&a=ver_citas_paciente&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fa-solid fa-eye"></i> Ver citas</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinicoPaciente&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-file-medical"></i> Ver Historial Clínico</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=historialMedidas&a=verHistorialMedidasPaciente&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fa-solid fa-weight-scale"></i> Ver Medidas</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=pacientePlanNutricional&a=verPlanNutricional&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-utensils"></i> Ver Plan Nutricional</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Usuarios&a=modificarUsuarios&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-user"></i> Cuenta</a>
                    <a class="nav-link" href="http://localhost/nutritrack/index.php?c=Inicio&a=cerrar"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a>
                    
                    </nav>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 main-content">
            <!-- Contenido de la página aquí -->
 