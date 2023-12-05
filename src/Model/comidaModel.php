<?php
class ComidaModel{
    private $db;
    private $comida;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->comida = array();
    }

    public function get_comida(){

        $sql = "SELECT * FROM comida";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->comida[] = $fila;
        }
        return $this->comida;
    }

    public function insertar_comida($com, $numero_comidas, $dia, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables) {
        $resultado = $this->db->query("INSERT INTO comida (id_comida, comida, numero_comidas, dia, descripcion, cantidad_proteina, cantidad_carbohidratos, cantidad_grasas_saludables)
        VALUES ('', '$com', '$numero_comidas', '$dia', '$descripcion', '$cantidad_proteina', '$cantidad_carbohidratos', '$cantidad_grasas_saludables')");
    }

    public function get_comida_id($id_comida) {
        $sql = "SELECT * FROM comida WHERE id_comida='$id_comida' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
    
        return $fila;
    }

    public function modificar_comida($id_comida,$comida,$numero_comidas,$dia, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables) {
        $resultado = $this->db->query("UPDATE comida 
            SET comida='$comida', numero_comidas='$numero_comidas', dia='$dia', descripcion='$descripcion', cantidad_proteina='$cantidad_proteina', cantidad_carbohidratos='$cantidad_carbohidratos', cantidad_grasas_saludables='$cantidad_grasas_saludables'
            WHERE id_comida = '$id_comida'");
    }

    public function eliminar_comida($id){
        $this->db->query("DELETE FROM comida WHERE id_comida = '$id'");     
    }
}
?>