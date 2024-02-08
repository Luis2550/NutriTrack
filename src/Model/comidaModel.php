<?php
class ComidaModel{
    private $db;
    private $comida;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->comida = array();
    }

    public function get_comida(){

        $sql = "SELECT c.*, tp.tipo_comida FROM comida AS c JOIN tipo_comida AS tp ON c.id_tipo_comida = tp.id_tipo_comida";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->comida[] = $fila;
        }
        return $this->comida;
    }

    public function get_tipos_comida(){

        $sql = "SELECT * FROM tipo_comida";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->comida[] = $fila;
        }
        return $this->comida;
    }

    public function insertar_comida($com, $id_tipo_comida, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables) {
        $resultado = $this->db->query("INSERT INTO comida (id_comida, comida, id_tipo_comida, descripcion, cantidad_proteina, cantidad_carbohidratos, cantidad_grasas_saludables)
        VALUES ('', '$com', '$id_tipo_comida', '$descripcion', '$cantidad_proteina', '$cantidad_carbohidratos', '$cantidad_grasas_saludables')");
    }

    public function get_comida_id($id_comida) {
        $sql = "SELECT * FROM comida WHERE id_comida='$id_comida' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
    
        return $fila;
    }
    
    public function get_hayComidasAsignadas($id){
        $sql = "SELECT * FROM detalle_comida WHERE id_comida = '$id'";
        $resultado = $this->db->query($sql);

        // Verifica si hay al menos una fila en el resultado
        if ($resultado && $resultado->num_rows > 0)
            return true;    // Existe al menos una fila, retorna true
        else
            return false;   // No hay filas en el resultado, retorna false
    }

    public function modificar_comida($id_comida,$comida,$id_tipo_comida, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables) {
        $resultado = $this->db->query("UPDATE comida 
            SET comida='$comida', id_tipo_comida='$id_tipo_comida', descripcion='$descripcion', cantidad_proteina='$cantidad_proteina', cantidad_carbohidratos='$cantidad_carbohidratos', cantidad_grasas_saludables='$cantidad_grasas_saludables'
            WHERE id_comida = '$id_comida'");
    }

    public function eliminar_comida($id){
        $this->db->query("DELETE FROM comida WHERE id_comida = '$id'");     
    }
}
?>