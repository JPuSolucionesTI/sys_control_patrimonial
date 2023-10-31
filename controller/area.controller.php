<?php
require_once 'model/area.model.php';
require_once 'entity/area.entity.php';
require_once 'includes.controller.php';

class AreaController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new AreaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/area.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $areas = $this->model->Listar();
        return $areas;
    }

    public function Consultar($idArea)
    {
        $area = new Area();
        $area->__SET('idArea',$idArea);

        $consulta = $this->model->Consultar($area);
        return $consulta;
    }

    public function Actualizar(){
        $area = new Area();
        $area->__SET('idArea',$_REQUEST['idArea']);
        $area->__SET('Departamento_id',$_REQUEST['Departamento_id']); 
        $area->__SET('Nombre',$_REQUEST['Nombre']);  
        $area->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($area);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Area');
            #echo 'No se Ha Podido Actualizar la Area';
         }else{
            #echo 'Area Actualizada Correctamente';
            header('Location: index.php?c=Area');
         }
    }

    public function Registrar(){
        $area = new Area();
        $area->__SET('Departamento_id',$_REQUEST['Departamento_id']);
        $area->__SET('Nombre',$_REQUEST['Nombre']);   
        $registrar = $this->model->Registrar($area);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Area');
            //echo 'No se Ha Podido Registrar el Area';
         }else{
            //echo 'Area Registrada Correctamente';
            header('Location: index.php?c=Area');
         }
    }

    public function Eliminar(){
        $area = new Area();
        $area->__SET('idArea',$_REQUEST['idArea']);
        $eliminar = $this->model->Eliminar($area);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Area';
            header('Location: index.php?c=Area');            
         }else{
            #echo 'Area Eliminado Correctamente';
            header('Location: index.php?c=Area');
         }
    }



}