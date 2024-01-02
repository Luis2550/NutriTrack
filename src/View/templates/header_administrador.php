<?php
    $urlBase = "http://localhost/nutritrack/src/View/administrador/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./public/css/estilo_administrador3.css">
    <link rel="stylesheet" href="./public/css/estilo_citas7.css">
    <link rel="stylesheet" href="./public/css/estilo_configuracion4.css">
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
    <link rel="stylesheet" href="./public/css/estilo_suscripcion.css">
    <link rel="stylesheet" href="./public/css/estilo_actividades3.css">
    <link rel="stylesheet" href="./public/css/estilo_historialCli2.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    
</head>
<body>
    
<div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="http://localhost/nutritrack/index.php?c=Inicio&a=inicio_n"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional"><i class="fa-brands fa-nutritionix"></i> Plan Nutricional</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=Actividad&a=verActividad"><i class="fa-solid fa-user-plus"></i> Seguimiento Pacientes</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinico"><i class="fa-solid fa-book-medical"></i> Historial Clínico</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=Citas&a=verCitas"><i class="far fa-calendar-check"></i> Ver Citas Agendadas</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=Configuracion&a=verConfiguracion"><i class="fa-solid fa-gear"></i> Configuracion citas</a></li>
                <li><a href="http://localhost/Nutritrack/index.php?c=Usuarios&a=verUsuarios"><i class="fa-solid fa-hospital-user"></i> Pacientes</a></li>
                <li><a href="http://localhost/Nutritrack/index.php?c=historialSuscripcion&a=verHistorialSuscripcion"><i class="fa-solid fa-book"></i> Planes</a></li>
                <li><a href="#"><i class="fas fa-user-md"></i> Cuenta</a></li>
                <li><a href="http://localhost/nutritrack/index.php?c=Inicio&a=cerrar"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a></li>
            </ul>
        </nav> 