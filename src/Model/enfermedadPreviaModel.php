<?php


class enfermedadPreviaModel{
    private $db;
    private $enfermedadesprev;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->enfermedadesprev = array();
    }

    public function get_EnfermedadPrevia(){

        $sql = "SELECT * FROM enfermedad_previa";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->enfermedadesprev[] = $fila;
        }
        return $this->enfermedadesprev;
    }



    public function insertar_EnfermedadPrevia($id_historial_clinico, $enfermedad_previa, $descripcion, $fecha){
        $resultado = $this->db->query("INSERT INTO enfermedad_previa(id_historial_clinico, enfermedad_previa, descripcion, fecha) VALUES ( '$id_historial_clinico', '$enfermedad_previa', '$descripcion','$fecha')");

    }


    public function getCIPacientes() {
        $sql = "SELECT id_historial_clinico FROM historial_clinico";
        $resultado = $this->db->query($sql);
        $ciPacientes = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciPacientes[] = $fila['id_historial_clinico'];
        }

        return $ciPacientes;
    }



    public function modificar_EnfermedadPrevia($id_enfermedad_previa, $enfermedad_previa, $descripcion, $fecha){
			
        $resultado = $this->db->query("UPDATE enfermedad_previa
        SET enfermedad_previa = '$enfermedad_previa', descripcion='$descripcion', fecha='$fecha' WHERE  id_enfermedad_previa='$id_enfermedad_previa'");			
    }

    public function eliminarEnfermedadPrevia($id){
			
        $resultado = $this->db->query("DELETE FROM enfermedad_previa WHERE id_enfermedad_previa = '$id'");
        
    }
   
/*
    public function getCiUsuario() {
        $sql = "SELECT ci_usuario FROM usuario";
        $resultado = $this->db->query($sql);
        $ciUsuario = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciUsuario[] = $fila['ci_usuario'];
        }

        return $ciUsuario;
    }

*/

    public function get_Paciente($id)
    {
        $sql = "SELECT * FROM enfermedad_previa WHERE id_enfermedad_previa ='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }

    
}

?>