<?php
require_once 'UsuariosModel.php';
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
    public function get_intentos_usuario($email){
        $sql = "SELECT intentos FROM usuario WHERE correo='$email' LIMIT 1";
        $resultado = $this->db->query($sql);
    
        if ($resultado) {
            // Verifica si la consulta se ejecutó correctamente
            $fila = $resultado->fetch_assoc(); // Obtén la fila como un array asociativo
    
            if ($fila) {
                // Verifica si se obtuvo una fila
                return $fila['intentos']; // Devuelve el valor de la columna 'intentos'
            } else {
                return false; // No se encontraron resultados
            }
        } else {
            return false; // Hubo un error en la consulta
        }
    }
    public function bajar_intentos($email)
    {
        $sql = "UPDATE usuario SET intentos = intentos - 1 WHERE correo = '$email'";
        $resultado = $this->db->query($sql);
    }
    public function reanudar_intentos($email, $nuevoIntentos)
    {
        $sql = "UPDATE usuario SET intentos = '$nuevoIntentos' WHERE correo = '$email'";
        $resultado = $this->db->query($sql);
    }

    public function regresaNumero_intentos()
    {
        $sql = "SELECT intentos FROM intentos_inicio WHERE id_intentos = '1' LIMIT 1";
        
        // Ejecutar la consulta en la base de datos
        $resultado = $this->db->query($sql);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Obtener el primer y único registro (si existe)
            $fila = $resultado->fetch_assoc();

            // Verificar si se encontró un resultado
            if ($fila) {
                // Devolver el valor de 'intentos'
                return $fila['intentos'];
            } else {
                // No se encontraron resultados
                return null; // o algún valor predeterminado según tu lógica de negocio
            }
        } else {
            // La consulta no fue exitosa, manejar el error según tu necesidad
            return null; // o lanzar una excepción, dependiendo de tus requerimientos
        }
    }

    
    public function get_ci_usuario($email){
        $sql = "SELECT ci_usuario FROM usuario WHERE correo='$email' LIMIT 1";
        $resultado = $this->db->query($sql);
    
        if ($resultado->num_rows > 0) {
            // Si hay al menos un resultado, extraer y retornar el valor de la columna ci_usuario
            $fila = $resultado->fetch_assoc();
            return $fila['ci_usuario'];
        } else {
            // Si no hay resultados, puedes devolver null o algún otro valor predeterminado
            return null;
        }
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

    //funciones de validacion 
    function esNulo(array $parametros) {
        foreach ($parametros as $parametro) {
            if (strlen(trim($parametro)) < 1) {
                return true;
            }
        }
        return false;
    }

    function EmailExiste($email) {
        $sql = "SELECT u.*, r.rol as rol FROM usuario u JOIN rol r ON u.id_rol = r.id_rol where u.correo = '$email' LIMIT 1";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila;
    }
    //correo electronico 
    /*public function activarCuenta($email, $hash) {
        // Consulta SELECT
        $sqlSelect = "SELECT correo, activo FROM usuario WHERE correo=? AND (activo IS NULL OR activo=0) LIMIT 1";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bind_param("s", $email);
        $stmtSelect->execute();
        $stmtSelect->store_result();
    
        if ($stmtSelect->num_rows > 0) {
            // Hay una coincidencia, activar la cuenta
            $sqlUpdate = "UPDATE usuario SET activo=1, hash=? WHERE correo=? AND (activo IS NULL OR activo=0)";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ss", $hash, $email);
            $stmtUpdate->execute();
    
            return true;
        } else {
            // No hay coincidencias
            return false;
        }
    }*/
    public function activarCuenta($email, $hash) {
        // Consulta SELECT
        $sqlSelect = "SELECT correo, activo FROM usuario WHERE correo=? AND (activo IS NULL OR activo=0) LIMIT 1";
        $stmtSelect = $this->db->prepare($sqlSelect);
        $stmtSelect->bind_param("s", $email);
        $stmtSelect->execute();
        $stmtSelect->store_result();
    
        if ($stmtSelect->num_rows > 0) {
            // Hay una coincidencia, verifica si la cuenta ya está activa
            $stmtSelect->bind_result($correo, $activo);
            $stmtSelect->fetch();
    
            if ($activo == 1) {
                // La cuenta ya está activa, retorna true sin hacer ninguna actualización
                return false;
            }
    
            // La cuenta no está activa, realiza la actualización
            $sqlUpdate = "UPDATE usuario SET activo=1, hash=? WHERE correo=? AND (activo IS NULL OR activo=0)";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ss", $hash, $email);
            $stmtUpdate->execute();
    
            return true;
        } else {
            // No hay coincidencias
            return false;
        }
    }
    public function get_claveRecuperacion($correo) {
        $sql = "SELECT clave FROM usuario WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
    
        if (!$stmt) {
            // Imprime información sobre el error en la preparación de la consulta
            print_r($this->db->error);
            return null;
        }
    
        $stmt->bind_param('s', $correo);
    
        if (!$stmt->execute()) {
            // Imprime información sobre el error en la ejecución de la consulta
            print_r($stmt->error);
            return null;
        }
    
        // Obtener el resultado como un array asociativo
        $stmt->bind_result($clave);
        $stmt->fetch();
        $stmt->close();
    
        return isset($clave) ? $clave : null;
    }
    
}


?>