<?php
class CalendarioCitasModel{
    private $db;
    private $calendarioCitas;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->calendarioCitas = array();
    }

    public function get_calendarioCitas(){

        $sql = "SELECT * FROM calendario_citas";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->calendarioCitas[] = $fila;
        }
        return $this->calendarioCitas;
    }

    public function get_ci_paciente_nombres_apellidos(){

        $sql = "SELECT p.ci_paciente, u.nombres, u.apellidos FROM paciente as p
        inner join usuario as u on u.ci_usuario = p.ci_paciente";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->calendarioCitas[] = $fila;
        }
        return $this->calendarioCitas;
    }

    public function get_ci_nutriologa_nombres_apellidos(){

        $sql = "SELECT n.ci_nutriologa, u.nombres, u.apellidos FROM nutriologa as n
        inner join usuario as u on u.ci_usuario = n.ci_nutriologa";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->calendarioCitas[] = $fila;
        }
        return $this->calendarioCitas;
    }

    public function get_hora_fin_Configuracion(){
        $resultado = $this->db->query("SELECT duracion_cita FROM configuracion WHERE id_configuracion = 1");
        return $resultado;
    }

    public function insertar_Calendario_Citas($ci_paciente, $ci_nutriologa, $fecha, $hora_inicio,$hora_fin){ 
        $resultado = $this->db->query("INSERT INTO calendario_citas (id_calendario_citas, ci_paciente, ci_nutriologa, fecha, hora_inicio, hora_fin, estado)
        VALUES ('','$ci_paciente','$ci_nutriologa','$fecha', '$hora_inicio', '$hora_fin', 'NO DISPONIBLE')");
    }

    public function modificar_Calendario_Citas($id_calendario_citas, $ci_paciente, $ci_nutriologa, $fecha, $hora_inicio, $hora_fin, $estado) {
        $resultado = $this->db->query("UPDATE calendario_citas 
            SET ci_paciente='$ci_paciente', ci_nutriologa='$ci_nutriologa', fecha='$fecha', hora_inicio='$hora_inicio', hora_fin='$hora_fin', estado='$estado'
            WHERE id_calendario_citas = '$id_calendario_citas'");
    }

    public function get_Calendario_Citas($id)
    {
        $sql = "SELECT * FROM calendario_citas WHERE id_calendario_citas='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
    
    public function eliminar_Calendario_Citas($id){
        $this->db->query("DELETE FROM calendario_citas WHERE id_calendario_citas = '$id'");     
    }
}
?>