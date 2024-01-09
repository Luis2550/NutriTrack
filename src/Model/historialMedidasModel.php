<?php


class historialMedidasModel{
    private $db;
    private $historiaMedi;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->historiaMedi = array();
    }

    public function get_HistoriasMedidas(){
        $sql = "SELECT hm.*, u.ci_usuario, u.nombres, u.apellidos
                FROM historial_medidas hm
                JOIN historial_clinico hc ON hm.id_historial_clinico = hc.id_historial_clinico
                JOIN usuario u ON hc.ci_paciente = u.ci_usuario
                ORDER BY hm.id_historial_clinico";
    
        $resultado = $this->db->query($sql);
    
        while($fila = $resultado->fetch_assoc()){
            $this->historiaMedi[] = $fila;
        }
    
        return $this->historiaMedi;
    }
    

    public function insertar_historialMedidas($id_historial_clinico,$peso,$estatura,$presion_s,$presion_d,$fecha){
        $resultado = $this->db->query("INSERT INTO historial_medidas(id_historial_clinico,peso,estatura,presion_arterial_sistolica,presion_arterial_diastolica,fecha) VALUES ('$id_historial_clinico', '$peso', '$estatura', '$presion_s', '$presion_d', '$fecha')");

    }

    //aqui poner el get Ci historial clinico
    public function getCIHistoriaClinica() {
        $sql = "SELECT
        hc.id_historial_clinico,
        CONCAT(u.nombres, ' ', u.apellidos) AS nombre_completo
    FROM
        historial_clinico hc
    JOIN
        usuario u ON hc.ci_paciente = u.ci_usuario;
    ";
        $resultado = $this->db->query($sql);
        $ciHistoriaClinica = array();
    
        while ($fila = $resultado->fetch_assoc()) {
            $ciHistoriaClinica[] = $fila;
        }
    
        return $ciHistoriaClinica;
    }
    


    public function modificar_historialMedidas($id,$id_historial_clinico,$peso,$estatura,$presion_s,$presion_d,$fecha){
			
        $resultado = $this->db->query("UPDATE historial_medidas
        SET id_historial_clinico='$id_historial_clinico', peso='$peso', estatura='$estatura', presion_arterial_sistolica='$presion_s', presion_arterial_diastolica='$presion_d', fecha='$fecha' WHERE id_historial_medidas = '$id'");			
    }

    public function eliminar_historialMedidas($id){
			
        $resultado = $this->db->query("DELETE FROM historial_medidas WHERE id_historial_medidas = '$id'");
        
    }
    
    
    public function get_historialMedidas($id)
    {
        

        $stmt = $this->db->prepare("SELECT * FROM historial_medidas WHERE id_historial_medidas = ?");
        
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

    public function get_historialMedidasPaciente($ci_paciente) {
        $stmt = $this->db->prepare("SELECT 
            hm.*
        FROM 
            historial_medidas hm
        JOIN 
            historial_clinico hc ON hm.id_historial_clinico = hc.id_historial_clinico
        JOIN 
            usuario u ON hc.ci_paciente = u.ci_usuario
        WHERE 
            hc.ci_paciente = ?");
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $ci_paciente);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            $filas = $resultado->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
    
            return $filas;
        } else {
            // Manejo del error en la preparación de la consulta
            return null;
        }
    }
    
    
}

?>