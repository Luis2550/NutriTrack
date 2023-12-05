<?php

class ComidaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/comidaModel.php";
    }

    public function verComida(){

        $comida = new ComidaModel();
        $data['titulo'] = 'Comida';
        $data['comida'] = $comida->get_comida();

        require_once(__DIR__ . '/../View/Comida/verComida.php');
    }

    public function nuevaComida(){

        $comida = new ComidaModel();
        $data['titulo'] = 'Nueva Comida';
        require_once(__DIR__ . '/../View/Comida/nuevaComida.php');
    } 
    
    public function guardarComida(){
        
        $com = $_POST['comida'];
        $numero_comidas = $_POST['numero_comidas'];
        $dia = $_POST['dia'];
        $descripcion = $_POST['descripcion'];
        $cantidad_proteina = $_POST['cantidad_proteina'];
        $cantidad_carbohidratos = $_POST['cantidad_carbohidratos'];
        $cantidad_grasas_saludables = $_POST['cantidad_grasas_saludables'];
        
        $comida = new ComidaModel();
        $comida->insertar_comida($com, $numero_comidas, $dia, $descripcion, $cantidad_proteina,$cantidad_carbohidratos,$cantidad_grasas_saludables);
        $data["titulo"] = "Nueva Comida";
        $this->verComida();
    }

    public function modificarComida($id){
			
        $comida = new ComidaModel();
        
        $data["id_comida"] = $id;
        $data["comida"] = $comida->get_comida_id($id);
        $data["titulo"] = "Comida por ID";
        require_once(__DIR__ . '/../View/Comida/modificarComida.php');
    }
   

    public function actualizarComida(){
        $id_comida = $_POST['id_comida'];
        $comida = $_POST['comida'];
        $numero_comidas = $_POST['numero_comidas'];
        $dia = $_POST['dia'];
        $descripcion = $_POST['descripcion'];
        $cantidad_proteina = $_POST['cantidad_proteina'];
        $cantidad_carbohidratos = $_POST['cantidad_carbohidratos'];
        $cantidad_grasas_saludables = $_POST['cantidad_grasas_saludables'];

        $com = new ComidaModel();
        $com->modificar_comida($id_comida,$comida,$numero_comidas,$dia, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables);
        $data["titulo"] = "Comida";
        $this->verComida();
    }

    public function eliminarComida($id){
        
        $com = new ComidaModel();
        $com->eliminar_comida($id);
        $data["titulo"] = "Eliminar Comida";
        $this->verComida();
    }
}
?>