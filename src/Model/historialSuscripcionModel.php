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
        $sql = "SELECT ci_paciente FROM paciente";
        $resultado = $this->db->query($sql);
        $ciPaciente = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPaciente[] = $fila['ci_paciente'];
        }

        return $ciPaciente;
    }

    public function getSuscripcion() {
        $sql = "SELECT id_suscripcion FROM suscripcion";
        $resultado = $this->db->query($sql);
        $id_Suscripcion = array();

        while ($fila = $resultado->fetch_assoc()) {
            $id_Suscripcion[] = $fila['id_suscripcion'];
        }

        return $id_Suscripcion;
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
        $sql = "SELECT * FROM historial_suscripcion WHERE id_suscripcion='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }

    public function eliminarHistorialSuscripcion($id){
			
        $resultado = $this->db->query("DELETE FROM historial_suscripcion WHERE id_suscripcion = '$id'");
        
    }

}

?>