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
        //var_dump();


        //$ci_usuario = isset($_GET['ci_usuario']) ? $_GET['ci_usuario'] : null;
        //echo $ci_usuario;
        if (isset($_GET['ci_usuario'])) {
            // Obtener el valor de ci_paciente
            //Cédula del paciente
            $ci_paciente = $_GET['ci_usuario'];
            //echo $ci_paciente;

            date_default_timezone_set('America/Guayaquil');
            
            //fecha actual
            $fechaActual = date('Y-m-d');
            //echo $fechaActual;

            $nombreDiasEsp = [
                'Monday'    => 'LUNES',
                'Tuesday'   => 'MARTES',
                'Wednesday' => 'MIÉRCOLES',
                'Thursday'  => 'JUEVES',
                'Friday'    => 'VIERNES',
                'Saturday'  => 'SÁBADO',
                'Sunday'    => 'DOMINGO'
            ];

            $nombreDiaActual = date('l'); // Obtén el nombre del día en inglés
            
            //Nombre actual del dia
            $nombreDiaActualEsp = $nombreDiasEsp[$nombreDiaActual]; // Convierte al equivalente en español
            //echo $nombreDiaActualEsp;

            $planNutri = new planNutricionalModel();
            $data['titulo'] = ' Plan Nutricional';
            $data['comida_diaria'] = $planNutri->get_comidasDiaPaciente($ci_paciente, $nombreDiaActualEsp, $fechaActual);
            $data['dia'] = $nombreDiaActualEsp;
            //var_dump($data['comida_diaria']);
            require_once(__DIR__ . '/../View/pacientes/index.php');
            // Ahora puedes utilizar la variable $ci_paciente en tu código PHP
            //echo "Cédula del paciente: " . $ci_paciente;
        } else {
            // En caso de que ci_paciente no esté presente en la URL
            echo "No se proporcionó la cédula del paciente.";
        }

        require_once(__DIR__ . '/../View/pacientes/index.php');


    }


    //Direcciones para la nutriologa

    public function inicio_n() {
        require_once(__DIR__ . '/../View/nutriologa/index.php');
    }

    public function cerrar() {
        require_once(__DIR__ . '/../View/cerrar.php');
    }
    public function inicio_validacion() {
        require_once(__DIR__ . '/../View/inicio_validacion.php');
    }

}

?>
