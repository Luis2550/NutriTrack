<?php


class PacientesModel{
    private $db;
    private $pacientes;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->pacientes = array();
    }

    public function get_Pacientes(){

        $sql = "SELECT * FROM paciente";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->pacientes[] = $fila;
        }
        return $this->pacientes;
    }

    public function insertar_Pacientes($ci_paciente, $id_suscripcion){
        $resultado = $this->db->query("INSERT INTO paciente(ci_paciente, id_suscripcion) VALUES ('$ci_paciente', '$id_suscripcion')");

    }

    public function traer_Usuarios(){
        $cedulas = $this->db->query("SELECT * FROM usuario");
        $usuarios;
        while($fila = $cedulas->fetch_assoc()){
            $this->usuarios[] = $fila;
        }
        return $this->usuarios;
    }

    public function modificar_Pacientes($ci_paciente, $id_suscripcion){
			
        $resultado = $this->db->query("UPDATE paciente
        SET ci_paciente='$ci_paciente', id_suscripcion='$id_suscripcion' WHERE ci_paciente = '$ci_paciente'");			
    }

    public function eliminar_Pacientes($id){
			
        $resultado = $this->db->query("DELETE FROM paciente WHERE ci_paciente = '$id'");
        
    }
    
    public function getCiUsuario() {
        $sql = "SELECT ci_usuario FROM usuario";
        $resultado = $this->db->query($sql);
        $ciUsuario = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciUsuario[] = $fila['ci_usuario'];
        }

        return $ciUsuario;
    }

    public function get_Paciente($id)
    {
        $sql = "SELECT * FROM paciente WHERE ci_paciente='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
}

?>