<?php
class HorarioLaboralModel{
    private $db;
    private $horarioLaboral;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->horarioLaboral = array();
    }

    public function get_horario_laboral(){

        $sql = "SELECT * FROM horario_laboral";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->horarioLaboral[] = $fila;
        }
        return $this->horarioLaboral;
    }

    public function get_id_configuracion(){

        $sql = "SELECT id_configuracion FROM configuracion";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->horarioLaboral[] = $fila;
        }
        return $this->horarioLaboral;
    }

    public function insertar_horario_laboral($id_configuracion, $dia_inicio, $dia_fin, $descripcion, $hora_inicio, $hora_fin, $cantidad_horas_laborales) {
        $resultado = $this->db->query("INSERT INTO horario_laboral (id_horario_laboral, id_configuracion, dia_inicio, dia_fin, descripcion, hora_inicio, hora_fin, cantidad_horas_laborales)
        VALUES ('', '$id_configuracion', '$dia_inicio', '$dia_fin', '$descripcion', '$hora_inicio', '$hora_fin', '$cantidad_horas_laborales')");
    }

    public function get_horario_laboral_id($id_horario_laboral) {
        $sql = "SELECT * FROM horario_laboral WHERE id_horario_laboral='$id_horario_laboral' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
    
        return $fila;
    }

    public function modificar_horario_laboral($id_horario_laboral, $id_configuracion, $dia_inicio, $dia_fin, $descripcion, $hora_inicio, $hora_fin, $cantidad_horas_laborales) {
        $resultado = $this->db->query("UPDATE horario_laboral 
            SET id_configuracion='$id_configuracion', dia_inicio='$dia_inicio', dia_fin='$dia_fin', descripcion='$descripcion', hora_inicio='$hora_inicio', hora_fin='$hora_fin', cantidad_horas_laborales='$cantidad_horas_laborales'
            WHERE id_horario_laboral = '$id_horario_laboral'");
    }

    public function eliminar_horario_laboral($id){
        $this->db->query("DELETE FROM horario_laboral WHERE id_horario_laboral = '$id'");     
    }
}
?>