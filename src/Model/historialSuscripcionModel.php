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
        $sql = "SELECT * FROM suscripcion";
        $resultado = $this->db->query($sql);

        return $resultado;
    }
    public function get_suscripcion_usuario($id_suscripcion){
        $sql = "SELECT suscripcion FROM suscripcion as s INNER JOIN usuario as u ON s.id_suscripcion = u.id_suscripcion WHERE u.id_suscripcion = '$id_suscripcion' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['suscripcion'];
    }
    

    public function calcula_fecha_fin($id_suscripcion, $fecha_inicio)
    {
        $sql = "SELECT duracion_dias FROM suscripcion WHERE id_suscripcion = '$id_suscripcion' LIMIT 1";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $duracion_dias = $row['duracion_dias'];

            if ($duracion_dias !== null && is_numeric($duracion_dias)) {
                // Calcular la fecha de finalización
                $fecha_inicio_obj = new DateTime($fecha_inicio);
                $fecha_fin_obj = clone $fecha_inicio_obj; // Clonar para no modificar la fecha de inicio original
                $fecha_fin_obj->modify("+{$duracion_dias} days");

                return $fecha_fin_obj->format('Y-m-d'); // Puedes ajustar el formato según tus necesidades
            }
        }

        return null; // o un valor predeterminado, dependiendo de tus necesidades
    }
        
    public function insertar_HistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin){
        $resultado = $this->db->query("INSERT INTO historial_suscripcion(id_suscripcion, ci_paciente, fecha_inicio, fecha_fin) VALUES ('$id_suscripcion', '$ci_paciente', '$fecha_inicio', '$fecha_fin')");
    }

    
    public function modificarHistorialSuscripcion($id_suscripcion, $ci_paciente, $fecha_inicio, $fecha_fin){
			
        $resultado = $this->db->query("UPDATE historial_suscripcion
        SET id_suscripcion='$id_suscripcion', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin' WHERE ci_paciente='$ci_paciente'");			
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