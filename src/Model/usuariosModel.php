<?php


class UsuariosModel{
    private $db;
    private $usuarios;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function get_Usuarios(){

        $sql = "SELECT * FROM usuarios";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->usuarios[] = $fila;
        }
        return $this->usuarios;
    }

    public function insertar_Usuarios($nombres, $apellidos, $edad, $correo, $contrasenia){
        $resultado = $this->db->query("INSERT INTO usuarios (nombres, apellidos, edad, correo, contrasenia)
        VALUES ('$nombres', '$apellidos', '$edad', '$correo', '$contrasenia')");
    }

    public function modificar_Usuarios($id, $nombres, $apellidos, $edad, $correo, $contrasenia){
			
        $resultado = $this->db->query("UPDATE usuarios 
        SET nombres='$nombres', apellidos='$apellidos', edad='$edad', correo='$correo', contrasenia='$contrasenia' WHERE id = '$id'");			
    }

    public function eliminar_Usuarios($id){
			
        $resultado = $this->db->query("DELETE FROM usuarios WHERE id = '$id'");
        
    }
    
    public function get_Usuario($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id='$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
}

?>