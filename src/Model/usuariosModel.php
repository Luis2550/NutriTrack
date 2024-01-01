<?php

class UsuariosModel{
    private $db;
    private $usuarios;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function get_Usuarios(){
        $sql = "SELECT u.*, r.rol as rol FROM usuario u JOIN rol r ON u.id_rol = r.id_rol";
        $resultado = $this->db->query($sql);
        while($fila = $resultado->fetch_assoc()){
            $this->usuarios[] = $fila;
        }
        return $this->usuarios;
    }

    public function insertar_Usuarios($ci_usuario, $id_rol, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto){
        $resultado = $this->db->query("INSERT INTO usuario (ci_usuario, id_rol, nombres, apellidos, edad, correo, clave, sexo, foto)
        VALUES ('$ci_usuario','$id_rol','$nombres', '$apellidos', '$edad', '$correo', '$contrasenia', '$genero','$foto')");

        // Verificar si la inserción fue exitosa
        //if ($resultado) {
            // La inserción fue exitosa, ahora ejecutar el trigger
          //  $this->db->query("CALL tr_insertar_usuario");
        //}
    }
    
    public function get_clave_usuario($ci_usuario){
        $sql = "SELECT clave FROM usuario WHERE ci_usuario='$ci_usuario' LIMIT 1";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function comprobar_clave_usuario($ci_usuario, $clave){
        $clave_en_data_base = UsuariosModel::get_clave_usuario($ci_usuario);
        if(password_verify($clave,$clave_en_data_base))
            return true;
        else
            return false;
    }
    
    public function get_Roles(){
        $sql = "SELECT * FROM rol";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function modificar_Usuarios($id, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto){
			
        $resultado = $this->db->query("UPDATE usuario 
        SET nombres='$nombres', apellidos='$apellidos', edad='$edad', correo='$correo', clave='$contrasenia', sexo = '$genero', foto='$foto'  WHERE ci_usuario = '$id'");			
    }

    public function get_rol_usuario($id_rol){
        $sql = "SELECT rol FROM rol as r INNER JOIN usuario as u ON r.id_rol = u.id_rol WHERE u.id_rol = '$id_rol' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return $row['rol'];
    }

    public function eliminar_Usuarios($id){
        // Obtener el id_rol del usuario
        $sql = "SELECT id_rol FROM usuario WHERE ci_usuario='$id' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        $id_rol = $row['id_rol'];
    
        // Obtener el rol del usuario
        $sql2 = "SELECT rol FROM rol as r JOIN usuario as u ON r.id_rol = u.id_rol WHERE ci_usuario='$id'";
        $result2 = $this->db->query($sql2);
        $row2 = $result2->fetch_assoc();
        $rol = $row2['rol'];
    
        // Eliminar registros de paciente/nutriologa relacionados con el usuario
        if ($rol == "PACIENTE") {
            $this->db->query("DELETE FROM paciente WHERE ci_paciente = '$id'");
        } elseif ($rol == "NUTRIOLOGA") {
            $this->db->query("DELETE FROM nutriologa WHERE ci_nutriologa = '$id'");
        }
    
        // Eliminar el usuario después de haber eliminado los registros relacionados
        $this->db->query("DELETE FROM usuario WHERE ci_usuario = '$id'");
    }
    
    public function get_Usuario($id)
    {
        $sql = "SELECT u.*, r.rol as rol FROM usuario u JOIN rol r ON u.id_rol = r.id_rol where u.ci_usuario = '$id' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }

    
    
}

?>