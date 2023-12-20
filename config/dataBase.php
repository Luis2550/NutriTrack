<?php

class Conectar{


    public static function conexion(){
        $conexion = new mysqli('localhost', 'root', '', 'nutritrack3');
        return $conexion;
    }

}

?>