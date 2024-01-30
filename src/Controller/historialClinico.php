<?php

class historialClinicoController{

    public function __construct(){
        require_once __DIR__ . "/../Model/historialClinicoModel.php";
    }

    public function verHistorialClinico(){
        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_HistoriasClinicas();
    
        // Pasa los datos a la vista
        require_once(__DIR__ . '/../View/nutriologa/historialClinico/verHistorialClinico.php');
    }
    

    public function verHistorialClinicoSecuencial(){
        // Obtén el valor de 'ci_usuario' de la URL
        $ci_usuario = isset($_GET['ci_usuario']) ? $_GET['ci_usuario'] : null;
    
        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_HistoriasClinicas();
    
        // Pasa el valor de 'ci_usuario' a la vista
        $data['ci_usuario'] = $ci_usuario;
    
        // Pasa los datos a la vista
        require_once(__DIR__ . '/../View/nutriologa/historialClinico/verHistorialClinicoSecuencial.php');
    }
    

    public function verHistorialClinicoPaciente($ci_paciente) {
        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_historialClinicoPaciente($ci_paciente);
    
        if ($data['historial_clinico']['fecha_creacion'] === null) {
            echo "Usted aún no tiene un historial clínico asignado.";
        } else {
            // Pasa los datos a la vista
            require_once(__DIR__ . '/../View/pacientes/historialClinico/verHistorialPaciente.php');
        }
    }
    
    

    public function modificarHistorialClinico($id) {
        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_historialClinico($id);
        
        if ($data['historial_clinico']['fecha_creacion'] == null) {
            echo "No puede modificar ya que no tiene datos";
        } else {
            // Pasa los datos a la vista
            require_once(__DIR__ . '/../View/nutriologa/historialClinico/modificarHistorialClinico.php');
        }
         
    }

    public function asignarHistorialClinico($id) {
        $historiaClini = new historialClinicoModel();
        $data['titulo'] = 'historial_clinico';
        $data['historial_clinico'] = $historiaClini->get_historialClinico($id);
        
        if ($data['historial_clinico']['fecha_creacion'] != null) {
            echo "Este paciente ya tiene un historial clinico";
        } else {
            // Pasa los datos a la vista
            require_once(__DIR__ . '/../View/nutriologa/historialClinico/modificarHistorialClinico.php');
        }
         
    }
    
    public function actualizarHistorialClinico() {

       
        $id = $_POST['id_historial_clinico'];
        $fecha_creacion = date("Y-m-d");

        // Datos del formulario
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $peso = $_POST['peso'];
        $porcentajeGrasa = $_POST['porcentajeGrasa'];
        $talla = $_POST['talla'];
        $ocupacion = $_POST['ocupacion'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $neuro = $_POST['neuro'];
        $hemoglobina = $_POST['hemoglobina'];
        $gastro = $_POST['gastro'];
        $respiratorias = $_POST['respiratorias'];
        $cronicas = $_POST['cronicas'];
        $endocrinos = $_POST['endocrinos'];
        $cirugias = $_POST['cirugias'];
        $alergias = $_POST['alergias'];
        $hipertension = $_POST['hipertension'];
        $motivoConsulta = $_POST['motivoConsulta'];
        $discapacidad = $_POST['discapacidad'];
        $tipoDiscapacidad = $_POST['tipoDiscapacidad'];
        $entrenamiento = $_POST['entrenamiento'];
        $tiempoEntrenamiento = $_POST['tiempoEntrenamiento'];
        $alcohol = $_POST['alcohol'];
        $cafe = $_POST['cafe'];
        $medicamentosHabituales = $_POST['medicamentosHabituales'];
        $observaciones = $_POST['observaciones'];
        $observaciones_g = $_POST['observaciones-g'];

        // Insertar en historial_clinico
        $historiaClini = new historialClinicoModel();
        $historiaClini->modificar_historialClinico($id,$fecha_creacion, $fechaNacimiento, $peso, $porcentajeGrasa, $talla,
            $ocupacion, $celular, $direccion, $neuro, $hemoglobina, $gastro, $respiratorias,
            $cronicas, $endocrinos, $cirugias, $alergias, $hipertension, $motivoConsulta,
            $discapacidad, $tipoDiscapacidad, $entrenamiento, $tiempoEntrenamiento, $alcohol,
            $cafe, $medicamentosHabituales, $observaciones, $observaciones_g
        );

        $ci_usuario_model = new historialClinicoModel();
        $ci_usuario = $ci_usuario_model->buscarUsuario($id);
    

        // Redireccionar o realizar alguna acción adicional
        $data["titulo"] = "historial_clinico";
        header('Location: http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinicoSecuencial&ci_usuario='. $ci_usuario['ci_paciente']);
        exit();
    }


    public function verHistorialPaciente($id){
			
        $historiaClini = new historialClinicoModel();
        $data["id_historial_clinico"] = $id;
        $data["historial_clinico"] = $historiaClini->get_historialClinico($id);
        $data["titulo"] = "historial_clinico";
        

        if ($data['historial_clinico']['fecha_creacion'] === null) {
            echo "Aún no se asigna un historial clínico a este paciente.";
        } else {
            // Pasa los datos a la vista
            require_once(__DIR__ . '/../View/nutriologa/historialClinico/verHistorialPaciente.php');
        }
    }

    
    
    public function eliminarHistorialClinico($id){
        
        $historiaClini = new historialClinicoModel();
        $historiaClini->eliminar_historialClinico($id);
        $data["titulo"] = "historial_clinico";
        $this->verHistorialClinico();
    }

    
}

?>