<?php

class Conectar{


    public static function conexion(){
        $conexion = new mysqli('localhost', 'root', '', 'nutritrack2');
        return $conexion;
    }

}

?>