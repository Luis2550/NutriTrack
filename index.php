<?php

require_once "config/dataBase.php";
require_once "core/route.php";
require_once "config/config.php";
require_once "src/Controller/CalendarioCitas.php";
require_once "src/Controller/HorarioLaboral.php";
require_once "src/Controller/Comida.php";
require_once "src/Controller/Configuracion.php";
require_once "src/Controller/Usuarios.php";

if(isset($_GET['c'])){
		
    $controlador = cargarControlador($_GET['c']);
    
    if(isset($_GET['a'])){
        if(isset($_GET['id'])){
            cargarAccion($controlador, $_GET['a'], $_GET['id']);
            } else {
            cargarAccion($controlador, $_GET['a']);
        }
        } else {
        cargarAccion($controlador, ACCION_PRINCIPAL);
    }
    
    } else {
    
    $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
    $accionTmp = ACCION_PRINCIPAL;
    $controlador->$accionTmp();
}

?>