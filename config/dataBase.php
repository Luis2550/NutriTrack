<?php

class Conectar{


    public static function conexion(){
        $conexion = new mysqli('localhost', 'root', '', 'db_nutritrack');
        return $conexion;
    }

}

?>