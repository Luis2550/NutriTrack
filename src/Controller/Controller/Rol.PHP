<?php

class RolController{

    public function __construct(){
        require_once __DIR__ . "/../Model/rolModel.php";
    }

    public function verRoles(){

        $citas = new RolModel();
        $data['titulo'] = 'rol';
        $data['rol'] = $citas->get_Roles();

        require_once(__DIR__ . '/../View/rol/verRol.php');
    }

    public function nuevoRol(){
        $data['titulo'] = ' roles';
        $rol = new RolModel();

        require_once(__DIR__ . '/../View/rol/nuevoRol.php');
    }

    public function guardarRol(){
        
        $roldato = $_POST['rol'];
        $descripcion = $_POST['descripcion'];

        
        $rol = new RolModel();
        $rol->insertar_Rol($roldato, $descripcion);
        $data["titulo"] = "roles";
        $this->verRoles();
    }

    public function modificarRol($id_rol){
			
        $rol = new RolModel();
        
        $data["id_rol"] = $id_rol;
        $data["rol"] = $rol->get_Rol($id_rol);
        $data["titulo"] = "roles";
        require_once(__DIR__ . '/../View/rol/modificarRol.php');
    }
    
    public function actualizarRol(){

        $id_rol = $_POST['id_rol'];
        $roldato = $_POST['rol'];
        $descripcion = $_POST['descripcion'];
  
        $rol = new RolModel();
        $rol->modificar_Rol($id_rol, $roldato, $descripcion);
        $data["titulo"] = "roles";
        $this->verRoles();
    }
    
    public function eliminarRol($id_rol){
        
        $rol = new RolModel();
        $rol->eliminar_Rol($id_rol);
        $data["titulo"] = "roles";
        $this->verRoles();
    }

    
}

?>