<?php

class HorarioLaboralController{

    public function __construct(){
        require_once __DIR__ . "/../Model/horarioLaboralModel.php";
    }

    public function verHorarioLaboral(){

        $horarioLaboral = new HorarioLaboralModel();
        $data['titulo'] = 'Horario Laboral';
        $data['horarioLaboral'] = $horarioLaboral->get_horario_laboral();

        require_once(__DIR__ . '/../View/HorarioLaboral/verHorarioLaboral.php');
    }

    public function nuevoHorarioLaboral(){

        $horarioLaboral = new HorarioLaboralModel();
        $data['titulo'] = 'Nuevo Horario Laboral';
        $data['horarioLaboral'] = $horarioLaboral->get_id_configuracion();
        require_once(__DIR__ . '/../View/HorarioLaboral/nuevoHorarioLaboral.php');
    }


    public function guardarHorarioLaboral() {
        try {
            $id_configuracion = $_POST['id_configuracion'];
            $dia_inicio = $_POST['dia_inicio'];
            $dia_fin = $_POST['dia_fin'];
            $descripcion = $_POST['descripcion'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $cantidad_horas_laborales = $_POST['cantidad_horas_laborales'];
    
            $horarioLaboral = new HorarioLaboralModel();
            $horarioLaboral->insertar_horario_laboral($id_configuracion, $dia_inicio, $dia_fin, $descripcion, $hora_inicio, $hora_fin, $cantidad_horas_laborales);
    
            $data["titulo"] = "Nuevo Horario Laboral";
            $this->verHorarioLaboral();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                // Código 1062: Entrada duplicada para una clave única
                echo "Ya existe su horario laboral. Puede modificarlo.";
            } else {
                // Otra excepción SQL
                echo "Error en la base de datos: " . $e->getMessage();
            }
        } catch (Exception $e) {
            // Capturar otras excepciones no relacionadas con la base de datos
            echo "Error: " . $e->getMessage();
        }
    }

    public function modificarHorarioLaboral($id){
			
        $horarioLaboral = new HorarioLaboralModel();
        
        $data["id_horario_laboral"] = $id;
        $data["horarioLaboral"] = $horarioLaboral->get_horario_laboral_id($id);
        $data["titulo"] = "Horario Laboral por ID";
        require_once(__DIR__ . '/../View/HorarioLaboral/modificarHorarioLaboral.php');
    }


    public function actualizarHorarioLaboral(){
        $id_horario_laboral = $_POST['id_horario_laboral'];
        $id_configuracion = $_POST['id_configuracion'];
        $dia_inicio = $_POST['dia_inicio'];
        $dia_fin = $_POST['dia_fin'];
        $descripcion = $_POST['descripcion'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];
        $cantidad_horas_laborales = $_POST['cantidad_horas_laborales'];

        $horarioLaboral = new HorarioLaboralModel();
        $horarioLaboral->modificar_horario_laboral($id_horario_laboral,$id_configuracion,$dia_inicio,$dia_fin, $descripcion, $hora_inicio, $hora_fin, $cantidad_horas_laborales);
        $data["titulo"] = "Horario Laboral";
        $this->verHorarioLaboral();
    }

    public function eliminarHorarioLaboral($id){
        
        $horarioLaboral = new HorarioLaboralModel();
        $horarioLaboral->eliminar_horario_laboral($id);
        $data["titulo"] = "Eliminar Horario Laboral";
        $this->verHorarioLaboral();
    }
}
?>