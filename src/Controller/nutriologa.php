<?php

class nutriologaController{

    public function __construct(){
        require_once __DIR__ . "/../Model/nutriologaModel.php";
    }

    public function verNutriologa(){

        $nutri = new nutriologaModel();
        $data['titulo'] = 'nutriologa';
        $data['nutriologa'] = $nutri->get_nutriologas();

        require_once(__DIR__ . '/../View/nutriologa/verNutriologa.php');
    }

    public function nuevoNutriologa() {
        $data['titulo'] = 'nutriologa';

        // Instancia de la clase planNutricionalModel
        $nutri = new nutriologaModel();
        
        
        // Obtener CI de pacientes
        $data['opciones_paciente'] = $nutri->getCIusuario();

        require_once(__DIR__ . '/../View/nutriologa/nuevoNutriologa.php');
    }

    public function guardarNutriologa(){
        
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $cantidad_cupos = $_POST['cantidad_cupos'];
        $certificacion = $_POST['certificacion'];
   

        $nutri = new nutriologaModel();
        $nutri->insertar_nutriologa($ci_nutriologa,$cantidad_cupos,$certificacion);
        $data["titulo"] = "nutriologa";
        $this->verNutriologa();
    }

    public function modificarNutriologa($id){
			
        $nutri = new nutriologaModel();
        $data["ci_nutriologa"] = $id;
        $data["nutriologa"] = $nutri->get_nutriologa($id);
        $data["titulo"] = "nutriologa";
        require_once(__DIR__ . '/../View/nutriologa/modificarNutriologa.php');
    }
    
    public function actualizarNutriologa(){
        $ci_nutriologa = $_POST['id'];
        $cantidad_cupos = $_POST['cantidad_cupos'];
        $certificacion = $_POST['certificacion'];

        
        $nutri= new nutriologaModel();
        $nutri->modificar_nutriologa($ci_nutriologa,$cantidad_cupos,$certificacion);
        $data["titulo"] = "nutriologa";
        $this->verNutriologa();
    }
    
    
    public function eliminarNutriologa($id){
        
        $historiaMedi = new nutriologaModel();
        $historiaMedi->eliminar_Nutriologa($id);
        $data["titulo"] = "nutriologa";
        $this->verNutriologa();
    }

    
}

?>