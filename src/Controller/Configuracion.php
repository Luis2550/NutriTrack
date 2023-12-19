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
        $data['opciones_nutriologa'] = $configuraciones->getNombreNutriologa();
        $data['titulo'] = 'Configuraciones';
        require_once(__DIR__ . '/../View/configuracion/nuevoConfiguraciones.php');
    }
								
    public function guardarConfiguraciones(){
        //id_configuracion	ci_nutriologa	dias_laborales	duracion_cita	dia_inicio	dia_fin	descripcion	hora_inicio	hora_fin	hora_descanso_inicio	hora_descanso_fin	cantidad_horas_laborales       
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $dias_laborales = $_POST['dias_laborales'];
        $duracion_cita = $_POST['duracion_cita'];
        $dia_inicio = $_POST['dia_inicio'];
        $dia_fin = $_POST['dia_fin'];
        $descripcion = mb_strtoupper($_POST['descripcion'], 'UTF-8');
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $hora_descanso_inicio = $_POST['hora_descanso_inicio'];
        $hora_descanso_fin = $_POST['hora_descanso_fin'];
        $cantidad_horas_laborales = $_POST['cantidad_horas_laborales'];

        $configuraciones = new configuracionModel();
        $configuraciones->insertar_Configuraciones($ci_nutriologa, $dias_laborales, $duracion_cita, $dia_inicio, $dia_fin, $descripcion, $hora_inicio, $hora_fin, $hora_descanso_inicio, $hora_descanso_fin, $cantidad_horas_laborales);
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
        $dia_inicio = $_POST['dia_inicio'];
        $dia_fin = $_POST['dia_fin'];
        $descripcion = mb_strtoupper($_POST['descripcion'], 'UTF-8');
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $hora_descanso_inicio = $_POST['hora_descanso_inicio'];
        $hora_descanso_fin = $_POST['hora_descanso_fin'];
        $cantidad_horas_laborales = $_POST['cantidad_horas_laborales'];
        
        $configuraciones = new configuracionModel();
        $configuraciones->modificar_Configuraciones($id_configuracion, $ci_nutriologa, $dias_laborales, $duracion_cita, $dia_inicio, $dia_fin, $descripcion, $hora_inicio, $hora_fin, $hora_descanso_inicio, $hora_descanso_fin, $cantidad_horas_laborales);
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