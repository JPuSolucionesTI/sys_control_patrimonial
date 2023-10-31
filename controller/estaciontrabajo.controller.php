<?php
require_once 'model/estaciontrabajo.model.php';
require_once 'entity/estaciontrabajo.entity.php';
require_once 'includes.controller.php';

class EstacionTrabajoController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new EstacionTrabajoModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/estaciontrabajo.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $areas = $this->model->Listar();
        return $areas;
    }

    public function Consultar($idEstacion_Trabajo)
    {
        $estaciontrabajo = new Area();
        $estaciontrabajo->__SET('idEstacion_Trabajo',$idEstacion_Trabajo);

        $consulta = $this->model->Consultar($estaciontrabajo);
        return $consulta;
    }

    public function Actualizar(){
        $estaciontrabajo = new EstacionTrabajo();
        $estaciontrabajo->__SET('idEstacion_Trabajo',$_REQUEST['idEstacion_Trabajo']);
        $estaciontrabajo->__SET('Instalacion_id',$_REQUEST['Instalacion_id']); 
        $estaciontrabajo->__SET('Nombre',$_REQUEST['Nombre']);  
        $estaciontrabajo->__SET('Descripcion',$_REQUEST['Descripcion']);  
        $estaciontrabajo->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($estaciontrabajo);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=EstacionTrabajo');
            #echo 'No se Ha Podido Actualizar la EstacionTrabajo';
         }else{
            #echo 'EstacionTrabajo Actualizada Correctamente';
            header('Location: index.php?c=EstacionTrabajo');
         }
    }

    public function Registrar(){
        $estaciontrabajo = new EstacionTrabajo();
        $estaciontrabajo->__SET('Instalacion_id',$_REQUEST['Instalacion_id']);
        $estaciontrabajo->__SET('Nombre',$_REQUEST['Nombre']); 
        $estaciontrabajo->__SET('Descripcion',$_REQUEST['Descripcion']);   
        $registrar = $this->model->Registrar($estaciontrabajo);  
         
        if($registrar=='error'){
            header('Location: index.php?c=EstacionTrabajo');
            //echo 'No se Ha Podido Registrar el EstacionTrabajo';
         }else{
            //echo 'EstacionTrabajo Registrada Correctamente';
            header('Location: index.php?c=EstacionTrabajo');
         }
    }

    public function Eliminar(){
        $estaciontrabajo = new EstacionTrabajo();
        $estaciontrabajo->__SET('idEstacion_Trabajo',$_REQUEST['idEstacion_Trabajo']);
        $eliminar = $this->model->Eliminar($estaciontrabajo);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el EstacionTrabajo';
            header('Location: index.php?c=EstacionTrabajo');            
         }else{
            #echo 'EstacionTrabajo Eliminado Correctamente';
            header('Location: index.php?c=EstacionTrabajo');
         }
    }



}