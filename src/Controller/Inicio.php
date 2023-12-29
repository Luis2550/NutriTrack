<?php

class InicioController {

    public function __construct() {
    }

    //Direcciones para el inicio de la pagina

    public function inicio() {
        require_once(__DIR__ . '/../View/inicioPagina.php');
    }

    public function sobre_nosotros() {
        require_once(__DIR__ . '/../View/sobre_nosotros.php');
    }

    public function inicio_sesion() {
        require_once(__DIR__ . '/../View/inicio_sesion.php');
    }

    //Direcciones para el paciente

    public function inicio_p() {
        require_once(__DIR__ . '/../View/pacientes/index.php');
    }


    //Direcciones para la nutriologa

    public function inicio_n() {
        require_once(__DIR__ . '/../View/nutriologa/index.php');
    }

    public function cerrar() {
        require_once(__DIR__ . '/../View/cerrar.php');
    }

}

?>
