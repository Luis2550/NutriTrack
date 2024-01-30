<?php

class sesionModel {
    private $db;

    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function obtenerUsuarioPorCredenciales($correo) {
        $consulta = "SELECT * FROM usuario WHERE correo = ?";
        $stmt = $this->db->prepare($consulta);
        $stmt->bind_param("s", $correo);  // Solo hay un parámetro, de tipo cadena ("s")
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Verifica si la consulta fue exitosa antes de intentar obtener resultados
        if ($result !== false) {
            $usuario = $result->fetch_assoc();
            $stmt->close();
            return $usuario;
        } else {
            // Maneja el error de la consulta
            echo "Error en la consulta SQL: " . $this->db->error;
            return null;
        }
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
