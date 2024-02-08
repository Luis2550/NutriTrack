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
        $comida = new ComidaModel();
        $data_comida['data_tipo_comida'] = $comida->get_tipos_comida();
        require_once(__DIR__ . '/../View/Comida/nuevaComida.php');
    } 
    
    public function guardarComida(){
        
        $com = $_POST['comida'];
        $id_tipo_comida = $_POST['id_tipo_comida'];
        $descripcion = $_POST['descripcion'];
        $cantidad_proteina = $_POST['cantidad_proteina'];
        $cantidad_carbohidratos = $_POST['cantidad_carbohidratos'];
        $cantidad_grasas_saludables = $_POST['cantidad_grasas_saludables'];
        
        $comida = new ComidaModel();
        $comida->insertar_comida($com, $id_tipo_comida, $descripcion, $cantidad_proteina,$cantidad_carbohidratos,$cantidad_grasas_saludables);
        $data["titulo"] = "Nueva Comida";
        $this->verComida();
    }

    public function modificarComida($id){
			
        $comida = new ComidaModel();
        
        $data["id_comida"] = $id;
        $data["comida"] = $comida->get_comida_id($id);
        $data["titulo"] = "Comida por ID";
        $data_tipos_comida['tipo_comida'] = $comida->get_tipos_comida();
        require_once(__DIR__ . '/../View/Comida/modificarComida.php');
    }
   

    public function actualizarComida(){
        $id_comida = $_POST['id_comida'];
        $comida = $_POST['comida'];
        $id_tipo_comida = $_POST['id_tipo_comida'];
        $descripcion = $_POST['descripcion'];
        $cantidad_proteina = $_POST['cantidad_proteina'];
        $cantidad_carbohidratos = $_POST['cantidad_carbohidratos'];
        $cantidad_grasas_saludables = $_POST['cantidad_grasas_saludables'];

        $com = new ComidaModel();
        $com->modificar_comida($id_comida,$comida,$id_tipo_comida, $descripcion, $cantidad_proteina, $cantidad_carbohidratos, $cantidad_grasas_saludables);
        $data["titulo"] = "Comida";
        $this->verComida();
    }

    public function eliminarComida($id){
        
        $com = new ComidaModel();
        $hayComidasAsignadas = $com->get_hayComidasAsignadas($id);

        if($hayComidasAsignadas){
            $error_message = 'No puede eliminar una comida que ya ha sido asignada.';
            //$this->verComida();
            $comida = new ComidaModel();
            $data['titulo'] = 'Comida';
            $data['comida'] = $comida->get_comida();
    
            // Redirige a la página de error con el mensaje específico
            header('Location: http://localhost/nutritrack/index.php?c=Comida&a=verComida&error_message=' . urlencode($error_message));
            exit();

            
        }else{
            //$mensaje = '';
            $com->eliminar_comida($id);
            $data["titulo"] = "Eliminar Comida";
            $this->verComida();
        }

        
    }
}
?>