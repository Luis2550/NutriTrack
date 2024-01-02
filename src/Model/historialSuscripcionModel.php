<?php


class historialSuscripcionModel{
    private $db;
    private $historialSuscripcion;

    

    public function __construct(){
        $this->db = Conectar::conexion();
        $this->historialSuscripcion = array();
    }

    public function get_HistorialSuscripciones(){

        $sql = "SELECT * FROM historial_suscripcion";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->historialSuscripcion[] = $fila;
        }
        return $this->historialSuscripcion;
    }

    public function getCiPaciente() {
        $sql = "SELECT * FROM usuario";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
    //trae los datos segun el ci del paciente  
    public function getInformacionUsuario($ci_usuario) {
        $sql = "SELECT * FROM usuario WHERE ci_usuario = '$ci_usuario' LIMIT 1";
        $resultado = $this->db->query($sql);
        $usuario = $resultado->fetch_assoc();
        return $usuario;
    }
    /*public function get_nombre_paciente($ci_usuario){
        $sql = "SELECT u.nombres FROM usuario as u INNER JOIN historial_suscripcion as hs ON u.ci_usuario = hs.ci_paciente WHERE hs.ci_paciente = '2222222222' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['nombres']; 
    }*/
    public function getSuscripcion() {
        $sql = "SELECT id_suscripcion, suscripcion,duracion_dias FROM suscripcion";
        $resultado = $this->db->query($sql);

        $id_suscripcion = array();
    
        while ($fila = $resultado->fetch_assoc()) {
            $id_suscripcion[] = $fila;
        }

        return $id_suscripcion;
    }
    public function get_suscripcion_usuario($id_suscripcion){
        $sql = "SELECT s.id_suscripcion, s.suscripcion, s.duracion_dias
        FROM suscripcion AS s
        INNER JOIN usuario AS u ON s.id_suscripcion = u.id_suscripcion
        WHERE u.id_suscripcion = '$id_suscripcion'
        LIMIT 1";

        $result = $this->db->query($sql);
        $suscripcion = array();
    
        while ($fila = $result->fetch_assoc()) {
            $suscripcion[] = $fila;
        }

        return $suscripcion;
    }

    
        
    /*public function insertar_HistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado){
        $resultado = $this->db->query("INSERT INTO historial_suscripcion(id_suscripcion, ci_paciente, fecha_inicio, fecha_fin, estado) VALUES ('$id_suscripcion', '$ci_paciente', '$fecha_inicio', '$fecha_fin', '$estado')");
    }*/
    public function insertar_HistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado){
        $stmt = $this->db->prepare("INSERT INTO historial_suscripcion (id_suscripcion, ci_paciente, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado);
    
        if ($stmt->execute()) {
            echo "¡Historial Suscripción insertado correctamente!";
        } else {
            echo "Error al insertar historial: " . $stmt->error;
        }
    
        $stmt->close();
    }
    

    
    public function modificarHistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin, $estado){
			
        $resultado = $this->db->query("UPDATE historial_suscripcion
        SET id_suscripcion='$id_suscripcion', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', estado='$estado' WHERE ci_paciente='$ci_paciente'");			
    }

    public function get_HistorialSuscripcion($id)
    {
        $sql = "SELECT hs.*, u.nombres as usuario FROM historial_suscripcion hs JOIN usuario u ON hs.ci_paciente = u.ci_usuario WHERE hs.ci_usuario = '$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
        

    public function eliminarHistorialSuscripcion($id){
			
        $resultado = $this->db->query("DELETE FROM historial_suscripcion WHERE id_suscripcion = '$id'");
        
    }
   

}

?>