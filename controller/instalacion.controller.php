<?php
require_once 'model/instalacion.model.php';
require_once 'entity/instalacion.entity.php';
require_once 'includes.controller.php';

class InstalacionController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new InstalacionModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/instalacion.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $areas = $this->model->Listar();
        return $areas;
    }

    public function Consultar($idInstalacion)
    {
        $instalacion = new Area();
        $instalacion->__SET('idInstalacion',$idInstalacion);

        $consulta = $this->model->Consultar($instalacion);
        return $consulta;
    }

    public function Actualizar(){
        $instalacion = new Instalacion();
        $instalacion->__SET('idInstalacion',$_REQUEST['idInstalacion']);
        $instalacion->__SET('Sede_id',$_REQUEST['Sede_id']); 
        $instalacion->__SET('Nombre',$_REQUEST['Nombre']);  
        $instalacion->__SET('Descripcion',$_REQUEST['Descripcion']);  
        $instalacion->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($instalacion);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Instalacion');
            #echo 'No se Ha Podido Actualizar la Instalacion';
         }else{
            #echo 'Instalacion Actualizada Correctamente';
            header('Location: index.php?c=Instalacion');
         }
    }

    public function Registrar(){
        $instalacion = new Instalacion();
        $instalacion->__SET('Sede_id',$_REQUEST['Sede_id']);
        $instalacion->__SET('Nombre',$_REQUEST['Nombre']); 
        $instalacion->__SET('Descripcion',$_REQUEST['Descripcion']);   
        $registrar = $this->model->Registrar($instalacion);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Instalacion');
            //echo 'No se Ha Podido Registrar el Instalacion';
         }else{
            //echo 'Instalacion Registrada Correctamente';
            header('Location: index.php?c=Instalacion');
         }
    }

    public function Eliminar(){
        $instalacion = new Instalacion();
        $instalacion->__SET('idInstalacion',$_REQUEST['idInstalacion']);
        $eliminar = $this->model->Eliminar($instalacion);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Instalacion';
            header('Location: index.php?c=Instalacion');            
         }else{
            #echo 'Instalacion Eliminado Correctamente';
            header('Location: index.php?c=Instalacion');
         }
    }



}