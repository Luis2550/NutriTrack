<?php

class DetalleComidaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/detalleComidaModel.php";
    }

    public function verDetalleComidas(){

        $detalle_comida = new DetalleComidaModel();
        $data['titulo'] = 'detalle comidas';
        $data['detalle_comida'] = $detalle_comida->get_DetalleComidas();

        require_once(__DIR__ . '/../View/detalle_comida/verDetalleComida.php');
    }


    
}

?>