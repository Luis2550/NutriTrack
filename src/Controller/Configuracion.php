<?php

class ConfiguracionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/configuracionModel.php";
    }

    public function verConfiguracion(){

        $configuraciones = new configuracionModel();
        $data['titulo'] = ' configuracion';
        $data['configuraciones'] = $configuraciones->get_Configuraciones();

        require_once(__DIR__ . '/../View/nutriologa/configuracion/ver_configuracion.php');
    }

    public function nuevoConfiguraciones(){
        $configuraciones = new configuracionModel();
        require_once(__DIR__ . '/../View/nutriologa/configuracion/nuevoConfiguraciones.php');
    }
								
    public function guardarConfiguraciones(){
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $hora_inicio_manana = $_POST['hora_inicio_manana'];
        $hora_fin_manana = $_POST['hora_fin_manana'];
        $hora_inicio_tarde = $_POST['hora_inicio_tarde'];
        $hora_fin_tarde = $_POST['hora_fin_tarde'];
        $dias_semana = $_POST['dias_semana'];
        $duracion_cita = $_POST['duracion_cita'];
    
        $configuraciones = new configuracionModel();
        $configuraciones->insertar_Configuraciones($ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita);
        $data["titulo"] = "Configuraciones";
        $this->verConfiguracion();
    }
    


    public function modificarConfiguraciones($id){
        $configuraciones = new configuracionModel();
        $data["configuraciones"] = $configuraciones->get_Configuracion($id);
        $data["titulo"] = "Modificar Configuración";
        require_once(__DIR__ . '/../View/nutriologa/configuracion/modificarConfiguraciones.php');
    }
    
    public function actualizarConfiguraciones(){
        $id_configuracion = $_POST['id_configuracion'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $hora_inicio_manana = $_POST['hora_inicio_manana'];
        $hora_fin_manana = $_POST['hora_fin_manana'];
        $hora_inicio_tarde = $_POST['hora_inicio_tarde'];
        $hora_fin_tarde = $_POST['hora_fin_tarde'];
        $dias_semana_array = $_POST['dias_semana'];
        $duracion_cita = $_POST['duracion_cita'];
    
        // Convertir el array de días a una cadena separada por comas
        $dias_semana = implode(',', $dias_semana_array);
    
        $configuraciones = new configuracionModel();
        $configuraciones->modificar_Configuraciones($id_configuracion, $ci_nutriologa, $hora_inicio_manana, $hora_fin_manana, $hora_inicio_tarde, $hora_fin_tarde, $dias_semana, $duracion_cita);
        $data["titulo"] = "Configuraciones";
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