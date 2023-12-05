<?php

class ConfiguracionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/configuracionModel.php";
    }

    public function verConfiguracion(){

        $configuraciones = new configuracionModel();
        $data['titulo'] = ' configuracion';
        $data['configuraciones'] = $configuraciones->get_Configuraciones();

        require_once(__DIR__ . '/../View/configuracion/ver_configuraciones.php');
    }


    public function nuevoConfiguraciones(){
        $configuraciones = new configuracionModel();
        $data['opciones_nutriologa'] = $configuraciones->getCiNutriologa();
        $data['titulo'] = 'Configuraciones';
        require_once(__DIR__ . '/../View/configuracion/nuevoConfiguraciones.php');
    }



    public function guardarConfiguraciones(){
        
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $dias_laborales = $_POST['dias_laborales'];
        $duracion_cita = $_POST['duracion_cita'];
        
        $configuraciones = new configuracionModel();
        $configuraciones->insertar_Configuraciones($ci_nutriologa, $dias_laborales, $duracion_cita);
        $data["titulo"] = "Configuraciones";
        $this->verConfiguracion();
    }


    public function modificarConfiguraciones($id){
			
        $configuraciones = new configuracionModel();
        $data["configuraciones"] = $configuraciones->get_Configuracion($id);
        $data["titulo"] = " Configuracion";
        require_once(__DIR__ . '/../View/configuracion/modificarConfiguraciones.php');
    }
    
    public function actualizarConfiguraciones(){

        $id_configuracion = $_POST['id_configuracion'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $dias_laborales = $_POST['dias_laborales'];
        $duracion_cita = $_POST['duracion_cita'];
        
        $configuraciones = new configuracionModel();
        $configuraciones->modificar_Configuraciones($id_configuracion, $ci_nutriologa, $dias_laborales, $duracion_cita);
        $data["titulo"] = " Configuracion";
        $this->verConfiguracion();
    }

    public function eliminarConfiguraciones($id){
        
        $configuraciones = new configuracionModel();
        $configuraciones->eliminarConfiguraciones($id);
        $data["titulo"] = " Configuracion";
        $this->verConfiguracion();
    }

   
}

?>