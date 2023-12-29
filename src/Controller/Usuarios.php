<?php

class UsuariosController{

    public function __construct(){
        require_once __DIR__ . "/../Model/usuariosModel.php";
    }
    function validarNombre($nombres) {
        // Verificar que el nombre y el apellido contengan exactamente dos palabras
        $nombrePalabras = explode(' ', trim($nombres));

        if (preg_match('/[0-9!@#$%^&*(),.?":{}|<>]/', $nombres)) {
            // Devolver false si se encuentran números o caracteres especiales 
            return false;
        }elseif(count($nombrePalabras) !== 2) {
            // Devolver false si la validación falla
            return false;
        }else{
            return true;
        }
        // Devolver true si la validación es exitosa
        
    }
    function validarApellido($apellidos) {
        // Verificar que el nombre y el apellido contengan exactamente dos palabras
        $apellidoPalabras = explode(' ', trim($apellidos));

        if (preg_match('/[0-9!@#$%^&*(),.?":{}|<>]/', $apellidos)) {
            // Devolver false si se encuentran números o caracteres especiales 
            return false;
        }elseif(count($apellidoPalabras) !== 2) {
            // Devolver false si la validación falla
            return false;
        }else{
            return true;
        }
        // Devolver true si la validación es exitosa
        
    }
    function validarCedula($cedula) {
        // Eliminar espacios en blanco y caracteres no numéricos
        $cedula = preg_replace("/[^0-9]/", "", $cedula);
    
        // Verificar que la cédula tenga 10 dígitos
        if (strlen($cedula) === 10) {
            // Obtener los dos primeros dígitos como provincia
            $provincia = (int) substr($cedula, 0, 2);
    
            // Validar que la provincia esté entre 1 y 24
            if ($provincia >= 1 && $provincia <= 24) {
                // Inicializar los coeficientes
                $coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2, 1];
    
                // Inicializar el resultado de la suma
                $suma = 0;
    
                // Calcular la suma ponderada
                for ($i = 0; $i < 9; $i++) {
                    $num = (int) $cedula[$i] * $coeficientes[$i];
                    $suma += $num - ($num > 9 ? 9 : 0);
                }
    
                // Aplicar el módulo 10 al resultado
                $resultado = $suma % 10;
    
                // Obtener el dígito verificador ingresado
                $digitoVerificadorIngresado = (int) $cedula[9];
    
                // Calcular el dígito verificador
                $digitoVerificadorCalculado = ($resultado === 0) ? 0 : 10 - $resultado;
    
                // Comparar el dígito verificador
                if ($digitoVerificadorCalculado === $digitoVerificadorIngresado) {
                    return true; // Cédula válida
                } else {
                    return false; // Cédula inválida
                }
            } else {
                return false; // La provincia en la cédula no es válida
            }
        } else {
            return false; // La longitud de la cédula no es válida
        }
    }

    public function verUsuarios(){

        $usuarios = new UsuariosModel();
        $data['titulo'] = ' Usuarios';
        $data['usuarios'] = $usuarios->get_Usuarios();

        require_once(__DIR__ . '/../View/usuarios/ver_usuarios.php');
    }

    public function nuevoUsuarios(){
        $usuarios = new UsuariosModel();
        $data['titulo'] = ' Usuarios';
        $data['roles'] = $usuarios->get_Roles();
        require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
    }

    public function guardarUsuarios(){
        $ci_usuario = mb_strtoupper($_POST['cedula'], 'UTF-8');
        $id_rol = $_POST['id_rol'];
        $nombres = mb_strtoupper($_POST['nombres'], 'UTF-8');
        $apellidos = mb_strtoupper($_POST['apellidos'], 'UTF-8');
        $edad = $_POST['edad'];
        $correo = strtolower($_POST['correo']);
        $contrasenia = password_hash($_POST['clave'], PASSWORD_DEFAULT);
        $genero = mb_strtoupper($_POST['sexo'], 'UTF-8');
        $foto = $_POST['foto'];


        // Verificar si ya existe un usuario con la misma cédula
        $usuarios = new UsuariosModel();
        $usuarioExistente = $usuarios->get_Usuario($ci_usuario);

        if ($usuarioExistente) {
            // Mostrar un mensaje de error en el formulario
            $data["titulo"] = "Usuarios";
            $data["error_message"] = "Ya existe un usuario con esa cédula";
            require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
        } elseif(UsuariosController::validarCedula($ci_usuario)){
            $usuarios = new UsuariosModel();
            $usuarios->insertar_Usuarios($ci_usuario, $id_rol, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto );
            $data["titulo"] = "Usuarios";
            $this->verUsuarios();
        } elseif (UsuariosController::validarNombre($nombres)){
            if (UsuariosController::validarApellido($apellidos))
            {
                $usuarios->insertar_Usuarios($ci_usuario, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero,$foto );
                $data["titulo"] = "usuarios";
                $this->verUsuarios();
            }
            else {

                // Manejar el caso en que la validación falla
                $error_message = 'Error: El nombre y el apellido deben contener exactamente dos palabras y no deben contener caracteres especiales.';
                $data["titulo"] = "usuarios";
                require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
            } 
        }else{
            // Mostrar un mensaje de error en el formulario
            $data["titulo"] = "Usuarios";
            $data["error_message"] = "Cédula no válida";
            require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
        }


    }

    public function modificarUsuarios($id){
			
        $usuarios = new UsuariosModel();
        
        $data["ci_usuario"] = $id;
        $data["usuarios"] = $usuarios->get_Usuario($id);
        $data["titulo"] = "Usuarios";
        require_once(__DIR__ . '/../View/usuarios/modificarUsuarios.php');
    }
    
    public function actualizarUsuarios(){
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $correo = $_POST['correo'];
        $contrasenia = $_POST['clave'];
        $genero = $_POST['sexo'];
        $foto = $_POST['foto'];

        $usuarios = new UsuariosModel();
        $usuarios->modificar_Usuarios($id,$nombres, $apellidos, $edad, $correo, $contrasenia, $genero, $foto);
        $data["titulo"] = "usuarios";
        $this->verUsuarios();
    }
    
    public function eliminarUsuarios($id){
        
        $usuarios = new UsuariosModel();
        $usuarios->eliminar_Usuarios($id);
        $data["titulo"] = "Usuarios";
        $this->verUsuarios();
    }
    
}

?>