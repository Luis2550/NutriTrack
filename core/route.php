<?php

function cargarControlador($controlador){
    $nombreControlador = ucwords($controlador)."Controller";
    $archivoControlador = __DIR__ . '/../src/Controller/'.ucwords($controlador).'.php';
    
    if(!is_file($archivoControlador)){
        $archivoControlador= 'Controller/'.CONTROLADOR_PRINCIPAL.'.php';
    }
    require_once $archivoControlador;
    $control = new $nombreControlador();
    return $control;
}

function cargarAccion($controller, $accion, $id = null){
    // Obtener los parámetros de la URL
    $parametros = $_GET;
    
    // Verificar si hay un parámetro 'id' y asignarlo a $id
    if (isset($parametros['id'])) {
        $id = $parametros['id'];
    }
    
    // Verificar si hay un parámetro 'ci_paciente' y asignarlo a $ci_paciente
    if (isset($parametros['ci_paciente'])) {
        $ci_paciente = $parametros['ci_paciente'];
    }
    
    // Llamar a la acción correspondiente con los parámetros
    if (isset($accion) && method_exists($controller, $accion)) {
        if ($id == null) {
            // Si no hay 'id', verifica si hay 'ci_paciente'
            if (isset($ci_paciente)) {
                $controller->$accion($ci_paciente);
            } else {
                $controller->$accion();
            }
        } else {
            $controller->$accion($id);
        }
    } else {
        $controller->ACCION_PRINCIPAL();
    }	
}

?>
