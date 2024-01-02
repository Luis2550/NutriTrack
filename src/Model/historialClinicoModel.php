<?php


class historialClinicoModel{
    private $db;
    private $historiaClini;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->historiaClini = array();
    }

    public function get_HistoriasClinicas(){
        $sql = "SELECT * FROM historial_clinico";
        $resultado = $this->db->query($sql);
    
        // Obtén los datos como un array asociativo
        $historiasClinicas = $resultado->fetch_all(MYSQLI_ASSOC);
    
        return $historiasClinicas;
    }
    

    //aqui poner el get Ci paciente
    public function getCIPacientes() {
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila['ci_paciente'];
        }

        return $ciPacientes;
    }
    
    public function modificar_historialClinico($id, $fecha_creacion, $fechaNacimiento, $peso, $porcentajeGrasa, $talla,
        $ocupacion, $celular, $direccion, $neuro, $hemoglobina, $gastro, $respiratorias,
        $cronicas, $endocrinos, $cirugias, $alergias, $hipertension, $motivoConsulta,
        $discapacidad, $tipoDiscapacidad, $entrenamiento, $tiempoEntrenamiento, $alcohol,
        $cafe, $medicamentosHabituales, $observaciones, $observaciones_g
    ) {
    $query = "UPDATE historial_clinico SET  
        fecha_creacion = '$fecha_creacion', 
        fechaNacimiento = '$fechaNacimiento', 
        peso = '$peso', 
        porcentajeGrasa = '$porcentajeGrasa', 
        talla = '$talla',
        ocupacion = '$ocupacion', 
        celular = '$celular', 
        direccion = '$direccion', 
        neuro = '$neuro', 
        hemoglobina = '$hemoglobina', 
        gastro = '$gastro', 
        respiratorias = '$respiratorias',
        cronicas = '$cronicas', 
        endocrinos = '$endocrinos', 
        cirugias = '$cirugias', 
        alergias = '$alergias', 
        hipertension = '$hipertension', 
        motivoConsulta = '$motivoConsulta',
        discapacidad = '$discapacidad', 
        tipoDiscapacidad = '$tipoDiscapacidad', 
        entrenamiento = '$entrenamiento', 
        tiempoEntrenamiento = '$tiempoEntrenamiento', 
        alcohol = '$alcohol',
        cafe = '$cafe', 
        medicamentosHabituales = '$medicamentosHabituales', 
        observacionesSalud = '$observaciones', 
        observacionesGenerales = '$observaciones_g'
        WHERE id_historial_clinico = '$id'";

    $resultado = $this->db->query($query);

    // Manejo de errores o retornar el resultado según sea necesario
}


    public function eliminar_historialClinico($id){
			
        $resultado = $this->db->query("DELETE FROM historial_clinico WHERE id_historial_clinico = '$id'");
        
    }
    
    
    public function get_historialClinico($id)
    {
        

        $stmt = $this->db->prepare("SELECT * FROM historial_clinico WHERE id_historial_clinico = ?");
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $id);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
    
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                $stmt->close();
                return $fila;
            } else {
                // Manejo del error al obtener el resultado.
                // Puedes agregar un mensaje de registro o lanzar una excepción según tus necesidades.
                $stmt->close();
                return null;
            }
        } else {
            // Manejo del error en la preparación de la
     }
    }

    public function get_historialClinicoPaciente($ci_paciente) {
        $stmt = $this->db->prepare("SELECT * FROM historial_clinico WHERE ci_paciente = ?");
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $ci_paciente);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
    
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                $stmt->close();
                return $fila;
            } else {
                // Manejo del error al obtener el resultado.
                // Puedes agregar un mensaje de registro o lanzar una excepción según tus necesidades.
                $stmt->close();
                return null;
            }
        } else {
            // Manejo del error en la preparación de la consulta
        }
    }
    
}

?>