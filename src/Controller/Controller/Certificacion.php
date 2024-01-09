<?php

class CertificacionController{

    public function __construct(){
        require_once __DIR__ . "/../Model/certificacionModel.php";
    }

    public function verCertificaciones(){

        $certificacion = new CertificacionModel();
        $data['titulo'] = 'certificacion';
        $data['certificacion'] = $certificacion->get_Certificaciones();

        require_once(__DIR__ . '/../View/certificacion/verCertificacion.php');
    }

    public function nuevoCertificacion(){
        $data['titulo'] = ' certificacion';
        $certificacion = new CertificacionModel();
        $data['opciones_nutriologa'] = $certificacion->getCINutriologa();
        require_once(__DIR__ . '/../View/certificacion/nuevoCertificacion.php');
    }

    public function guardarCertificacion(){
        
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $titulo = $_POST['titulo'];
        $archivo = $_POST['archivo'];
        
        $certificacion = new CertificacionModel();
        $certificacion->insertar_Certificacion($ci_nutriologa, $titulo, $archivo);
        $data["titulo"] = "certificacion";
        $this->verCertificaciones();
    }

    public function modificarCertificacion($id_certificacion){
			
        $certificacion = new CertificacionModel();
        
        $data["id_certificacion"] = $id_certificacion;
        $data["certificacion"] = $certificacion->get_Certificacion($id_certificacion);
        $data2['opciones_nutriologa'] = $certificacion->getCINutriologa();
        $data["titulo"] = "certificacion";
        require_once(__DIR__ . '/../View/certificacion/modificarCertificacion.php');
    }
    
    public function actualizarCertificacion(){

        $id_certificacion = $_POST['id_certificacion'];
        $ci_nutriologa = $_POST['ci_nutriologa'];
        $titulo = $_POST['titulo'];
        $archivo = $_POST['archivo'];

        $certificacion = new CertificacionModel();
        $certificacion->modificar_Certificacion($id_certificacion, $ci_nutriologa, $titulo, $archivo);
        $data["titulo"] = "certificacion";
        $this->verCertificaciones();
    }
    
    public function eliminarCertificacion($id_certificacion){
        
        $certificacion = new CertificacionModel();
        $certificacion->eliminar_Certificacion($id_certificacion);
        $data["titulo"] = "certificacion";
        $this->verCertificaciones();
    }



    
}

?>