<?php

class sesionModel {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function obtenerUsuarioPorCredenciales($username, $password) {
        $consulta = "SELECT * FROM usuario WHERE correo = ? AND clave = ?";
        $stmt = $this->db->prepare($consulta);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        return $usuario;
    }

    public function obtenerRolUsuario($idRol) {
        $consulta = "SELECT * FROM rol WHERE id_rol = ?";
        $stmt = $this->db->prepare($consulta);
        $stmt->bind_param("i", $idRol);
        $stmt->execute();
        $result = $stmt->get_result();
        $rol = $result->fetch_assoc();
        $stmt->close();

        return $rol;
    }
}
?>
