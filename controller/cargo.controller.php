<?php
require_once 'model/cargo.model.php';
require_once 'entity/cargo.entity.php';
require_once 'includes.controller.php';

class CargoController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new CargoModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/cargo.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $areas = $this->model->Listar();
        return $areas;
    }

    public function Consultar($idCargo)
    {
        $cargo = new Cargo();
        $cargo->__SET('idCargo',$idCargo);

        $consulta = $this->model->Consultar($area);
        return $consulta;
    }

    public function Actualizar(){
        $cargo = new Cargo();
        $cargo->__SET('idCargo',$_REQUEST['idCargo']);
        $cargo->__SET('Area_id',$_REQUEST['Area_id']); 
        $cargo->__SET('Nombre',$_REQUEST['Nombre']);  
        $cargo->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($cargo);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Cargo');
            #echo 'No se Ha Podido Actualizar la Cargo';
         }else{
            #echo 'Cargo Actualizada Correctamente';
            header('Location: index.php?c=Cargo');
         }
    }

    public function Registrar(){
        $cargo = new Cargo();
        $cargo->__SET('Area_id',$_REQUEST['Area_id']);
        $cargo->__SET('Nombre',$_REQUEST['Nombre']);   
        $registrar = $this->model->Registrar($cargo);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Cargo');
            //echo 'No se Ha Podido Registrar el Cargo';
         }else{
            //echo 'Cargo Registrada Correctamente';
            header('Location: index.php?c=Cargo');
         }
    }

    public function Eliminar(){
        $cargo = new Cargo();
        $cargo->__SET('idCargo',$_REQUEST['idCargo']);
        $eliminar = $this->model->Eliminar($cargo);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Area';
            header('Location: index.php?c=Cargo');            
         }else{
            #echo 'Area Eliminado Correctamente';
            header('Location: index.php?c=Cargo');
         }
    }



}