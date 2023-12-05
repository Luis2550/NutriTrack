<?php


class RolModel{
    private $db;
    private $rol;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->rol = array();
    }

    public function get_Roles(){

        $sql = "SELECT * FROM rol";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->rol[] = $fila;
        }
        return $this->rol;
    }

    public function insertar_Rol($roldato, $descripcion){
        $resultado = $this->db->query("INSERT INTO rol (rol, descripcion)
        VALUES ('$roldato','$descripcion')");
    }


    public function modificar_Rol($id_rol, $roldato, $descripcion){
			
        $resultado = $this->db->query("UPDATE rol 
        SET rol='$roldato', descripcion='$descripcion' WHERE id_rol = '$id_rol'");			
    }

    public function eliminar_Rol($id_rol){

        $resultado = $this->db->query("DELETE FROM rol WHERE id_rol = '$id_rol'");

    }
    
    public function get_Rol($id_rol)
    {
        $sql = "SELECT * FROM rol WHERE id_rol='$id_rol' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
}

?>