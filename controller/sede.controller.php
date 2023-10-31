<?php
require_once 'model/sede.model.php';
require_once 'entity/sede.entity.php';
require_once 'includes.controller.php';

class SedeController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new SedeModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/sede.php';
        require_once 'view/footer.php';       
    }

 
    /**=======================================================================*/   
    public function Listar()
    {
        $sedes = $this->model->Listar();
        return $sedes;
    }

    public function Consultar($idSede)
    {
        $sede = new Sede();
        $sede->__SET('idSede',$idSede);

        $consulta = $this->model->Consultar($sede);
        return $consulta;
    }

    public function Actualizar(){
        $sede = new Sede();
        $sede->__SET('idSede',$_REQUEST['idSede']);
        $sede->__SET('Nombre',$_REQUEST['Nombre']);
        $sede->__SET('Direccion',$_REQUEST['Direccion']);  
        $sede->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar = $this->model->Actualizar($sede);  
         
        if($actualizar=='error'){
            header('Location: index.php?c=Sede');
            #echo 'No se Ha Podido Actualizar la Sede';
         }else{
            #echo 'Sede Actualizada Correctamente';
            header('Location: index.php?c=Sede');
         }
    }

    public function Registrar(){
        $sede = new Sede();
        $sede->__SET('Nombre',$_REQUEST['Nombre']);
        $sede->__SET('Direccion',$_REQUEST['Direccion']);   
        $registrar = $this->model->Registrar($sede);  
         
        if($registrar=='error'){
            header('Location: index.php?c=Sede');
            //echo 'No se Ha Podido Registrar el Sede';
         }else{
            //echo 'Sede Registrada Correctamente';
            header('Location: index.php?c=Sede');
         }
    }

    public function Eliminar(){
        $sede = new Sede();
        $sede->__SET('idSede',$_REQUEST['idSede']);
        $eliminar = $this->model->Eliminar($sede);  
         
        if($eliminar=='error'){
            #echo 'No se Ha Podido Eliminar el Sede';
            header('Location: index.php?c=Sede');            
         }else{
            #echo 'Sede Eliminado Correctamente';
            header('Location: index.php?c=Sede');
         }
    }



}