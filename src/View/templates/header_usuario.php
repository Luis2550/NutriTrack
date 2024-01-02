
<?php
    $urlBase = "http://localhost/nutritrack/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./public/css/estilo_usuario4.css">
    <link rel="stylesheet" href="./public/css/estilo_citas7.css">
    <link rel="stylesheet" href="./public/css/estilo_actividades3.css">
    <link rel="stylesheet" href="./public/css/estilo_historialCli2.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<!-- Incluye Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Incluye el archivo de idioma de español -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>


</head>
<body>
    
<div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="http://localhost/nutritrack/index.php?c=Inicio&a=inicio_p"><i class="fas fa-home"></i> Inicio</a></li>
                
                <li><a href="http://localhost/nutritrack/index.php?c=Actividad&a=verActividadesPacientes&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fas fa-running"></i> Actividades</a></li>

                <li><a href="http://localhost/nutritrack/index.php?c=Citas&a=nuevoCitas"><i class="far fa-calendar-alt"></i> Agendar Cita</a></li>

                <li><a href="http://localhost/nutritrack/index.php?c=Citas&a=ver_citas_paciente&ci_paciente=<?= $_SESSION['usuario']['ci_usuario'] ?>"><i class="fa-solid fa-eye"></i> Ver citas</a></li>


                <li><a href="#"><i class="fas fa-file-medical"></i> Ver Historial Clínico</a></li>
                <li><a href="#"><i class="fas fa-utensils"></i> Ver Plan Nutricional</a></li>
                <li><a href="#"><i class="fas fa-user"></i> Cuenta</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=Inicio&a=cerrar"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a></li>
            </ul>
        </nav> 