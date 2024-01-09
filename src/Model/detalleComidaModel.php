<?php


class DetalleComidaModel{
    private $db;
    private $detalle_comida;


    public function __construct(){
        $this->db = Conectar::conexion();
        $this->detalle_comida = array();
    }

    public function get_DetalleComidas(){

        $sql = "SELECT dcpn.*, c.comida, pn.ci_nutriologa, pn.ci_paciente
        FROM detalle_comida_plan_nutricional dcpn
        JOIN comida c ON dcpn.id_comida = c.id_comida
        JOIN plan_nutricional pn ON dcpn.id_plan_nutricional = pn.id_plan_nutricional";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }

    public function insertarComidaPlanNutricional($idComida, $idPlanNutricional, $diaActual) {
        try {
            // Preparar la sentencia SQL
            $stmt = $this->db->prepare("INSERT INTO detalle_comida (id_comida, id_plan_nutricional, dia) VALUES (?, ?, ?)");
    
            // Vincular parámetros
            $dia = mb_strtoupper($diaActual, 'UTF-8');
            $stmt->bind_param("iss", $idComida, $idPlanNutricional, $dia);
    
            // Ejecutar la sentencia
            $stmt->execute();
    
            // Verificar si se insertaron filas
            if ($stmt->affected_rows > 0) {
                // Inserción exitosa
                return true;
            } else {
                // No se insertaron filas (puede deberse a una violación de clave foránea, etc.)
                return false;
            }
        } catch (Exception $e) {
            // Capturar cualquier excepción y manejarla según tus necesidades
            // Puedes registrar el error, imprimir un mensaje, etc.
            echo "Error al insertar en la base de datos: " . $e->getMessage();
            return false;
        } finally {
            // Cerrar la declaración
            $stmt->close();
        }
    }

    public function getHayComidasPlanNutricional($id_plan_nutricional){
        $sql = "SELECT * FROM detalle_comida WHERE id_plan_nutricional = '$id_plan_nutricional'";
        $resultado = $this->db->query($sql);

        // Verifica si hay al menos una fila en el resultado
        if ($resultado && $resultado->num_rows > 0)
            return true;    // Existe al menos una fila, retorna true
        else
            return false;   // No hay filas en el resultado, retorna false
    }
    
    public function get_DetalleComidasId($id_plan_nutri){

        $sql = "SELECT * FROM detalle_comida AS dc 
        JOIN plan_nutricional AS pn ON dc.id_plan_nutricional = pn.id_plan_nutricional 
        JOIN comida AS c on c.id_comida = dc.id_comida 
        JOIN tipo_comida AS tc ON tc.id_tipo_comida = c.id_tipo_comida
        JOIN usuario AS u ON u.ci_usuario = pn.ci_paciente
        WHERE pn.id_plan_nutricional = '$id_plan_nutri'
        ORDER BY dc.dia ASC";
        
        

        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }

    public function get_DatosPacienteId($id_plan_nutri){

        $sql = "SELECT u.nombres, u.apellidos, u.edad FROM plan_nutricional AS pn 
        JOIN usuario AS u ON u.ci_usuario = pn.ci_paciente 
        WHERE pn.id_plan_nutricional = '$id_plan_nutri'";
        
        

        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }

    public function get_Comidas(){

        $sql = "SELECT * FROM comida AS c JOIN tipo_comida AS tp ON c.id_tipo_comida = tp.id_tipo_comida";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }

    public function actualizarDetalleComida($id_plan_nutricion, $id_comida_actual, $id_comida_nueva, $dia ){
        // Escapar los datos para prevenir inyecciones de SQL
        //$id_plan_nutricion = intval($id_plan_nutricion);
        //$id_comida_actual = intval($id_comida_actual);
        //$id_comida_nueva = intval($id_comida_nueva);
        //$dia = $this->db->real_escape_string($dia);
       // $id_plan = intval($id_plan_nutricion);
        //var_dump($id_plan_nutricion, $id_comida_actual, $id_comida_nueva);


        // Construir la consulta
        $sql = "UPDATE `detalle_comida`
                SET `id_comida`='$id_comida_nueva'
                WHERE `id_comida`='$id_comida_actual' AND `id_plan_nutricional`='$id_plan_nutricion' AND `dia`='$dia'";

        // Ejecutar la consulta
        $resultado = $this->db->query($sql);

        // Verificar si la ejecución fue exitosa
      /*  if ($resultado) {
            echo "Actualización exitosa";
        } else {
            // Muestra el error en caso de fallo
            echo "Error al actualizar: " . $this->db->error;
        }
        *///$this->db->query("INSERT INTO `detalle_comida`(`id_comida`, `id_plan_nutricional`, `dia`) VALUES ('$id_plan_nutricion','$id_comida_nueva','$dia')");
    }

    public function get_Semana_Plan_Nutri($id_plan_nutri){

        $sql = "SELECT * FROM plan_nutricional WHERE id_plan_nutricional = '$id_plan_nutri'";
        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;
    }
    
    public function get_datosPlanNutricional($id_plan_nutricional){
        $sql = "SELECT * FROM plan_nutricional WHERE id_plan_nutricional = '$id_plan_nutricional';";

        $resultado = $this->db->query($sql);

        while($fila = $resultado->fetch_assoc()){
            $this->detalle_comida[] = $fila;
        }
        return $this->detalle_comida;

    }

    public function eliminarDetalleComida($id){
        $sql = "DELETE FROM `detalle_comida` WHERE id_plan_nutricional = '$id'";

        $resultado = $this->db->query($sql);
    }

}

?>