<?php


class nutriologaModel{
    private $db;
    private $nutri;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->nutri = array();
    }

    public function get_nutriologas(){

        $sql = "SELECT * FROM nutriologa";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->nutri[] = $fila;
        }
        return $this->nutri;
    }

    public function insertar_nutriologa($ci_nutriologa,$cantidad_cupos,$certificacion){
        $resultado = $this->db->query("INSERT INTO nutriologa(ci_nutriologa,cantidad_cupos,certificacion) VALUES ('$ci_nutriologa', '$cantidad_cupos', '$certificacion')");

    }

    //aqui poner el get Ci historial clinico
    public function getCIusuario() {
        $sql = "SELECT ci_usuario FROM usuario";
        $resultado = $this->db->query($sql);
        $ciUsu = array();

        while ($fila = $resultado->fetch_assoc()) {
            $ciUsu[] = $fila['ci_usuario'];
        }

        return $ciUsu;
    }
    public function modificar_nutriologa($id,$cantidad_cupos,$certificacion){
			
        $resultado = $this->db->query("UPDATE nutriologa
        SET  cantidad_cupos='$cantidad_cupos', certificacion='$certificacion' WHERE ci_nutriologa = '$id'");			
    }

    public function eliminar_nutriologa($id){
			
        $resultado = $this->db->query("DELETE FROM nutriologa WHERE ci_nutriologa = '$id'");
        
    }
    
    
    public function get_nutriologa($id)
    {
        

        $stmt = $this->db->prepare("SELECT * FROM nutriologa WHERE ci_nutriologa = ?");
        
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $id);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
    
            if ($resultado) {
                $fila = $resultado->fetch_assoc();
                $stmt->close();
                return $fila;
            } else {
                // Manejo del error al obtener el resultado.
                // Puedes agregar un mensaje de registro o lanzar una excepción según tus necesidades.
                $stmt->close();
                return null;
            }
        } else {
            // Manejo del error en la preparación de la
     }
    }
}

?>