<?php


class UsuariosModel{
    private $db;
    private $usuarios;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function get_Usuarios(){

        $sql = "SELECT * FROM usuario";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->usuarios[] = $fila;
        }
        return $this->usuarios;
    }

    public function insertar_Usuarios($ci_usuario, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero){
        $resultado = $this->db->query("INSERT INTO usuario (ci_usuario, id_rol, nombres, apellidos, edad, correo, clave, sexo)
        VALUES ('$ci_usuario','1','$nombres', '$apellidos', '$edad', '$correo', '$contrasenia', '$genero')");
    }
    

    public function modificar_Usuarios($id, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero){
			
        $resultado = $this->db->query("UPDATE usuario 
        SET nombres='$nombres', apellidos='$apellidos', edad='$edad', correo='$correo', clave='$contrasenia', sexo = '$genero'  WHERE ci_usuario = '$id'");			
    }

    public function eliminar_Usuarios($id){

        // Eliminar registros de paciente relacionados con el usuario
        $this->db->query("DELETE FROM paciente WHERE ci_paciente = '$id'");

        // Eliminar el usuario después de haber eliminado los registros relacionados
        $resultado = $this->db->query("DELETE FROM usuario WHERE ci_usuario = '$id'");
        
    }
    
    public function get_Usuario($id)
    {
        $sql = "SELECT * FROM usuario WHERE ci_usuario='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
}

?>