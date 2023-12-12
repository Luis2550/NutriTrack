<?php

class UsuariosController{

    public function __construct(){
        require_once __DIR__ . "/../Model/usuariosModel.php";
    }

    public function verUsuarios(){

        $usuarios = new UsuariosModel();
        $data['titulo'] = 'usuarios';
        $data['usuarios'] = $usuarios->get_Usuarios();

        require_once(__DIR__ . '/../View/usuarios/ver_usuarios.php');
    }

    public function nuevoUsuarios(){
        $data['titulo'] = ' usuarios';
        require_once(__DIR__ . '/../View/usuarios/nuevoUsuarios.php');
    }

    public function guardarUsuarios(){
        
        $ci_usuario = $_POST['cedula'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $correo = $_POST['correo'];
        $contrasenia = $_POST['clave'];
        $genero = $_POST['sexo'];
        $foto = $_POST['foto'];
        
        $usuarios = new UsuariosModel();
        $usuarios->insertar_Usuarios($ci_usuario, $nombres, $apellidos, $edad, $correo, $contrasenia, $genero,$foto );
        $data["titulo"] = "Usuarios";
        $this->verUsuarios();
    }

    public function modificarUsuarios($id){
			
        $usuarios = new UsuariosModel();
        
        $data["ci_usuario"] = $id;
        $data["usuarios"] = $usuarios->get_Usuario($id);
        $data["titulo"] = "usuarios";
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
        $data["titulo"] = "usuarios";
        $this->verUsuarios();
    }

    
}

?>